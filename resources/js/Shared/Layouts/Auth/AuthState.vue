<script setup>
import {  Link  }   from '@inertiajs/vue3';
import { routes } from '@/Shared/routes.js';
const props = defineProps(['canLogin', 'canRegister', 'user', 'isVerified'])

</script>
<template>
    
    <div v-if="props.canLogin" class="tw-z-10 tw-p-6 tw-text-right">
      <Link :href="routes().logout.post.path" method="post" as="button" type="button" title="خروج" v-if="props.user" 
        class="tw-flex tw-items-center tw-font-semibold tw-text-gray-600 hover:tw-text-gray-900 dark:tw-text-gray-400 dark:hover:tw-text-white focus:tw-outline focus:tw-outline-2 focus:tw-rounded-sm focus:tw-outline-red-500">
        <i class='bx bx-log-out tw-text-lg'></i> 
        {{ props.user.first_name + ' ' + props.user.last_name }}  
      </Link>      

      <template v-else>
        <Link :href="routes().login.create.path"
          class="tw-font-semibold tw-text-gray-600 hover:tw-text-gray-900 dark:tw-text-gray-400 dark:tw-hover:text-white focus:tw-outline focus:tw-outline-2 focus:tw-rounded-sm focus:tw-outline-red-500">
        ورود</Link>

        <Link v-if="props.canRegister" :href="routes().register.create.path"
          class="tw-ml-4 tw-font-semibold tw-text-gray-600 hover:tw-text-gray-900 dark:tw-text-gray-400 dark:hover:tw-text-white focus:tw-outline focus:tw-outline-2 focus:tw-rounded-sm focus:tw-outline-red-500">
        ثبت نام</Link>
      </template>

      <Link class="tw-text-xs tw-font-light" v-if="!isVerified && user" :href="routes().verification.verify.path">فعالسازی</Link>

    </div>
</template>
