<script setup>
  import { useFilterStore } from '@/Shared/Stores/filter.js'

  const store = useFilterStore();
  const props = defineProps(['id', 'name'])
</script>
<template>
    <button class="tw-relative tw-mt-4 tw-bg-blue-700 hover:tw-bg-blue-800 tw-duration-300 tw-py-2 tw-px-4 tw-text-blue-100 tw-rounded">{{ props.name }}
      <!-- <span @click="store.removeCategory(props.id)" class="tw-absolute tw-bg-gray-900 tw-text-gray-100 tw-px-2 tw-py-1 tw-text-xs tw-font-bold tw-rounded-full tw--top-3 tw--right-3">x</span> -->
    </button>
</template>
