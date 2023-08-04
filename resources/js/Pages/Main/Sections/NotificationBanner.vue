<script setup>
import { ref } from 'vue'
let close = ref(false)

function closeBanner()
{
    close.value = true;
}

</script>

<template>
    <div :class="{ 'tw-hidden' : close }">
      <div
        class="tw-text-center tw-flex tw-flex-col tw-p-4 md:tw-text-left md:tw-flex-row md:tw-items-center md:tw-justify-between md:tw-p-4 tw-bg-purple-100"
        id="messageModal"
      >
        <div class="tw-text-xl tw-font-semibold">
          <div class="tw-text-gray-900">
            وب سایت در حال توسعه است.
          </div>
        </div>

        <div @click="closeBanner" class="tw-mt-3 md:mt-0 md:ml-2">
          <button 
            class="tw-inline-block tw-rounded-md tw-text-lg tw-font-semibold tw-py-2 tw-px-4 tw-text-white tw-bg-purple-500"
          >
          &times;
          </button>
        </div>
      </div>
    </div>
</template>

