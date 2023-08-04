<script setup>
import { computed } from 'vue'
import Wrapper from '@/Shared/Layouts/Wrapper.vue'

const props = defineProps({ status: Number })

const title = computed(() => {
  return {
    503: '503: سرویس در دسترس نیست!!!!!!!!',
    500: '500: خطای سرور!!!!!!!!',
    404: '404: صفحه پیدا نشد!!!!!!!!',
    403: '403: دسترسی غیر مجاز!!!!!!!!',
    429: '429: !تعداد درخواست های بیش از اندازه',
  }[props.status]
})

const description = computed(() => {
  return {
    503: 'ما در حال اجرای برخی بهبودها هستیم لطفا بعدا تلاش کنید!',
    500: 'اشکالی در سمت سرورهای ما رخ داد!',
    404: 'صفحه مورد نظر شما پیدا نشد!',
    403: 'دسترسی غیر مجاز است!',
    429: 'تعداد دفعات درخواست بیش از حد مجاز است!',
  }[props.status]
})
</script>

<template>
  <Wrapper>
      <template #content>
        <div class="tw-flex tw-justify-center tw-mx-auto tw-text-center">
          <div class="tw-p-6 tw-my-6 tw-bg-white tw-shadow-md tw-rounded-lg">
            <h1>{{ title }}</h1>
            <div>{{ description }}</div>
          </div>
        </div>
      </template>
  </Wrapper>

</template>