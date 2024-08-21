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
        success: String,
        errors: Object || null,
    },
    setup() {
        const form =  useForm({
            current_password: '',
            new_password: '',
            new_password_confirmation: '',
        });

        const login = () => {
            form.post(route('reset_password.store'), {
                onSuccess: () => {
                    form.reset();
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
            <div v-show="!errors && success" class="alert alert-success">
                {{ success }}
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="m-0">Сброс пароля</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form @submit.prevent="login()">
                        <div class="mb-4">
                            <InputLabel for="current_password" value="Current password" />

                            <TextInput
                                id="current_password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.current_password"
                                required
                                autocomplete="current_password"
                            />

                            <InputError class="mt-2" :message="this.form.errors.current_password" />
                        </div>

                        <div class="mb-4">
                            <InputLabel for="new_password" value="New password" />

                            <TextInput
                                id="new_password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.new_password"
                                required
                                autocomplete="new_password"
                            />

                            <InputError class="mt-2" :message="this.form.errors.new_password" />
                        </div>

                        <div class="mb-4">
                            <InputLabel for="new_password_confirmation" value="New password confirmation" />

                            <TextInput
                                id="new_password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.new_password_confirmation"
                                required
                                autocomplete="new_password_confirmation"
                            />

                            <InputError class="mt-2" :message="this.form.errors.new_password_confirmation" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Сбросить
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </BaseLayout>

</template>
