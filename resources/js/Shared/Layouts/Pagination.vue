<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    data: Object
})
</script>

<template>
    <div
        v-if="data.meta.links.length > 3"
        class="flex justify-center mt-4 space-x-4"
    >
        <Link
            v-for="(link, k) in data.meta.links"
            :key="k"
            class="tw-px-4 tw-py-3 tw-text-sm tw-leading-4 tw-rounded hover:tw-bg-white focus:tw-text-indigo-500 hover:tw-shadow"
            :class="{ 'tw-bg-indigo-400 tw-text-white': link.active, 'tw-bg-white'  : ! link.active}"
            :href="link.url ?? ''"
            v-html="link.label"
            preserveState
        />

    </div>
</template>
