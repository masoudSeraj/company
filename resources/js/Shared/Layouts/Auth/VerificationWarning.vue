<script setup>
import { ref, onMounted, computed } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import { routes } from '@/Shared/routes.js'

const props = defineProps({
  message: String,
  link: {
    required: false,
    type: String
  },
  color: {
    required: false,
    type: String
  }
})

let close = ref(false)

const closeBanner = () => {
  close.value = true;
}

const message = computed(() => props.message || 'برای استفاده از امکانات کامل سایت لطفا اکانت خود را فعال نمایید!')

onMounted(() => {
  (usePage().props.auth.isActive && usePage().props.auth.user) ? close.value = true : close.value = false
})
</script>

<template>
  
  <div :class="{ 'tw-hidden': !close }"
    class="tw-fixed tw-shadow-md tw-bg-white tw-overflow-y-scroll tw-scrollbar-thin tw-bottom-2 tw-right-2 tw-break-words tw-w-64 tw-h-36 tw-z-20"
    dir="rtl">
    <div @click="closeBanner" class="tw-mt-3 md:mt-0 md:ml-2">
        <button
          class="tw-inline-block tw-ml-4 tw-rounded-md tw-text-lg tw-font-semibold tw-text-blue-500">
          &times;
        </button>
    </div>

    <div class="tw-inline-flex tw-flex-wrap tw-gap-2 tw-px-4">
      <div class="tw-text-xl tw-font-semibold">
        <div class="tw-text-gray-900 tw-text-xs px-6 py-2">
          {{ message }}
        </div>
      </div>
    </div>
    <div class="tw-inline-flex tw-text-light tw-mt-4 tw-ml-4 tw-items-center tw-px-4 tw-py-2 tw-bg-gray-800 dark:bg-gray-200 tw-border tw-border-transparent tw-rounded-md tw-font-semibold tw-text-xs tw-text-white dark:tw-text-gray-800 tw-uppercase tw-tracking-widest hover:tw-bg-gray-700 dark:hover:tw-bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:tw-ring-offset-gray-800 tw-transition tw-ease-in-out tw-duration-150">
      <Link :class="{hidden : (link == 'undefined' || link === null) }" :href="routes().verification.request.path">فعال‌سازی</Link>
    </div>
  </div>
</template>

