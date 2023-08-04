<script setup>
import { computed, ref, reactive } from 'vue'
import { usePage } from '@inertiajs/vue3';
import AuthenticationCard from '@/Shared/Layouts/Auth/AuthenticationCard.vue';
// import ContactusIndexGuest from '@/Pages/Contactus/ContactusIndexGuest.vue';
// import { computed, onMounted, isRef } from 'vue';
import InputError from '@/Shared/Layouts/Auth/InputError.vue';
import InputLabel from '@/Shared/Layouts/Auth/InputLabel.vue';
import PrimaryButton from '@/Shared/Layouts/Auth/PrimaryButton.vue';
import RequiredInput from '@/Shared/Layouts/Auth/RequiredInput.vue';
import TextInput from '@/Shared/Layouts/Auth/TextInput.vue';
import VueClientRecaptcha from 'vue-client-recaptcha';
import { notification } from '@/notifications.ts';
import { useQuasar } from 'quasar';
import axios from 'axios';

const $q = useQuasar();
const captcha = ref(null);

const data = reactive({
    captchaCode: null,
    isValid: false,
});

const checkValidCaptcha = (value) => {
    /* expected return boolean if your value and captcha code are same return True otherwise return False */
    data.isValid = value;
    if (value) {
        return data.isValid = true;
    }
};

const form = reactive({
    'name': null,
    'mobile': null,
    'title': null,
    'message': null,
    'processing': false,
    'errors': null,
})

const getCaptchaCode = (value) => {
      /* you can access captcha code */
      console.log(value);
    };

const error = computed(() => {
    if(form.errors?.error)
    {
        return form?.errors.error;
    }
    return null;
})

const submit = () => {
    if (data.isValid) {

        form.processing = true;
        axios
            .post('/company/contact-us/store', {
                userId: usePage().props.auth.user.id,
                name: form.name,
                mobile: form.mobile,
                title: form.title,
                message: form.message
            })
            .then((response) => {
                form.processing = false
                return notification($q, 'success', response.data.success)()
            })
            .catch((error) => {
                form.errors = error.response.data
                console.log(form.errors)
                return;
            })
            .finally(() => form.processing = false)

    }

    else{
        return notification($q, 'error', 'کپچا اشتباه است!')();
    }
};

// const name = 
form.name = usePage().props.auth.user.first_name + ' ' + usePage().props.auth.user.last_name;
form.mobile = usePage().props.auth.user.username;

</script>

<style scoped>
.vue_client_recaptcha {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: row;
    direction: rtl;
    gap: 4
}

.vue_client_recaptcha_icon {
    text-align: center;
    padding: 10px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #eee;
    transition: background-color .3s ease-in-out
}

.vue_client_recaptcha_icon:hover {
    background-color: #ccc
}

.vue_client_recaptcha .captcha_canvas {
    background: #eee;
    padding: 10px 0
}
</style>


<template>
    <AuthenticationCard>
        <h2
            class="tw-mb-4 tw-text-4xl tw-tracking-tight tw-font-extrabold tw-text-center tw-text-gray-900 dark:tw-text-white">
            تماس با ما</h2>
        <p class="tw-mb-8 lg:tw-mb-16 tw-font-light tw-text-center tw-text-sm tw-text-gray-500 dark:tw-text-gray-400">
            اگر هر گونه چالش یا سوالی دارید می‌توانید از همین صفحه با ما در تماس باشید!</p>
        <form @submit.prevent="submit" class="tw-space-y-8">
            <div>
                <div class="tw-flex">
                    <InputLabel for="name" value="نام">
                    </InputLabel>
                    <RequiredInput></RequiredInput>
                </div>

                <TextInput id="name" v-model="form.name" type="text" class="tw-mt-1 tw-block tw-w-full" autofocus
                    autocomplete="name" disabled />
                <InputError class="tw-mt-2" :message="error?.name ? error.name[0] : ''" />
            </div>

            <div>
                <div class="tw-flex">
                    <InputLabel for="last_name" value="شماره تماس">
                    </InputLabel>
                    <RequiredInput></RequiredInput>
                </div>

                <TextInput id="mobile" v-model="form.mobile" type="text" class="tw-mt-1 tw-block tw-w-full" autofocus
                    autocomplete="mobile" disabled />
                <InputError class="tw-mt-2" :message="error?.mobile ? error.mobile[0] : ''" />
            </div>

            <div>
                <div class="tw-flex">
                    <InputLabel for="title" value="تیتر">
                    </InputLabel>
                </div>

                <TextInput id="title" placeholder="تیتر را وارد کنید..." v-model="form.title" type="text"
                    class="tw-mt-1 tw-block tw-w-full" autofocus autocomplete="title" />
                <InputError class="tw-mt-2" :message="error?.title ? error.title[0] : ''" />
            </div>

            <div>
                <div class="tw-flex">
                    <label for="message"
                        class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-gray-400">پیام
                        شما</label>
                    <RequiredInput></RequiredInput>
                </div>

                <textarea id="message" v-model="form.message" rows="6"
                    class="tw-block tw-p-2.5 tw-w-full tw-text-sm tw-text-gray-900 tw-bg-gray-50 tw-rounded-lg tw-shadow-sm tw-border tw-border-gray-300 focus:tw-ring-primary-500 focus:tw-border-primary-500 dark:tw-bg-gray-700 dark:tw-border-gray-600 dark:tw-placeholder-gray-400 dark:tw-text-white dark:focus:tw-ring-primary-500 dark:focus:tw-border-primary-500"
                    placeholder="پیام را وارد کنید ..."></textarea>
                <InputError class="tw-mt-2" :message="error?.message ? error.message[0] : ''" />


        </div>


        <div class="tw-flex tw-justify-center">
            <TextInput id="title" v-model="captcha" placeholder="کپچا را وارد کنید..." type="text"
                class="tw-mt-1 tw-block tw-w-full" />

            <VueClientRecaptcha chars="abcdefghigkmnopqrstuvwxyz1234567890" :value="captcha" @getCode="getCaptchaCode" @isValid="checkValidCaptcha" />

        </div>
        
        <PrimaryButton type="submit" class="tw-ml-4" 
            :class="{ 'tw-opacity-25': form.processing }"
            :disabled="form.processing"
            >
            ارسال
            </PrimaryButton>

    </form>
</AuthenticationCard></template>