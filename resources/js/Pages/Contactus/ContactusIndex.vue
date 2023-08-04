<script setup>
import Wrapper from '@/Shared/Layouts/Wrapper.vue';
import ContactusIndexLoggedIn from '@/Pages/Contactus/ContactusIndexLoggedIn.vue'
import ContactusIndexGuest from '@/Pages/Contactus/ContactusIndexGuest.vue'
</script>
<template>
    <Wrapper>
        <template #content>
            <ContactusIndexLoggedIn v-if="$page.props.auth.user"></ContactusIndexLoggedIn>
            <ContactusIndexGuest v-if="!$page.props.auth.user"></ContactusIndexGuest>
        </template>
    </Wrapper>
</template>