<script setup>
import { storeToRefs } from 'pinia'
import { ref, reactive, watch, onMounted, computed } from 'vue'
import PopupSelectedCategory from '@/Pages/ProductFilter/Partials/PopupSelectedCategory.vue'
import { useFilterStore } from '@/Shared/Stores/filter.js'

const store = useFilterStore();

const { checkSelection, checkSelectionBrand, checkboxWatcher } = storeToRefs(store);

watch([checkSelection, checkSelectionBrand],
  ([selected, selectedBrand], [oldSelected, oldSelectedBrand]) => {
    store.setCheckboxWatcher(reactive([...selected, ...selectedBrand]));
  },
  {
    deep: true
  })
</script>

<template>
  <div @click="store.hideCategoryBox()" :class="{ 'hidden': store.isCategoryBoxHidden }"
    class="tw-fixed tw-cursor-pointer tw-z-10 tw-bottom-[140px] tw-right-[210px] tw-inline-block tw-font-lg tw-text-red-600">
    <i class='bx bx-x-circle tw-text-2xl'></i>
  </div>

  <div :class="{ 'hidden': store.isCategoryBoxHidden }"
    class="tw-fixed tw-shadow-md tw-bg-white tw-overflow-y-scroll tw-scrollbar-thin tw-bottom-2 tw-right-2 tw-break-words tw-w-52 tw-h-36 tw-z-10"
    dir="rtl">
    <div class="tw-inline-flex tw-flex-wrap tw-gap-2 tw-px-4">
      <PopupSelectedCategory v-for="box in checkboxWatcher" :id="box.id" :name="box.name" :key="box.id">
      </PopupSelectedCategory>
    </div>
  </div>

  <div @click="store.showCategoryBox()" class="tw-fixed tw-bottom-2 tw-right-2 tw-z-10"
    :class="{ 'hidden': !store.isCategoryBoxHidden }">
    <button
      class="tw-relative tw-bg-blue-700 hover:tw-bg-blue-800 tw-duration-300 tw-py-2 tw-px-4 tw-text-blue-100 tw-rounded-lg">
      <span
      class="tw-absolute tw-text-white tw-bg-red-700 tw-rounded-full tw-px-2 tw-py-1 tw-text-xs tw--top-3 tw--left-3">{{
      checkboxWatcher.length }}</span>

    دسته بندی های انتخاب شده
  </button>
</div></template>