<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import  MegaMenuContent from '@/Pages/Main/Sections/MegaMenuContent.vue'

let megaMenu = ref(false)
</script>

<template>
  <ul class="tw-flex">
    <!--Toggleable Link-->
    <li class="tw-toggleable tw-z-10">
      <input type="checkbox" value="selected" id="toggle-one" class="tw-toggle-input">
      <label for="toggle-one" class="tw-block tw-p-6 tw-cursor-pointer lg:tw-text-base nav-link">محصولات</label>
      <div role="toggle" class="tw-p-6 tw-mb-16 tw-bg-[#3e586d] tw-shadow-xl tw-mega-menu sm:tw-mb-0">
        <section class="tw-container tw-flex tw-flex-wrap tw-justify-between tw-w-full tw-mx-auto">
          <div class="tw-w-2/12 tw-text-white">
            <h3 class="tw-mb-2 tw-text-xl tw-font-bold tw-text-white tw-text-bold">categories</h3>
            <ul class="tw-flex tw-flex-col tw-gap-2 tw-px-4 tw-pt-6 tw-pb-6 tw-border-r">
              <li class="hover:tw-bg-transparent hover:tw-cursor-pointer tw-py-2 tw-px-4 hover:tw-bg-[#3e300d] tw-border tw-border-solid tw-border-white">category 1</li>
              <li class="hover:tw-bg-transparent hover:tw-cursor-pointer tw-py-2 tw-px-4 hover:tw-bg-[#3e300d] tw-border tw-border-solid tw-border-white">category 2</li>
              <li class="hover:tw-bg-transparent hover:tw-cursor-pointer tw-py-2 tw-px-4 hover:tw-bg-[#3e300d] tw-border tw-border-solid tw-border-white">category 3</li>
              <li class="hover:tw-bg-transparent hover:tw-cursor-pointer tw-py-2 tw-px-4 hover:tw-bg-[#3e300d] tw-border tw-border-solid tw-border-white">category 4</li>
            </ul>
          </div>
          
          <MegaMenuContent></MegaMenuContent>
          

        </section>
      </div>
    </li>
  </ul>
</template>

<style scoped>
.nav-link {
  text-decoration: none;
  font-size: 1.7rem;
  position: relative;
}

.nav-link::before {
  content: "";
  position: absolute;
  width: 100%;
  height: 0.1rem;
  background-color: #fdd500;
  bottom: -10px;
  transform: scaleX(0);
  transition: 150ms all;
}

.nav-link:hover::before {
  transform: scaleX(1);
}

.tw-mega-menu {
  display: none;
  left: 0;
  position: absolute;
  text-align: left;
  width: 100%;
}



/* #hoverable Class Styles */
.tw-hoverable {
  position: static;
}

.tw-hoverable>a:after {
  content: "\25BC";
  font-size: 10px;
  padding-left: 6px;
  position: relative;
  top: -1px;
}

.tw-hoverable:hover .tw-mega-menu {
  display: block;
}


/* #toggle Class Styles */

.tw-toggleable>label:after {
  content: "\25BC";
  font-size: 10px;
  padding-left: 6px;
  position: relative;
  top: -1px;
}

.tw-toggle-input {
  display: none;
}

.tw-toggle-input:not(checked)~.tw-mega-menu {
  display: none;
}

.tw-toggle-input:checked~.tw-mega-menu {
  display: block;
}

.tw-toggle-input:checked+label {
  color: white;
  background: #3e586d;
  /*@apply bg-teal-700 */
}

.tw-toggle-input:checked~label:after {
  content: "\25B2";
  font-size: 10px;
  padding-left: 6px;
  position: relative;
  top: -1px;
}</style>