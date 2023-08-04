
import { createApp, h } from 'vue'
import { createPinia } from 'pinia'
import { createInertiaApp } from '@inertiajs/vue3'

import { Quasar, Notify } from 'quasar'
import quasarLang from 'quasar/lang/fa-IR'
import '@quasar/extras/material-icons/material-icons.css'

import { useLayoutStore } from '@/Shared/Stores/layout.js'
import axios from 'axios'
import Swiper from 'swiper';
import VueSocialSharing from 'vue-social-sharing'
import Vue3TouchEvents from "vue3-touch-events";

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Swiper = Swiper;

import '../css/app.css';
import 'quasar/src/css/index.sass'


import 'swiper/css';

import "swiper/css/free-mode"
import "swiper/css/navigation"
import "swiper/css/thumbs"
import 'swiper/css/pagination';
import 'root/node_modules/boxicons/css/boxicons.css';


const pinia = createPinia()

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    console.log(pages);
    return pages[`./Pages/${name}.vue`]
  },

  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(Quasar, {
        plugins: {
          Notify
        }, // import Quasar plugins and add here
        lang: quasarLang
      })
      .use(VueSocialSharing)
      .use(pinia)
      .use(Vue3TouchEvents)
      .mount(el)
  },
})

