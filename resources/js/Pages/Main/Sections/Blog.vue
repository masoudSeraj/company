<template>
  <section class="swiper mySwiper">

<div class="swiper-wrapper">
  <div class="card swiper-slide tw-overflow-hidden" :style="{ height: settingsProps['card-size'] ?? '200px' }" v-for="post in blogPosts" :key="post.id">
    <a :href="post.url">
      <div class="tw-flex tw-justify-center">
        <div class="card__image" :style="{ borderColor: settingsProps['rounded-color'] ?? '#fde100'}">
          <img :src="post.image" alt="sunnyrlube">
        </div>
      </div>

      <div class="card__content">
        <span class="card__title" ></span>
        <p class="card__text" >
          {{ dottingText(post.summary, 50) }}
        </p>
      </div>
    </a>
  </div>
</div>
</section>
</template>

<script>
import { Swiper, FreeMode, Navigation, Pagination, Autoplay, Thumbs, Mousewheel, A11y, Controller, Manipulation  } from 'swiper';
import { textSizes } from '@/Shared/size.js';

export default{
    props: {
      posts: Object,
      settings: Object
    },

    data(){
      return {
        blogPosts: this.posts,
        settingsProps: this.settings
      }
    },
    methods:{
      dottingText(text, count) {
            let originalWords = text.split(" ");
            let reducedWords = text.split(" ").splice(0, count);
            return originalWords.length > count ? reducedWords.join(" ") + '...' : reducedWords.join(" ");
        },

      // titleSize(){
      //   return textSizes[this.settingsProps['title-size']]
      // },
      
      // contentSize(){
      //   return 'font-size:' . textSizes[this.settingsProps['content-size']]
      // }

    },  
    mounted(){
        console.log(textSizes['xs'])
        Swiper.use([ Navigation, Pagination, Autoplay, Thumbs, FreeMode, Mousewheel, A11y, Controller, Manipulation ]);

        var swiper = new Swiper(".mySwiper", {
          effect: "coverflow",
          grabCursor: true,
          centeredSlides: true,
          slidesPerView: "auto",
          coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 300,
            modifier: 1,
            slideShadows: false,
          },
          pagination: {
            el: ".swiper-pagination",
          },
        });
        
    }
}
</script>

<style scoped>

.swiper{
  width: 100%;
}

.swiper-wrapper{
  width: 100%;
  height: 35em;
  display: flex;
  align-items: center;
}

.card{
  width: 20em;
  background-color: #fff;
  border-radius: 2em;
  box-shadow: 0 0 2em rgba(0, 0, 0, .2);
  padding: 2em 1em;

  display: flex;
  align-items: center;
  flex-direction: column;

  margin: 0 2em;
}

.card--default{
  height: 90%
}

/* .swiper-slide:not(.swiper-slide-active){
  filter: blur(1px);
} */

.card__image{
  width: 10em;
  height: 10em;
  border-radius: 50%;
  padding: 3px;
  border-style: solid;
  border-width: 5px;
  margin-bottom: 2em;
}

/* .card__image--default{
  border-color: #fde100;
} */

.card__image img{
  width: 100%;
  height: 100%;
  border-radius: 50%;
  object-fit: cover;
}

.card__content{
  display: flex;
  flex-direction: column;
}

.card__title{
  font-size: 1.5rem;
  font-weight: 500;
  position: relative;
  top: .2em;
}

.card__name{
  color: #fde100;
}

.card__text{
  font-size: .9rem;
  font-weight: lighter;
  margin: 1em 0;
  text-align: justify;
  text-justify: auto;
}

.card__btn{
  background-color: #fde100;
  color: white;
  font-size: 1rem;
  font-weight: 600;
  border: none;
  padding: .5em;
  border-radius: .5em;
  margin-top: .5em;
  cursor: pointer;
  
}

</style>