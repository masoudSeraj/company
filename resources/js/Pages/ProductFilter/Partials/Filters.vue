<script setup>
import { ref, nextTick } from "vue";
import Filterbox from '@/Pages/ProductFilter/Partials/Filterbox.vue'
import FilterboxBrands from '@/Pages/ProductFilter/Partials/FilterboxBrands.vue'
import { useFilterStore } from "@/Shared/Stores/filter.js";

const store = useFilterStore();


let selected = ref([]);

defineProps({
  categories: {
    type: Object
  },
  brands:{
    type: Object
  }
})

function checkedBox(event) {   
  if(store.checkSelection.findIndex(element => element.id === event.id)  === -1){
      store.setCheckSelection(event)
      localStorage.setItem(event.id, JSON.stringify(event))
    }
    else{
      store.removeCheckSelection(event.id)
      localStorage.removeItem(event.id)
    }
    store.updateFilter();
}

function checkedBrandBox(event){
  if(store.checkSelectionBrand.findIndex(element => element.id === event.id)  === -1){
      store.setCheckSelectionBrand(event)
      localStorage.setItem(event.id, JSON.stringify(event))
    }
    else{
      store.removeCheckSelectionBrand(event.id)
      localStorage.removeItem(event.id)
    }
    store.updateFilter();
}

function productCount(children)
{
  return children.every(child => child.products_count === 0 )
}

</script>

<template>
  <section
    :class="{'tw-translate-x-[0px]': store.toggler, 'tw-translate-x-[500px]': !store.toggler}"
    class="tw-w-[300px] tw-flex-shrink-0 tw-px-4 
        tw-absolute lg:tw-opacity-1 lg:tw-relative lg:tw-translate-x-0 
        tw-transition tw-translate-x-[0px] tw-shadow-lg tw-bg-white tw-z-[10] lg:tw-block"
        >
    <div :class="{ 'hidden': !store.checkboxWatcher.length }" @click="store.flushSelection(); store.updateFilter()" class="tw-flex tw-justify-around tw-text-red-600 tw-mb-4 tw-cursor-pointer">
      <div>حذف فیلترها</div>
      <div>x</div>
    </div>
    <FilterboxBrands :brands="brands" @checkedBrandBox="checkedBrandBox"></FilterboxBrands>
    <Filterbox v-for="(category, index) in categories" :key="category.id" :category="category" :class="{ 'hidden' : ! category.children.data.length || productCount(category.children.data) }" @checkedBox="checkedBox"></Filterbox>
  </section>
</template>

<style scoped>
.q-field__inner .q-field--standout .q-field__control {
  padding: 0 !important;
}
</style>