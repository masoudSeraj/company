<template>
    <main class="tw-overflow-hidden tw-min-h-screen">
        <div class="tw-min-h-screen">
            <Navbar></Navbar>
            <slot name="content">
            </slot>
            <!-- <VerificationWarning></VerificationWarning> -->
            <Footer :settings="$page?.props?.settings?.data[0]" :socials="$page?.props?.socials?.data"></Footer>
        </div>
    </main>
</template>

<script setup>
import Navbar from '@/Pages/Main/Sections/Navbar.vue';
import Footer from '@/Pages/Main/Sections/Footer.vue';
import VerificationWarning from '@/Shared/Layouts/Auth/VerificationWarning.vue';

</script>

<style scoped>
section {
    width:auto;
    height:auto;
    /* background: rgb(226, 226, 226); */
}

section:after{
    content : "";
    display: block;
    position: absolute;
    top: 100px;
    left: 0;
    width: 100%;
    height:  100%;
    opacity : 0.4;
}
</style>
