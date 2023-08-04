<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Shared/Layouts/Auth/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Shared/Layouts/Auth/AuthenticationCardLogo.vue';
import Checkbox from '@/Shared/Layouts/Auth/Checkbox.vue';
import InputError from '@/Shared/Layouts/Auth/InputError.vue';
import InputLabel from '@/Shared/Layouts/Auth/InputLabel.vue';
import PrimaryButton from '@/Shared/Layouts/Auth/PrimaryButton.vue';
import TextInput from '@/Shared/Layouts/Auth/TextInput.vue';
import { routes } from '@/Shared/routes.js'
import Wrapper from '@/Shared/Layouts/Wrapper.vue'

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    username: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(routes().login.post.path, {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="ورود" />

    <Wrapper>
        <template #content>

            <AuthenticationCard>
                <template #logo>
                    <AuthenticationCardLogo />
                </template>

                <div v-if="status" class="tw-mb-4 tw-text-sm tw-font-medium tw-text-green-600 dark:tw-text-green-400">
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="username" value="شماره تماس" />
                        <TextInput id="username" v-model="form.username" type="text" class="tw-block tw-w-full tw-mt-1" required
                            autofocus autocomplete="username" />
                        <InputError class="tw-mt-2" :message="form.errors.username" />
                    </div>

                    <div class="tw-mt-4">
                        <InputLabel for="password" value="رمزعبور" />
                        <TextInput id="password" v-model="form.password" type="password" class="tw-block tw-w-full tw-mt-1"
                            required autocomplete="current-password" />
                        <InputError class="tw-mt-2" :message="form.errors.password" />
                    </div>

                    <div class="tw-block tw-mt-4">
                        <label class="tw-flex tw-items-center">
                            <Checkbox v-model:checked="form.remember" name="remember" />
                            <span class="tw-ml-2 tw-text-sm tw-text-gray-600 dark:tw-text-gray-400">من را به خاطر
                                بسپار</span>
                        </label>
                    </div>

                    <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
                        <Link :href="routes().forgotPassword.create.path"
                            class="tw-text-sm tw-text-gray-600 tw-underline tw-rounded-md dark:tw-text-gray-400 hover:tw-text-gray-900 dark:hover:tw-text-gray-100 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 dark:focus:tw-ring-offset-gray-800">
                        رمز عبور را فراموش کردید؟
                        </Link>

                        <PrimaryButton class="tw-ml-4" :class="{ 'tw-opacity-25': form.processing }"
                            :disabled="form.processing">
                            ورود
                        </PrimaryButton>
                    </div>
                </form>
            </AuthenticationCard>
        </template>
    </Wrapper>
</template>
