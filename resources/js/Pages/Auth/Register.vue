<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Shared/Layouts/Auth/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Shared/Layouts/Auth/AuthenticationCardLogo.vue';
import InputError from '@/Shared/Layouts/Auth/InputError.vue';
import InputLabel from '@/Shared/Layouts/Auth/InputLabel.vue';
import PrimaryButton from '@/Shared/Layouts/Auth/PrimaryButton.vue';
import TextInput from '@/Shared/Layouts/Auth/TextInput.vue';
import TextArea from '@/Shared/Layouts/Auth/TextArea.vue'
import { routes } from '@/Shared/routes.js'
import Wrapper from '@/Shared/Layouts/Wrapper.vue'
import RequiredInput from '@/Shared/Layouts/Auth/RequiredInput.vue';

const form = useForm({
    name: '',
    lastname: '',
    username: '',
    company_name: '',
    company_number: '',
    description: '',
    position: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(routes().register.store.path, {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
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
                            <InputLabel for="name" value="نام" >
                            </InputLabel>
                            <RequiredInput></RequiredInput>
                        </div>

                        <TextInput id="name" v-model="form.name" type="text" class="tw-mt-1 tw-block tw-w-full" required
                            autofocus autocomplete="name" />
                        <InputError class="tw-mt-2" :message="form.errors.name" />
                    </div>

                    <div class="tw-mt-4">
                        <div class="tw-flex">
                            <InputLabel for="lastname" value="نام خانوادگی" />
                            <RequiredInput></RequiredInput>
                        </div>
                        
                        <TextInput id="lastname" v-model="form.lastname" type="text" class="tw-mt-1 tw-block tw-w-full"/>
                        <InputError class="tw-mt-2" :message="form.errors.lastname" />
                    </div>

                    <div class="tw-mt-4">
                        <div class="tw-flex">
                            <InputLabel for="username" value="شماره تماس ثبت نام کننده" />
                            <RequiredInput></RequiredInput>
                        </div>
                        
                        <TextInput id="username" v-model="form.username" type="text" class="tw-mt-1 tw-block tw-w-full" required
                            autocomplete="username" />
                        <InputError class="tw-mt-2" :message="form.errors.username" />
                    </div>

                    <div class="tw-mt-4">
                        <div class="tw-flex">
                            <InputLabel for="company_name" value="نام کارخانه/شرکت" />
                            <RequiredInput></RequiredInput>
                        </div>   
                        <TextInput id="company_name" v-model="form.company_name" type="text" class="tw-mt-1 tw-block tw-w-full" required
                            autocomplete="company_name" />
                                                 
                        <InputError class="tw-mt-2" :message="form.errors.company_name" />
                    </div>


                    <div class="tw-mt-4">
                        <div class="tw-flex">
                            <InputLabel for="company_number" value="شماره تماس سازمان (به همراه پیش شماره)" />
                            <RequiredInput></RequiredInput>
                        </div>   
                        <TextInput id="company_number" v-model="form.company_number" type="text" class="tw-mt-1 tw-block tw-w-full" required
                            autocomplete="company_number" />
                                                 
                        <InputError class="tw-mt-2" :message="form.errors.company_number" />
                    </div>

                    <div class="tw-mt-4">
                        <div class="tw-flex">
                            <InputLabel for="position" value="پست سازمانی" />
                            <RequiredInput></RequiredInput>
                        </div>


                        <TextInput id="position" v-model="form.position" type="text" class="tw-mt-1 tw-block tw-w-full" required
                            autocomplete="position" />
                        <InputError class="tw-mt-2" :message="form.errors.position" />
                    </div>

                    
                    <div class="tw-mt-4">
                        <div class="tw-flex">
                            <InputLabel for="description" value="نام و آدرس کارخانه" />
                            <RequiredInput></RequiredInput>
                        </div>
                        
                        <TextArea id="description" v-model="form.description" 
                            class="tw-mt-1 tw-block tw-w-full" />
                        <InputError class="tw-mt-2" :message="form.errors.description" />
                    </div>

                    <div class="tw-mt-4">

                        <div class="tw-flex">
                            <InputLabel for="password" value="رمز عبور" />
                            <RequiredInput></RequiredInput>
                        </div>
                        <TextInput id="password" v-model="form.password" type="password" class="tw-mt-1 tw-block tw-w-full"
                            required autocomplete="new-password" />
                        <InputError class="tw-mt-2" :message="form.errors.password" />
                    </div>

                    <div class="tw-mt-4">
                        <div class="tw-flex">
                            <InputLabel for="password_confirmation" value="تایید رمز عبور" />
                            <RequiredInput></RequiredInput>
                        </div>

                        <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                            class="tw-mt-1 tw-block tw-w-full" required autocomplete="new-password" />
                        <InputError class="tw-mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
                        <Link :href="routes().login.create.path"
                            class="tw-underline tw-text-sm tw-text-gray-600 dark:tw-text-gray-400 hover:tw-text-gray-900 dark:hover:tw-text-gray-100 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 dark:focus:tw-ring-offset-gray-800">
                        در حال حاضر ثبت نام کردید؟
                        </Link>

                        <PrimaryButton class="tw-ml-4" :class="{ 'tw-opacity-25': form.processing }"
                            :disabled="form.processing">
                            ثبت نام
                        </PrimaryButton>
                    </div>
                </form>
            </AuthenticationCard>
        </template>
    </Wrapper>
</template>
