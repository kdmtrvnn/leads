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
            email: '',
            password: '',
        });

        const login = () => {
            form.post(route('login.store'), {
                onSuccess: () => {
                    form.reset();
                },
                onError: (errors) => {
                    console.log(errors);
                },
            });
        };

        return {form, login};
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
                        <h5 class="m-0">Авторизация</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form @submit.prevent="login()">
                        <div class="mb-4">
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

                        <div class="mb-4">
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

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Войти
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </BaseLayout>

</template>
