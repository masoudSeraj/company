<script setup>
import { onMounted, ref } from 'vue'
import Wrapper from '@/Shared/Layouts/Wrapper.vue';
import { usePage } from '@inertiajs/vue3'
import Gallery from '@/Pages/ProductFilter/Partials/Gallery.vue'
import {  useFilterStore  } from '@/Shared/Stores/filter.js'

const store = useFilterStore();

onMounted(() => {
    console.log(showDescription())
})

function showDescription()
{    
    if(usePage().props.product.data.description[0] === '&')
    {
        return store.decodeHTMLEntities(usePage().props.product.data.description)
    }
    else
    {
        return usePage().props.product.data.description
    }
    // store.decodeHTMLEntities(usePage().props.product.data.description)
    // let elements = []

    // for(let i=0; i<10; i++){
    //     elements.push(usePage().props.product.data.description[i]);
    // }
    // return elements;
}



</script>

<template>
    <Wrapper #content>
        <div class="tw-leading-[1.6rem] tw-font-primary" dir="rtl" >
            <div class="tw-container tw-grid tw-grid-cols-12 tw-gap-6 tw-mx-auto">
                <Gallery class="md:tw-col-span-6 tw-col-span-12 tw-h-[400px] tw-max-h-[600px]" :images="usePage().props.product.data.gallery">

                </Gallery>

                <div class="tw-bg-white tw-col-span-12 md:tw-col-span-6 tw-py-20 tw-px-12 tw-rounded-lg">
                    <h2 class="tw-text-3xl tw-font-medium tw-uppercase tw-mb-2">{{ usePage().props.product.data.title }}
                    </h2>
                    <div class="tw-space-y-2">
                        <p class="tw-text-gray-800 tw-font-semibold tw-space-x-2">
                            <span>امکان سفارش: </span>
                            <span class="tw-text-green-600">قابل سفارش</span>


                        </p>
                        <p class="tw-space-x-2">
                            <span class="tw-text-gray-800 tw-font-semibold">برند: </span>
                            <span class="tw-text-gray-600">{{ usePage().props.product.data.brand }}</span>
                        </p>
                        <p class="tw-space-x-2">
                            <span class="tw-text-gray-800 tw-font-semibold">دسته بندی: </span>
                            <span class="tw-text-gray-600">
                                <span v-for="category in usePage().props.product.data.categories.children" dir="rtl"
                                    class="tw-ml-1 tw-rounded-full tw-inline-block tw-bg-green-200 tw-py-1 tw-px-2 tw-text-xs tw-font-medium tw-text-green-700">
                                    {{ category.title }}
                                </span>

                            </span>
                        </p>

                    </div>

                    <p class="tw-mt-4 tw-text-gray-600">{{ usePage().props.product.data.short_description }}</p>

                    <div class="tw-flex tw-gap-3 tw-mt-4">

                        <ShareNetwork network="telegram" :url="usePage().props.product.data.url"
                            :title="usePage().props.product.data.title"
                            :description="usePage().props.product.data.short_description"
                            :hashtags="usePage().props.product.data.categories.children.join()">
                            <div
                                class="tw-text-blue-400 hover:tw-bg-blue-400 hover:tw-text-white tw-h-8 tw-w-8 tw-rounded-full tw-border tw-border-blue-400 tw-flex tw-items-center tw-justify-center">
                                <span class='bx bxl-telegram'></span>
                            </div>
                        </ShareNetwork>

                        <ShareNetwork network="whatsapp" :url="usePage().props.product.data.url"
                            :title="usePage().props.product.data.title"
                            :description="usePage().props.product.data.short_description"
                            :hashtags="usePage().props.product.data.categories.children.join()">
                            <div
                                class="tw-text-green-700 hover:tw-bg-green-700 hover:tw-text-white tw-h-8 tw-w-8 tw-rounded-full tw-border tw-border-green-700 tw-flex tw-items-center tw-justify-center">
                                <span class='bx bxl-whatsapp'></span>
                            </div>

                        </ShareNetwork>

                    </div>
                </div>
            </div>

            <div class="tw-container tw-mx-auto tw-pb-16 tw-bg-white tw-rounded-lg tw-py-12 tw-px-8 tw-my-8">
                <h3 class="border-b tw-pb-3 tw-font-medium tw-text-gray-800 tw-border-gray-200 tw-font-roboto">توضیحات محصول
                </h3>
                <div class="tw-pt-6 tw-overflow-y-hidden tw-overflow-x-scroll tw-scrollbar tw-scrollbar-thumb-gray-900 tw-scrollbar-track-gray-100">
                    <div class="tw-text-gray-600" v-html="showDescription()">
                    </div>
                </div>
            </div>
        </div>
    </Wrapper>
</template>

<style>
    body h1{
        font-size: 4rem !important;
        font-weight: bold;
    }
    body h2{
        font-size: 2.5rem;
    }
    body h3{
        font-size: 2rem;
    }
</style>