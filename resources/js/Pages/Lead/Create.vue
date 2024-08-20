<script>

import { Head, useForm } from '@inertiajs/inertia-vue3';
import BaseLayout from "../../Layouts/BaseLayout.vue";
import InputLabel from "../../Components/InputLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import InputError from "../../Components/InputError.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";

export default {
    components: {
        Head,
        useForm,
        BaseLayout,
        InputLabel,
        TextInput,
        InputError,
        PrimaryButton,
    },
    props: {
        title: String,
        success: String || null,
        errors: Object || null,
    },
    setup() {
        const form =  useForm({
            name: '',
            surname: '',
            phone: '',
            email: '',
            text: '',
        });

        const createLead = () => {
            form.post(route('leads.store'), {
                onSuccess: () => {
                    form.reset();
                },
                onError: (errors) => {
                    console.log(errors);
                },
            });
        };

        return {form, createLead};
    },
};

</script>

<template>

    <BaseLayout>

        <Head :title="title" />

        <div>
            <div v-show="!errors && success" class="alert alert-success">
                {{ success }}
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="m-0">Подать заявку</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form @submit.prevent="createLead()">
                        <div>
                            <InputLabel for="name" value="Name" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                autofocus
                                autocomplete="name"
                            />

                            <InputError class="mt-2" :message="this.form.errors.name" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="surname" value="Surname" />

                            <TextInput
                                id="surname"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.surname"
                                required
                                autocomplete="surname"
                            />

                            <InputError class="mt-2" :message="this.form.errors.surname" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="phone" value="Phone" />

                            <TextInput
                                id="phone"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.phone"
                                required
                                autocomplete="phone"
                            />

                            <InputError class="mt-2" :message="this.form.errors.phone" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autocomplete="email"
                            />

                            <InputError class="mt-2" :message="this.form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="text" value="Text" />

                            <TextInput
                                id="text"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.text"
                                required
                                autocomplete="text"
                            />

                            <InputError class="mt-2" :message="this.form.errors.text" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Отправить
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </BaseLayout>

</template>
