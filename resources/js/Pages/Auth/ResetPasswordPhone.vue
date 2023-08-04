<script setup>
import { ref } from 'vue'
import { Head, router } from '@inertiajs/vue3';
import { routes } from '@/Shared/routes.js';
import { notification } from '@/notifications.ts';
import { useQuasar } from 'quasar'
import Wrapper from '@/Shared/Layouts/Wrapper.vue'
import axios from 'axios';
import AuthenticationCard from '@/Shared/Layouts/Auth/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Shared/Layouts/Auth/AuthenticationCardLogo.vue';
import InputError from '@/Shared/Layouts/Auth/InputError.vue';
import InputLabel from '@/Shared/Layouts/Auth/InputLabel.vue';
import PrimaryButton from '@/Shared/Layouts/Auth/PrimaryButton.vue';
import TextInput from '@/Shared/Layouts/Auth/TextInput.vue';

const $q = useQuasar();

const props = defineProps({
    user: Object
});

const submitting = ref(false);
const password = ref('');
const password_confirmation = ref('');


const submit = async () => {
    try {
        submitting.value = true;
        const response = await axios.post(routes().resetPassword.submit.path, {
            password: password.value,
            password_confirmation: password_confirmation.value
        });

        submitting.value = false;
        notification($q, 'success', response.data.message)()
        router.visit('/');
    } catch (error) {
        notification($q, 'warning', error.response.data.message || error.response || 'خطایی رخ داد!')()
        submitting.value = false;
    }
};
</script>

<template>
    <Head title="Reset Password" />

    <Wrapper>
        <template #content>
            <AuthenticationCard>
                <template #logo>
                    <AuthenticationCardLogo />
                </template>

                <form @submit.prevent="submit">
                    <div class="tw-mt-4">
                        <InputLabel for="password" value="رمز عبور" />
                        <TextInput id="password" v-model="password" type="password" class="tw-mt-1 tw-block tw-w-full"
                            required autocomplete="new-password" />
                        <InputError class="tw-mt-2" message="" />
                    </div>

                    <div class="tw-mt-4">
                        <InputLabel for="password_confirmation" value="تایید رمز عبور" />
                        <TextInput id="password_confirmation" v-model="password_confirmation" type="password"
                            class="tw-mt-1 tw-block tw-w-full" required autocomplete="new-password" />
                        <InputError class="tw-mt-2" message="" />
                    </div>

                    <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
                        <PrimaryButton :class="{ 'tw-opacity-25': submitting }" :disabled="submitting">
                            بازیابی رمز عبور
                        </PrimaryButton>
                    </div>
                </form>
            </AuthenticationCard>
        </template>
    </Wrapper>
</template>
