<script setup>
import { ref } from 'vue'
import { Head, router } from '@inertiajs/vue3';
import AuthenticationCard from '@/Shared/Layouts/Auth/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Shared/Layouts/Auth/AuthenticationCardLogo.vue';
import InputLabel from '@/Shared/Layouts/Auth/InputLabel.vue';
import PrimaryButton from '@/Shared/Layouts/Auth/PrimaryButton.vue';
import TextInput from '@/Shared/Layouts/Auth/TextInput.vue';
import Wrapper from '@/Shared/Layouts/Wrapper.vue'
import { routes } from '@/Shared/routes.js'
import { notification } from '@/notifications.ts'
import { useQuasar } from 'quasar'
import axios from 'axios'

const $q = useQuasar();


defineProps({
    status: String,
});

const username = ref('');
const processing = ref(false);

const submit = () => {
    processing.value = true;
    axios
        .post(routes().forgotPassword.submit.path, {
            username: username.value
        })
        .then((response) => { 
            processing.value = false; 
            router.visit(routes().verification.verify.path, {
                method: 'get',
                data: { 
                    id: response.data.user.id,
                    redirection: routes().resetPassword.create.path + '/' + response.data.user.id
                },
            })
        })
        .catch((error) => {
            notification($q, 'error', error.response.data.message || error.response.data || error)();
            processing.value = false;
        });
};

</script>

<template>
    <Head title="صفحه فراموشی رمز عبور" />

    <Wrapper>
        <template #content>
            <AuthenticationCard>
                <template #logo>
                    <AuthenticationCardLogo />
                </template>

                <div class="tw-mb-4 tw-text-xs tw-font-light tw-text-gray-600 dark:tw-text-gray-400">
                    اگر رمز عبور خود را فراموش کردید، با درخواست کد تایید اقدام به تعویض آن نمایید.
                </div>

                <div v-if="status" class="tw-mb-4 tw-text-sm tw-font-medium tw-text-green-600 dark:tw-text-green-400">
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div class="tw-mt-2">
                        <InputLabel for="username" value="شماره تماس" />
                        <TextInput
                            id="username"
                            type="text"
                            v-model="username"
                            class="tw-block tw-w-full tw-mt-1"
                            required
                            autocomplete="username"
                        />
                        <!-- <InputError class="tw-mt-2" :message="form.errors.email" /> -->
                    </div>

                    <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
                        <PrimaryButton :class="{ 'tw-opacity-25': processing }" :disabled="processing">
                            بررسی شماره تلفن
                        </PrimaryButton>
                    </div>
                </form>
            </AuthenticationCard>
        </template>
    </Wrapper>

</template>
