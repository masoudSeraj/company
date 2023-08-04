<script setup>
import {  onMounted  }  from 'vue'
import { Swiper, FreeMode, Navigation, Pagination, Autoplay, Thumbs  } from 'swiper';


const props = defineProps({
    images: Object
})

onMounted(()=>{
    Swiper.use([ Navigation, Pagination, Autoplay, Thumbs, FreeMode ]);

    var galleryThumbs = new Swiper('.gallery-thumbs', {
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesProgress: true,
    });
    
    var galleryTop = new Swiper('.gallery-top', {
      spaceBetween: 10,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      thumbs: {
        swiper: galleryThumbs
      }
})
})

</script>
<template>
    <div>
        <div class="swiper gallery-top">
            <div class="swiper-wrapper tw-bg-white tw-rounded-lg">
            <div class="swiper-slide tw-bg-contain tw-bg-no-repeat" v-for="(image, index) in props.images" :key="index" :style="`background-image:url(${image})`"></div>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next swiper-button-white tw-rotate-180"></div>
            <div class="swiper-button-prev swiper-button-white tw-rotate-180"></div>
        </div>
        <div class="swiper gallery-thumbs">
            <div class="swiper-wrapper tw-bg-white tw-rounded-lg">
            <div class="swiper-slide tw-bg-contain tw-bg-no-repeat" v-for="(image, index) in props.images" :style="`background-image:url(${image})`"></div>
            </div>
        </div>
    </div>


</template>

<style scoped>
.swiper {
      width: 100%;
      height: 300px;
      margin-left: auto;
      margin-right: auto;
    }

    .swiper-slide {
      background-size: contain;
      background-position: center;
    }

    .gallery-top {
      height: 80%;
      width: 100%;
    }

    .gallery-thumbs {
      height: 20%;
      box-sizing: border-box;
      padding: 10px 0;
    }

    .gallery-thumbs .swiper-slide {
      width: 25%;
      height: 100%;
      opacity: 0.4;
    }

    .gallery-thumbs .swiper-slide-thumb-active {
      opacity: 1;
    }
</style>