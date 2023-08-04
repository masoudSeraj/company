<script setup>
import { computed, onMounted, isRef } from 'vue';
import { Head, usePage  } from '@inertiajs/vue3';
import AuthenticationCard from '@/Shared/Layouts/Auth/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Shared/Layouts/Auth/AuthenticationCardLogo.vue';
import { routes } from '@/Shared/routes.js'
import axios from 'axios';
import { notification } from '@/notifications.ts'
import { useQuasar } from 'quasar'
import RequestCode from '@/Shared/Layouts/VerifyPhone/RequestCode.vue';
import SubmitCode from '@/Shared/Layouts/VerifyPhone/SubmitCode.vue';
import { useTimerStore } from '@/Shared/Stores/VerifyPhone/timer.js';
import { useUrlStore } from '@/Shared/Stores/url.js'
import Wrapper from '@/Shared/Layouts/Wrapper.vue';

const $q = useQuasar();
const timerStore = useTimerStore();
const urlStore = useUrlStore();

const userId = computed(() => {
    const id = usePage().props.auth?.user?.id ?? userIdQueryParam
    return isRef(id) ? id.value : id
})

urlStore.setUrl(window.location.href);
const searchParams = urlStore.queryParameters;


const userIdQueryParam = computed(() => {
    return searchParams.get('id');
})

const redirection = computed(() => {
    return searchParams?.get('redirection')  || import.meta.env.VITE_APP_URL || 'https://sunnyrlube.com/';
});

onMounted(()=>{
    if(userId.value){
        axios
        .get(routes().verification.request.path + '/' + userId.value)
        .then((response) => {
            timerStore.setTimer();
            notification($q, 'success', response.data.message)()
        })
        .catch((error) => {
            timerStore.setTimer(parseInt(error.response.headers['retry-after'] * 1000));
            notification($q, 'warning', error.response.data)()
        });
    }
})

</script>

<template>
    <Head title="تایید" />

    <Wrapper>
        <template #content>
            <AuthenticationCard>
                <template #logo>
                    <AuthenticationCardLogo />
                </template>

                <div class="tw-mb-4 tw-text-sm tw-text-gray-600 dark:tw-text-gray-400">
                    لطفا شماره تماس خود را تایید کنید.
                </div>

                <SubmitCode :redirection="redirection" :userId="userId"></SubmitCode>
                <RequestCode redirection="company.index" :userId="userId"></RequestCode>

            </AuthenticationCard>
        </template>
    </Wrapper>

</template>