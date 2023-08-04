<template>
        <div id="order-slider" class="swiper-container gallery-thumbs w-full lg:w-2/3 mx-auto">
            <div class="swiper-wrapper z-20 md:z-0">
                <div class="swiper-slide" v-for="(product, index) in products.random" :key="product.id">
                    <div class="product relative h-[400px]">
                        <span class="product__price">
                            {{ product.id }}
                        </span>
                        <div class="w-1/2 m-auto h-[200px] ">
                            <img class="product__image" :src="product.image">
                        </div>
                        <div class="mt-10">
                            <h3 class="product__title">{{ product.title }}</h3>
                            <hr />
                            <p>{{ dottingText(product.short_description) }}</p>
                            <a href="#" class="product__btn btn">ثبت سفارش</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
import { Swiper, FreeMode, Navigation, Pagination, Autoplay } from 'swiper';

export default{
    data(){
        return {
            products: {
                random: [],
                text: ''
            }
        }
    },
    methods:{
        dottingText(text) {
            let originalWords = text.split(" ");
            let reducedWords = text.split(" ").splice(0, 20);
            return originalWords.length > 20 ? reducedWords.join(" ") + '...' : reducedWords.join(" ");
        },
        randomProducts(){
            axios.get(route('product.random'))
                .then((response) => {
                    this.products.random = response.data.data
            });
        }
    },
    mounted(){
        this.randomProducts();

        Swiper.use([Navigation, Pagination, Autoplay, FreeMode]);

        new Swiper('#order-slider', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            pagination: {
                clickable: true
            },
            coverflowEffect: {
                    rotate: 0,
                    stretch: 0,
                    // depth: 50,
                    // modifier: 6,
                    slideShadows : false,
                },
            });
    }
}

</script>

<style scoped>
 .site-logo {
	 width: 218.33px !important;
	 margin-right: 50px;
}
 .btn {
	 border-radius: 5px;
	 font-weight: normal;
	 font-size: 15px;
	 text-align: center;
	 font-weight: 600;
	 font-size: 14px;
	 padding: 14px 30px;
	 cursor: pointer;
}
 .btn-theme {
	 background: blue;
	 color: #212121;
}

.c-container {
    margin: auto;
    width: 93%;
    position: relative;
    z-index: 1;
}

.btn-outline-white {
    color: #fff;
    background-color: rgba(255, 255, 255, 0.1);
    background-image: none;
    border-width: 2px;
    border-color: #fff;
    font-weight: 500;
    -webkit-transition: all .2s;
    transition: all .2s;
}
.btn {
    border-radius: 5px;
    font-weight: normal;
    font-size: 15px;
    line-height: 12px;
    text-align: center;
    font-weight: 600;
    font-size: 14px;
    padding: 14px 30px;
    cursor: pointer;
}
.btn-outline-white:hover {
    background-color: #fff;
    color: black;
}
/* common css up */

 .unt {
	 margin-bottom: 20px;
	 margin-top: 60px;
}
 .hero-text {
	 font-size: 30px;
	 color: #fff;
}
 .gallery-thumbs {
	 height: 100%;
}
 :deep(.gallery-thumbs .swiper-wrapper) {
     /* z-index: 0; */
     -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
}
 .gallery-thumbs .swiper-slide {
	 background-position: center;
	 background-size: cover;
	 /* width: 250px !important; */
	 height: 330px;
	 position: relative;
}
 /* .gallery-thumbs .swiper-slide img {
	 filter: contrast(0.5) blur(1px);
	 width: 100%;
	 height: 100%;
	 object-fit: cover;
	 border-radius: 10px;
} */
 .gallery-thumbs .swiper-slide-active img {
	 filter: contrast(1) blur(0px) !important;
}
 .flex-row {
	 display: -webkit-box;
	 display: -ms-flexbox;
	 display: flex;
	 -ms-flex-wrap: wrap;
	 flex-wrap: wrap;
	 margin-right: -15px;
	 margin-left: -15px;
}
 .flex-row .flex-col {
	 -ms-flex-preferred-size: 0;
	 flex-basis: 0;
	 -webkit-box-flex: 1;
	 -ms-flex-positive: 1;
	 flex-grow: 1;
	 max-width: 100%;
	 position: relative;
	 width: 100%;
	 min-height: 1px;
	 padding-right: 15px;
	 padding-left: 15px;
}

/* .testi-user-img {
    width: 40%;
} */
.quote-icon {
    width: 38px;
    display: block;
    margin-bottom: 30px;
}
:deep(#app > swiper-pagination-vertical.swiper-pagination-bullets), :deep(#app > .swiper-vertical>.swiper-pagination-bullets) {
    left: 10px;
    top: 50%;
    transform: translate3d(0px,-50%,0);
}

:deep(.swiper-pagination-bullet.swiper-pagination-bullet-active){
    background-color: #344980;
}
</style>

<style scoped>
.product__category, .product__price, .btn {
  font-size: 0.8em;
  font-weight: 700;
}

hr {
  border: 0;
  height: 3px;
  width: 30px;
  background-color: #cf092c;
  margin: 22px 0 20px;
}

a {
  text-decoration: none;
  color: inherit;
}

p {
  margin: 0 0 1.5em 0;
}
p:last-child {
  margin-bottom: 0;
}

.btn {
  display: inline-block;
  color: black;
  text-align: center;
  padding: 1.75em 3.5em;
  white-space: nowrap;
  border-radius: 5px;
}

.product {
  position: relative;
  width: 400px;
  padding: 10px;
  border-radius: 8px;
  background-color: #fff;
  transition: box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 30px 25px -20px rgba(0, 0, 0, 0.15);
  margin-top: 30px;
}

.product__image {
  width: 100%;
  height: auto;
  margin-bottom: 30px;
  object-fit: contain;
  filter: contrast(0.5) blur(1px);
  border-radius: 10px;
}

.product__title {
  font-size: 20px;
  color: #000;
}

.product__price {
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
  top: -30px;
  left: -30px;
  width: 100px;
  height: 100px;
  background-color: rgba(0, 0, 0, 0.95);
  color: #fff;
  border-radius: 50%;
  z-index: 10;
}

.product__category {
  display: block;
  color: #cf092c;
  margin-bottom: 1em;
}

.product__btn {
  position: absolute;
  bottom: -30px;
  right: 30px;
  background-color: rgba(207, 9, 44, 0.95);
  transition: background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 30px 25px -20px rgba(0, 0, 0, 0.15);
}
.product__btn:hover {
  box-shadow: 0 36px 28px -20px rgba(0, 0, 0, 0.2);
  background-color: #c5092a;
}

</style>
