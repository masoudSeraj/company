<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <Link :href="'/'">
        <div class="tw-w-36 tw-h-36 tw-object-contain">
            <img :src="$page.props.settings.data[0].logo" alt="شرکت سانیار لوب تک رانا، عرضه کننده انواع روانکارهای صنعتی">
        </div>
    </Link>
</template>
