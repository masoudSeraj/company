<script setup>
import { computed, reactive } from 'vue'
import { usePage, Head } from '@inertiajs/vue3';
import AuthenticationCard from '@/Shared/Layouts/Auth/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Shared/Layouts/Auth/AuthenticationCardLogo.vue';

// import ContactusIndexGuest from '@/Pages/Contactus/ContactusIndexGuest.vue';
// import { computed, onMounted, isRef } from 'vue';
import InputError from '@/Shared/Layouts/Auth/InputError.vue';
import InputLabel from '@/Shared/Layouts/Auth/InputLabel.vue';
import PrimaryButton from '@/Shared/Layouts/Auth/PrimaryButton.vue';
import TextArea from '@/Shared/Layouts/Auth/TextArea.vue';
import Wrapper from '@/Shared/Layouts/Wrapper.vue';
import RequiredInput from '@/Shared/Layouts/Auth/RequiredInput.vue';
import TextInput from '@/Shared/Layouts/Auth/TextInput.vue';
import { notification } from '@/notifications.ts';
import { useQuasar } from 'quasar';
import axios from 'axios';

const $q = useQuasar();


const form = reactive({
    'name': null,
    'lastname': null,
    'mobile': null,
    'company_name': null,
    'company_number': null,
    'position': null,
    'description': null,
    'processing': null,
    'errors': null
})

const error = computed(() => {
    if (form.errors?.errors) {
        // console.log(form.errors.errors.company_number);
        return form?.errors.errors;
    }
    return null;
})

const submit = () => {
    form.processing = true;
    axios
        .post('/company/register-user-as-agent', {
            id: usePage().props.auth.user.id,
            name: form.name,
            mobile: form.mobile,
            description: form.description,
            company_number: form.company_number,
            company_name: form.company_name,
            position: form.position
        })
        .then((response) => {
            form.processing = false
            notification($q, 'success', response.data.success)();
            return window.location.href = response.data.redirect;

        })
        .catch((error) => {
            form.errors = error.response.data
            return;
        })
        .finally(() => form.processing = false)
};

form.name = usePage().props.auth.user.first_name + ' ' + usePage().props.auth.user.last_name;
form.mobile = usePage().props.auth.user.username;

</script>


<template>
    <Head title="ثبت نام" />
    <Wrapper>
        <template #content>

            <AuthenticationCard>
                <template #logo>
                    <AuthenticationCardLogo />
                </template>

                <form @submit.prevent="submit">
                    <div>
                        <div class="tw-flex">
                            <InputLabel for="name" value="نام">
                            </InputLabel>
                            <RequiredInput></RequiredInput>
                        </div>

                        <TextInput id="name" v-model="form.name" type="text" class="tw-mt-1 tw-block tw-w-full" required
                            autofocus autocomplete="name" disabled />
                        <InputError class="tw-mt-2" :message="error?.name ? error.name[0] : ''" />
                    </div>

                    <div class="tw-mt-4">
                        <div class="tw-flex">
                            <InputLabel for="mobile" value="شماره تماس ثبت نام کننده" />
                            <RequiredInput></RequiredInput>
                        </div>

                        <TextInput id="mobile" v-model="form.mobile" type="text" disabled class="tw-mt-1 tw-block tw-w-full"
                            required autocomplete="mobile" />
                        <InputError class="tw-mt-2" :message="error?.mobile ? error.mobile[0] : ''" />
                    </div>

                    <div class="tw-mt-4">
                        <div class="tw-flex">
                            <InputLabel for="company_name" value="نام کارخانه/شرکت" />
                            <RequiredInput></RequiredInput>
                        </div>   
                        <TextInput id="company_name" v-model="form.company_name" type="text" class="tw-mt-1 tw-block tw-w-full" required
                            autocomplete="company_name" />
                                                 
                        <InputError class="tw-mt-2" :message="error?.company_name ? error.company_name[0] : ''" />
                    </div>

                    <div class="tw-mt-4">
                        <div class="tw-flex">
                            <InputLabel for="company_number" value="شماره تماس سازمان" />
                            <RequiredInput></RequiredInput>
                        </div>
                        <TextInput id="company_number" v-model="form.company_number" type="text"
                            class="tw-mt-1 tw-block tw-w-full" required autocomplete="company_number" />

                        <InputError class="tw-mt-2" :message="error?.company_number ? error.company_number[0] : ''" />
                    </div>

                    <div class="tw-mt-4">
                        <div class="tw-flex">
                            <InputLabel for="position" value="پست سازمانی" />
                            <RequiredInput></RequiredInput>
                        </div>


                        <TextInput id="position" v-model="form.position" type="text" class="tw-mt-1 tw-block tw-w-full"
                            required autocomplete="position" />
                        <InputError class="tw-mt-2" :message="error?.position ? error.position[0] : ''" />
                    </div>


                    <div class="tw-mt-4">
                        <div class="tw-flex">
                            <InputLabel for="description" value="نام و آدرس کارخانه" />
                            <RequiredInput></RequiredInput>
                        </div>

                        <TextArea id="description" v-model="form.description" class="tw-mt-1 tw-block tw-w-full" />
                        <InputError class="tw-mt-2" :message="error?.description ? error.description[0] : ''" />
                    </div>

                    <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
                        <PrimaryButton class="tw-ml-4" :class="{ 'tw-opacity-25': form.processing }"
                            :disabled="form.processing">
                            ثبت شرکت
                        </PrimaryButton>
                    </div>
                </form>
            </AuthenticationCard>
        </template>
    </Wrapper>
</template>