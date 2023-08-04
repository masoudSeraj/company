<script setup>
import { Head } from "@inertiajs/vue3";

const props = defineProps([
    "ogTitle",
    "ogDescription",
    "ogType",
    "ogImage",
    "ogUrl",
    "favicon",
]);
</script>

<template>
    <Head>
        <title head-key="title">شرکت سانیار لوب تک رانا</title>
        <!-- <meta property="og:url" content="https://ahrefs.com/blog/open-graph-meta-tags/" /> -->
        <link rel="icon" type="image/svg+xml" :href="favicon" />
        <meta property="og:title" :content="ogTitle" />
        <meta property="og:type" :content="ogType" />
        <meta property="og:description" :content="ogDescription" />
        <meta property="og:url" :content="ogUrl" />
        <!-- <meta property="og:image" :content="ogImage" /> -->
        <meta property="og:site_name" :content="ogTitle" />
        <meta name="twitter:title" :content="ogTitle" />
        <meta name="twitter:description" :content="ogDescription" />
        <!-- <meta name="twitter:image" :content="ogImage" /> -->
    </Head>
</template>
