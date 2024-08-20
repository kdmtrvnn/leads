<script setup>

import { Head, useForm } from '@inertiajs/inertia-vue3';
import BaseLayout from "../Layouts/BaseLayout.vue";
import InputLabel from "../Components/InputLabel.vue";
import TextInput from "../Components/TextInput.vue";
import InputError from "../Components/InputError.vue";
import PrimaryButton from "../Components/PrimaryButton.vue";

defineProps({
    title: String,
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    name: '',
    surname: '',
    phone: '',
    email: '',
    text: '',
});

const submit = () => {
};
</script>

<template>

    <BaseLayout>

        <Head :title="title" />

        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="m-0">Подать заявку</h5>
                </div>
            </div>
            <div class="card-body">
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
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

                        <InputError class="mt-2" :message="form.errors.surname" />
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

                        <InputError class="mt-2" :message="form.errors.phone" />
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

                        <InputError class="mt-2" :message="form.errors.email" />
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

                        <InputError class="mt-2" :message="form.errors.text" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Отправить
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>

    </BaseLayout>

</template>
