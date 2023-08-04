<script setup>
import { ref, nextTick, getCurrentInstance, onMounted }  from 'vue'
import { router } from '@inertiajs/vue3'
import Product from '@/Shared/Layouts/Product.vue'
import Pagination from '@/Shared/Layouts/Pagination.vue'
import Filters from '@/Pages/ProductFilter/Partials/Filters.vue'
import { useFilterStore } from '@/Shared/Stores/filter.js'
import Textbox from '@/Shared/Layouts/Textbox.vue'
import PopupSelected from '@/Pages/ProductFilter/Partials/PopupSelected.vue'
import axios from 'axios'

const options = [
  {
    'label' : 'صعودی',
    'value': 'asc'  
  },
  {
    'label' : 'نزولی',
    'value' : 'desc'
  }
];

const store = useFilterStore();

defineProps({
    products: {
        type: Object
    },
    categories: {
        type: Object
    },
    brands:{
      type: Object
    }
})
const selected = ref(null)
const textSearch = ref(null)
// let selectionObject = ref([])

async function selectUpdated(event)
{
  await nextTick(()=>{
    store.updateSort(event.value);
  })
  store.updateFilter();
}

async function searchText(textSearch)
{
  await nextTick(()=>{
    store.searchText(textSearch);
  })
  
  store.updateFilter();
}
onMounted(() => {
  store.setCurrentUrl(window.location.href);
  if(!!store.currentSearchParams.get('checkSelection')){
    axios.get(`/api/categories/${store.currentSearchParams.get('checkSelection')}`).then((response) =>  {
      response.data.data.map((element) => {
        return store.setCheckSelection({ 'id': element.id, 'name': element.title }) 
      })
    }
  )}

  if(!!store.currentSearchParams.get('checkSelectionBrand')){
    axios.get(`/api/brands/${store.currentSearchParams.get('checkSelectionBrand')}`).then((response) => {
      response.data.data.map((element) => {
        return store.setCheckSelectionBrand({ 'id': element.id, 'name': element.title }) 
      })
    }
  )}

})

router.on('finish', (event) => {
  store.setCurrentUrl(event.detail.visit.url);
  // store.checkSelectionQueryExists ?? store.setCheckSelection([]);
})

function refreshProducts()
{
  store.search='';
  store.updateFilter()
}

</script>

<template>
  <PopupSelected></PopupSelected>

    <section
      class="tw-container tw-mx-auto tw-border-b tw-py-5 lg:tw-px-5 lg:tw-flex lg:tw-flex-row lg:tw-py-10"
    >
      <Filters :categories="categories" :brands="brands"></Filters>

      <div class="tw-w-full">

        <span>
          <button @click='store.filterTogller()' :class="{ 'tw-translate-x-[-280px]': store.toggler }" 
            class="tw-block tw-transition lg:tw-hidden tw-ml-5 tw-mb-5 tw-bg-blue-500 tw-text-white tw-min-w-[48px] tw-min-h-[48px] tw-z-[100]">
            <i :class="{'hidden': store.toggler}" class="bx tw-text-lg bx-menu menu-toggle clr-transition"></i>
            <i  :class="{'hidden' : !store.toggler }" class='bx bx-x tw-text-lg'></i>
          </button>
        </span>

        <div class="tw-mb-5 tw-flex tw-items-center tw-justify-between tw-px-5">
          
          <div class="tw-flex tw-gap-3 tw-w-[150px] sm:tw-w-[200px]">
            
            <!-- <Selectbox class="tw-w-[200px]" v-model:select="selected" label="مرتب سازی" :options="[1, 2]" @update:select="selectUpdated"></Selectbox> -->
            <q-select 
              class="tw-w-[200px]"
              v-model="selected"
              standout 
              :options='options'
              label="مرتب سازی"
              @update:model-value="selectUpdated"
              />
          </div>       

          <div class="tw-w-[200px] sm:tw-w-[300px] tw-inline-flex tw-items-center">
            <span @click="refreshProducts()" 
              :class="{ 'tw-inline-block' : store.searchQueryExists, 'tw-hidden' : !store.searchQueryExists }" 
              class="tw-text-red-500 tw-cursor-pointer tw-mr-5 tw-text-lg"> 
              &times; </span> 

            <Textbox
                @keydown.enter="searchText(textSearch)" 
                v-model:text="textSearch"
                label="جستجوی روانکار"
                bgColor="blue-1"
                >
                <template #icon>
                    <q-icon name="search"/>
                </template>

                <template #button>
                  <q-btn @click="searchText(textSearch)" round dense flat icon="send" />
                </template>
            </Textbox>
          </div>
        </div>

        <section
          class="tw-mx-auto tw-grid tw-max-w-[1200px] tw-gap-3 tw-px-5 tw-pb-10 tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3"
        >
            <Product 
                v-for="product in $page.props.products.data" 
                :key="product.id"
                :title="product.title"
                :image="product.image"
                :categories="product.categories.children"
                :slug="product.slug"
                :id="product.id"
                 >
            </Product>

          <!-- 2 -->

        </section>
        <Pagination :data="products"></Pagination>
      </div>
    </section>
</template>