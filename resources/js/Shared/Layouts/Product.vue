<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  title: String,
  image: String,
  categories: Object,
  slug: String,
  id: String
})

</script>

<template>
  <div
    class="tw-relative tw-mx-auto tw-max-h-[500px] tw-m-10 tw-flex tw-w-full tw-max-w-xs tw-flex-col tw-overflow-hidden tw-rounded-lg tw-border tw-border-gray-100 tw-bg-white tw-shadow-md">
    <Link :href="`/filters/product/${id}`">
    <span class="tw-relative tw-mx-3 tw-mt-3 tw-flex tw-justify-center tw-h-60 tw-overflow-hidden tw-rounded-xl" href="#">
      <img class="tw-object-contain tw-h-[200px] tw-w-[200px]" :src="image" :alt="title" />
      <!-- <span class="tw-absolute tw-top-0 tw-left-0 tw-m-2 tw-rounded-full tw-bg-black tw-px-2 tw-text-center tw-text-sm tw-font-medium tw-text-white">39% OFF</span> -->
    </span>
    <div class="tw-mt-4 tw-px-5 tw-pb-5">
      <h5 class="tw-text-xl tw-tracking-tight tw-text-slate-900">{{ title }}</h5>

      <div class="tw-mt-2 tw-mb-5 tw-flex tw-items-center tw-justify-between">

      </div>

      <ul
        class="tw-mt-3 tw-divide-y tw-rounded tw-bg-gray-100 tw-py-2 tw-px-3 tw-text-gray-600 tw-hadow-sm hover:tw-text-gray-700 hover:tw-shadow">
        <li class="tw-flex tw-items-center tw-py-3 tw-text-sm">
          <span class="tw-ml-auto">
            <span v-for="category in categories" dir="rtl"
              class="tw-ml-1 tw-rounded-full tw-inline-block tw-bg-green-200 tw-py-1 tw-px-2 tw-text-xs tw-font-medium tw-text-green-700">
              {{ category.title }}
            </span>
          </span>
        </li>
      </ul>
    </div>
    </Link>

  </div>
</template>

