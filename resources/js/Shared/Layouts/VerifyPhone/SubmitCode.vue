<script setup>
import { computed, ref } from 'vue'
import PrimaryButton from '@/Shared/Layouts/Auth/PrimaryButton.vue';
import OtpInput from '@/Shared/Layouts/Auth/OtpInput.vue';
import { useSubmitStore } from '@/Shared/Stores/VerifyPhone/submit.js';
import { notification } from '@/notifications.ts'
import { useQuasar } from 'quasar';
import { router } from '@inertiajs/vue3';


const submitStore = useSubmitStore();
const $q = useQuasar();


const digits = ref(null);
const digitsLength = computed(() => digits.value?.toString().length === 5)

const props = defineProps({
    userId: {
        required: true
    },
    redirection: {
        type: String,
        default: null
    },
})

async function submitForm() { 
    try{
        submitStore.submitting();
        const response = await submitStore
            .submit(digits.value, props.userId, props.redirection)
        submitStore.submitted();
        notification($q, 'success', response.data.message)();

        router.visit(props.redirection, {
            method: 'GET',
        })
    }

    catch(error){
        console.log(error)
        submitStore.submitted();
            if(error.response.status === 429){
                notification($q, 'error', error.response.data)()
                return;
            }
            notification($q, 'warning', error.response.data.message)()
        }
}
</script>

<template>
    <form @submit.prevent="submitForm">
            <div class="tw-flex tw-items-center tw-justify-between tw-mt-4">

                <OtpInput v-model="digits" :fields="5"></OtpInput>

                <PrimaryButton :disabled="!digitsLength || submitStore.isSubmitting" class="tw-max-w-[140px]"                  
                >
                    تایید
                </PrimaryButton>
            </div>
        </form>
</template>