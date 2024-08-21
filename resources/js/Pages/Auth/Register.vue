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
        errors: Object || null,
    },
    setup() {
        const form =  useForm({
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        });

        const register = () => {
            form.post(route('register.store'), {
                onSuccess: () => {
                    form.reset();
                },
                onError: (errors) => {
                    console.log(errors);
                },
            });
        };

        return {form, register};
    },
};

</script>

<template>

    <BaseLayout>

        <Head :title="title" />

        <div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="m-0">Регистрация</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form @submit.prevent="register()">
                        <div class="mb-3">
                            <InputLabel for="name" value="Name" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autocomplete="name"
                            />

                            <InputError class="mt-2" :message="this.form.errors.name" />
                        </div>

                        <div class="mb-3">
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

                        <div class="mb-3">
                            <InputLabel for="password" value="Password" />

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="password"
                            />

                            <InputError class="mt-2" :message="this.form.errors.password" />
                        </div>

                        <div class="mb-3">
                            <InputLabel for="password_confirmation" value="Confirm password" />

                            <TextInput
                                id="password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password_confirmation"
                                required
                                autocomplete="password_confirmation"
                            />

                            <InputError class="mt-2" :message="this.form.errors.password_confirmation" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Зарегистрироваться
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </BaseLayout>

</template>
