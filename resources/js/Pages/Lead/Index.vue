<script>
import BaseLayout from "../../Layouts/BaseLayout.vue";
import axios from 'axios';
import InputError from "../../Components/InputError.vue";
import InputLabel from "../../Components/InputLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import {Head, useForm} from "@inertiajs/inertia-vue3";

export default {
    components: {
        Head,
        useForm,
        PrimaryButton,
        TextInput, InputLabel, InputError,
        BaseLayout,
        axios,
    },
    props: {
        title: String,
    },
    data: () => ({
        leads: [],
        success: '',
        errors: '',
        countAllLeads: '',
        countLeadsInStatusNew: '',
        countLeadsInStatusAtWork: '',
        countLeadsInStatusCompleted: '',
        statuses: '',
        form: useForm({
            name: '',
            surname: '',
            phone: '',
            email: '',
        }),
    }),
    mounted() {
        this.getLeads()
    },
    methods: {
        async getLeads() {
            const response = await axios.get(route('leads.get'));
            this.leads = response.data.leads;
            this.countAllLeads = response.data.countAllLeads;
            this.countLeadsInStatusNew = response.data.countLeadsInStatusNew;
            this.countLeadsInStatusAtWork = response.data.countLeadsInStatusAtWork;
            this.countLeadsInStatusCompleted = response.data.countLeadsInStatusCompleted;
            this.statuses = response.data.statuses;
        },

        async deleteLead(id) {
            await axios.delete(route('leads.delete', id));
            await this.getLeads();
        },

        async updateStatus(leadId, status) {
            await axios.patch(route('leads.update_status', leadId), {status: status});
            await this.getLeads();
        },

        async update(id) {
            const item = this.leads.filter(lead => {return (lead.id === id)});
            const leadForUpdate = JSON.parse(JSON.stringify(item))[0];
            const resp = await axios.post(route('leads.update', id), {lead: leadForUpdate});
            if (resp.data.success) {
                this.success = resp.data.success;
            }

            if (resp.data.errors) {
                this.errors = resp.data.errors;
            }

            await this.getLeads();
        },
    },
};

</script>

<template>
    <BaseLayout>

        <Head :title="this.title" />

        <div v-show="!this.errors && this.success" class="alert alert-success">
            {{ this.success }}
        </div>

        <div>
            <p>Всего лидов: <b>{{ this.countAllLeads }}</b></p>
            <p>Статус «Новый»: <b>{{ this.countLeadsInStatusNew }}</b></p>
            <p>Статус «В работе»: <b>{{ this.countLeadsInStatusAtWork }}</b></p>
            <p>Статус «Завершен»: <b>{{ this.countLeadsInStatusCompleted }}</b></p>
            <div v-for="lead in this.leads" :key="lead.id">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 card mb-3">
                            <div class="card-body">
                                <form @submit.prevent="update(lead.id)">
                                    <div class="mb-1">
                                        <b>ID:&nbsp;{{ lead.id }}</b>
                                    </div>
                                    <div class="mb-1">
                                        <InputLabel for="name" value="Name" />

                                        <TextInput
                                            id="name"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="lead.name"
                                            required
                                            autocomplete="name"
                                            @change="lead.isDisabled = false"
                                        />

                                        <InputError class="mt-2" :message="this.errors.name" />
                                    </div>
                                    <div class="mb-1">
                                        <InputLabel for="surname" value="Surname" />

                                        <TextInput
                                            id="surname"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="lead.surname"
                                            required
                                            autocomplete="surname"
                                            @change="lead.isDisabled = false"
                                        />

                                        <InputError class="mt-2" :message="this.errors.surname" />
                                    </div>
                                    <div class="mb-1">
                                        <InputLabel for="email" value="Email" />

                                        <TextInput
                                            id="email"
                                            type="email"
                                            class="mt-1 block w-full"
                                            v-model="lead.email"
                                            required
                                            autocomplete="email"
                                            @change="lead.isDisabled = false"
                                        />

                                        <InputError class="mt-2" :message="this.errors.email" />
                                    </div>
                                    <div class="mb-1">
                                        <InputLabel for="phone" value="Phone" />

                                        <TextInput
                                            id="phone"
                                            type="number"
                                            class="mt-1 block w-full"
                                            v-model="lead.phone"
                                            required
                                            autocomplete="phone"
                                            @change="lead.isDisabled = false"
                                        />

                                        <InputError class="mt-2" :message="this.errors.phone" />
                                    </div>
                                    <div class="mb-1">
                                        <InputLabel for="created_at" value="Created at" />

                                        <TextInput
                                            id="created_at"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="lead.created_at"
                                            disabled="true"
                                            autocomplete="created_at"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <InputLabel for="status" value="Status" />
                                        <select class="form-control" v-model="statuses[lead.status_id - 1].id" @change="updateStatus(lead.id, statuses[lead.status_id - 1].id)">
                                            <option v-for="statusItem in statuses" :key="statusItem.id" :value="statusItem.id">
                                                {{statusItem.name}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <PrimaryButton :disabled="lead.isDisabled" :key="lead.id" :class="{ 'opacity-25': form.processing }">
                                                Сохранить
                                            </PrimaryButton>
                                        </div>
                                        <div class="mb-1 mx-3">
                                            <button class="btn btn-danger" @click="deleteLead(lead.id)">Удалить
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BaseLayout>
</template>
