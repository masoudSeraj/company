<script setup>
import { ref } from "vue";
import { useFilterStore } from '@/Shared/Stores/filter.js'
import { storeToRefs } from 'pinia'
import Checkbox from "@/Shared/Layouts/Checkbox.vue";
import Textbox from "@/Shared/Layouts/Textbox.vue";
import { router } from '@inertiajs/vue3'

const emit = defineEmits(["update:check", 'checkedBox']);
const props = defineProps({
    category: Object,
});

const store = useFilterStore();
// const { checkSelection } = storeToRefs(store)
const checkSelection = ref([]);
const textSearch = ref([]);

let children = ref();
let mainChildren = props.category.children.data;
children = props.category.children.data;

function updateText(event) {
    children = mainChildren.filter((child) => {
        return child.title.includes(event)
    });
}
</script>

<template>
    <div class="tw-flex tw-border-b tw-pb-5 tw-mb-5">
        <div class="tw-w-full">
            <div class="">
                <Textbox v-model:text="textSearch" :label="category.parent" @update:text="updateText">
                    <template #icon>
                        <q-icon name="search" />
                    </template>
                </Textbox>
            </div>
            <div
                class="tw-max-h-[400px] tw-h-auto tw-scrollbar-thumb-gray-900 tw-scrollbar-track-gray-100
                 tw-scrollbar-thin tw-overflow-y-scroll">
                <div class="tw-flex tw-items-end tw-w-full tw-justify-between tw-pr-6 tw-h-12"
                    v-for="(child, index) in children" :class="{ 'hidden': !child.products_count }" >
                    <Checkbox :key="parseInt((category.id).toString() + (child.id).toString())"
                        v-model:check="checkSelection" 
                        @update:check="emit('checkedBox', {'id': child.id, 'name': child.title})"
                        :checked="store.checkedValue(child.id)"
                        :label="child.title">
                        <span class="tw-ml-2">{{ child.title }}</span> 
                    </Checkbox>
                    <div >
                        <p class="tw-text-gray-500 tw-text-sm tw-mb-3">{{ child.products_count }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
