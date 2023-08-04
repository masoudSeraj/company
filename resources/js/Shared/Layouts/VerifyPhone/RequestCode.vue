<script setup>
import { watch } from 'vue'
import { storeToRefs } from 'pinia';
import SecondaryButton from '@/Shared/Layouts/Auth/SecondaryButton.vue';
import VueCountdown from '@chenfengyuan/vue-countdown'
import { notification } from '@/notifications.ts'
import { useQuasar } from 'quasar';
import { useRequestStore }  from '@/Shared/Stores/VerifyPhone/request.js'
import { useTimerStore }  from '@/Shared/Stores/VerifyPhone/timer.js'
import { useSubmitStore }  from '@/Shared/Stores/VerifyPhone/submit.js'

const requestStore = useRequestStore();
const timerStore   = useTimerStore();
const submitStore  = useSubmitStore();
const $q = useQuasar();
let { totalMilliseconds } = storeToRefs(timerStore)

const props = defineProps({
    // status: String,
    redirection: {
        type: String,
        default: null
    },
    userId: {
        required: true
    }
})

const request = async () => {
    submitStore.submitting();

    try{
        timerStore.setTimer();
        submitStore.submitted();
        requestStore.disableRequest();
        
        const response = await requestStore
            .request(props.userId)
                        
        notification($q, 'success', response.data.message)()
    } catch(error) {
        timerStore.setTimer(parseInt(error.response.headers['retry-after']) * 1000);
        submitStore.submitted();
        notification($q, 'warning', error.response.data)()
    }
}

watch(totalMilliseconds, (value) => {
    if(value <= 2000){
        requestStore.enableRequest();
        timerStore.resetTimer();
    }
})

</script>

<template>
    <form @submit.prevent="request" class="tw-mt-2">
            <div dir="ltr">
                <SecondaryButton type="submit" >
                    <span class="tw-font-light tw-text-[.6rem] tw-mr-2">درخواست کد</span>
                    <span :class="{'hidden' : timerStore.timer == null}">
                        <VueCountdown @progress="(data) => timerStore.countdown(data.totalMilliseconds)" @end="timerStore.resetTimer" :time="timerStore.timer" v-slot="{ minutes, seconds }">
                            {{ minutes }} : {{ seconds }}
                        </VueCountdown>
                    </span>
                </SecondaryButton>
            </div>
        </form>
</template>