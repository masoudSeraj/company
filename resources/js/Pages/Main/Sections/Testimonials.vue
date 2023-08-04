
<template>
    <section class="tw-container tw-mx-auto tw-my-6 tw-overflow-hidden tw-spacer" dir="rtl">
        <div class="tw-flex-col testimonial-section md:tw-flex-row">
            <div class="tw-w-full testi-user-img md:tw-w-1/2">
                <div class="tw-w-[500px] tw-mx-auto swiper-container gallery-thumbs lg:tw-w-2/3">
                    <div class="tw-z-20 swiper-wrapper md:tw-z-0">
                        <div class="swiper-slide" v-for="resume in resumes" :key="resume.id">
                            <img class="u3 tw-w-[280px] tw-h-[380px] tw-object-contain" :src="resume.image" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="tw-w-full tw-overflow-hidden user-saying md:tw-z-20 tw-bg-organization-yellow-900 tw-text-organization-blue-900 md:tw-w-1/2">
                <div class="swiper-container testimonial">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <div class="swiper-slide" v-for="resume in resumes" :key="resume.id">
                            <div class="tw-overflow-hidden quote">
                                <img class="quote-icon" src="https://md-aqil.github.io/images/quote.png" alt="">
                                <p>
                                    “{{ resume.title }}“
                                </p>
                                <div class="name">{{ resume.context }}</div>
                                <div class="designation">{{ resume.short_description }}</div>
                            </div>
                        </div>

                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination swiper-pagination-white"></div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { Swiper,FreeMode, Navigation, Pagination, Autoplay, Thumbs  } from 'swiper';

export default {
    props: {
        resumes: Object
    },
    methods: {},
    mounted() {
        // console.log(this.img1);
        Swiper.use([ Navigation, Pagination, Autoplay, Thumbs, FreeMode ]);
        var galleryThumbs = new Swiper('.testimonial-section .gallery-thumbs', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: '2',
            pagination: {
                clickable: true
            },
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 50,
                modifier: 6,
                slideShadows : false,
            },
        });


        var galleryTop = new Swiper('.testimonial-section .swiper-container.testimonial', {
            speed: 400,
            spaceBetween: 50,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            direction: 'vertical',
            pagination: {
                clickable: true,
                el: '.swiper-pagination',
                type: 'bullets',
            },

            thumbs: {
                swiper: galleryThumbs
            }
        });
    },
    components: {
        Swiper, Navigation, Pagination, Autoplay, Thumbs, FreeMode
    }
}
</script>

<style scoped>
    /* :root {
      --dark-green: #9cc675;
      --dark-yellow: #e89a3d;
      --extra-light-brown:#fdf0d7;
      --light-brown: #ecd5ab;
      --dark-brown:#915b40;
      --light-yellow:#f8e3a8;
      --light-red:#f3ac99;
      --light-teal:#a6c8cc;
      --light-gray:#ddd5d6;
      --theme-color2: #e89a3d;
		} */


 .site-logo {
	 width: 218.33px !important;
	 margin-right: 50px;
}
 .btn {
	 border-radius: 5px;
	 font-weight: normal;
	 font-size: 15px;
	 letter-spacing: 0.02em;
	 line-height: 12px;
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
    letter-spacing: 0.02em;
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

.testimonial p {
	 font-size: 28px;
	 letter-spacing: 0.02em;
	 line-height: 35px;
}
 .testimonial .name {
	 font-weight: bold;
	 font-size: 18px;
	 letter-spacing: 0.04em;
	 line-height: 35px;
	 text-align: left;
}
 .testimonial .designation {
	 font-size: 14px;
	 letter-spacing: 0.04em;
	 text-align: left;
	 color: #344980;
	 opacity: 0.65;
}
 .unt {
	 margin-bottom: 20px;
	 margin-top: 60px;
}
 .hero-text {
	 font-size: 30px;
	 letter-spacing: 0.02em;
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
	 width: 250px !important;
	 height: 330px;
	 position: relative;
}
 .gallery-thumbs .swiper-slide img {
	 filter: contrast(0.5) blur(1px);
	 /* width: 100%;
	 height: 100%;
	 object-fit: cover; */
	 border-radius: 10px;
}
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


.testimonial-section .quote {
    /* width: 75%; */
    height: 100%;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding-left: 100px;
    padding-right: 100px;
}
.swiper-container.testimonial {
    height: 50vh;
    min-height: 450px;
    position: relative;
}
.testimonial-section .user-saying {
    /* background: yellow; */
    /* width: 60%; */
    /* color: #fff; */
    height: 100%;
}
/* .testi-user-img {
    width: 40%;
} */
.testimonial-section {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    width: 100%;
    height: 100%;
}
.testimonial-section .quote p {
    font-size: 20px;
    font-weight: 300;
    line-height: 1.8;
    font-style: italic;
    margin: 0;
}
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
