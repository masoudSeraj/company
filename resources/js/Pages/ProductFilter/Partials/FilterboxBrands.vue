<script setup>
import { ref } from "vue";
import { useFilterStore } from '@/Shared/Stores/filter.js'
import Checkbox from "@/Shared/Layouts/Checkbox.vue";
import Textbox from "@/Shared/Layouts/Textbox.vue";

const emit = defineEmits(["update:check", 'checkedBox', 'checkedBrandBox']);
const props = defineProps({
    brands: Object,
});

const store = useFilterStore();

const checkSelectionBrand = ref([]);
const textSearch = ref([]);

let brands = ref();
let mainbrand = props.brands.data;
brands = props.brands.data;

function updateText(event) {
    brands = mainbrand.filter((brand) => {
        return brand.title.includes(event)
    });
}
</script>

<template>
    <div class="tw-flex tw-border-b tw-pb-5 tw-mb-5">
        <div class="tw-w-full">
            <div class="">
                <Textbox v-model:text="textSearch" label="جستجوی برند" @update:text="updateText">
                    <template #icon>
                        <q-icon name="search" />
                    </template>
                </Textbox>
            </div>
            <div
                class="tw-max-h-[400px] tw-h-auto tw-scrollbar-thumb-gray-900 tw-scrollbar-track-gray-100
                 tw-scrollbar-thin tw-overflow-y-scroll">
                <div class="tw-flex tw-items-end tw-w-full tw-justify-between tw-pr-6 tw-h-12"
                    v-for="(brand, index) in brands"
                    >
                    <Checkbox 
                        :key="brand.id"
                        v-model:check="checkSelectionBrand" 
                        @update:check="emit('checkedBrandBox', {'id': brand.id, 'name': brand.title})"
                        :checked="store.checkedValueBrand(brand.id)"
                        :label="brand.title">
                        <span class="tw-ml-2">{{ brand.title }}</span> 
                    </Checkbox>
                    <div>
                        <p class="tw-text-gray-500 tw-text-sm tw-mb-3">{{ brand.products_count }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
