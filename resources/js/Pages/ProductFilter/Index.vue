<script setup>
import { onMounted, onBeforeMount } from 'vue'
import {  usePage, router  } from "@inertiajs/vue3"
import Wrapper from '@/Shared/Layouts/Wrapper.vue';
import Products from '@/Pages/ProductFilter/Partials/Products.vue'
import { useFilterStore } from '@/Shared/Stores/filter.js'

const store = useFilterStore();

</script>

<template>
    <Wrapper>
        <template #content>
            <main class="tw-container tw-mx-auto tw-min-h-screen">
                <section class="tw-min-h-screen tw-bg-white tw-rounded-md tw-shadow-md tw-my-7">
                    <Products 
                        :products="$page.props.products" 
                        :categories="$page.props.categories"
                        :brands="$page.props.brands"
                        >
                    </Products>
                </section>
            </main> 
        </template>
    </Wrapper>
</template>