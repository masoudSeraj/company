<template>
	<div class="bdt-timeline-container tw-container">
		<div class="upk-salf-slider-wrapper">
			<div class="swiper-container mySwiper2 tw-overflow-hidden tw-mx-auto tw-w-full">
				<div class="swiper-wrapper">
					<div class="upk-salf-item swiper-slide" v-for="(slider) in sliderImages" :key="slider.id">
						<div class="upk-salf-image-wrap">
							<img class="upk-xanc-img" :src="getImage(slider.images)" />
						</div>
						<div class="upk-salf-content-wrap">
							<h3 class="upk-salf-title" data-swiper-parallax-y="-150" data-swiper-parallax-duration="1200">
								{{ slider.title }}
							</h3>
							<div class="upk-salf-desc" data-swiper-parallax-y="-200" data-swiper-parallax-duration="1400">{{
								slider.subtitle }}</div>
							<div class="upk-salf-button" :class="{ 'hidden': !slider.link }" data-swiper-parallax-y="-300"
								data-swiper-parallax-duration="1500">
								<a class="link link--arrowed" :href="slider.link">مشاهده
									<svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
										viewBox="0 0 32 32">
										<g fill="none" stroke="#ff215a" stroke-width="1.5" stroke-linejoin="round"
											stroke-miterlimit="10">
											<circle class="arrow-icon--circle" cx="16" cy="16" r="15.12"></circle>
											<path class="arrow-icon--arrow"
												d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path>
										</g>
									</svg>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="upk-page-scroll">
				<a class="arrow-up">
					<div class="long-arrow-left"></div>
					<span class="arrow-slide"></span>
				</a>
			</div>
			<div class="upk-salf-nav-pag-wrap">
				<div class="upk-salf-pagi-wrap" style="margin-left: 22px">
					<div class="swiper-pagination"></div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { Swiper, FreeMode, Navigation, Pagination, Autoplay, Thumbs, Mousewheel, A11y, Controller, Manipulation } from 'swiper';

export default {
	props: {
		sliders: Object
	},

	data() {
		return {
			sliderImages: this.sliders,
			image: null,
			width: document.documentElement.clientWidth
		}
	},
	methods: {
		onSwiper(swiper) {
			console.log(swiper);
		},

		getImageType(images, type) {
			return images.find((image) => {
				return image.type === type
			})
		},

		getImage(images) {

			if (this.width <= 800) {
				return this.getImageType(images, 'PORTRAIT')?.image || this.getImageType(images, 'LANDSCAPE')?.image
			}

			return this.getImageType(images, 'LANDSCAPE')?.image || this.getImageType(images, 'PORTRAIT')?.image
		},

		getDimensions() {
			this.width = document.documentElement.clientWidth;
		}
	},
	mounted() {
		window.addEventListener('resize', this.getDimensions);

		Swiper.use([Navigation, Pagination, Autoplay, Thumbs, FreeMode, Mousewheel, A11y, Controller, Manipulation]);

		var mainSlider = new Swiper(".mySwiper2", {
			parallax: true,
			speed: 1200,
			effect: 'slide',
			direction: "vertical",
			autoplay: true,
			observer: true,
			observeParents: true,

			pagination: {
				el: '.swiper-pagination',
				clickable: true,
				// renderBullet: function(index, className) {
				//     return '<span class="' + className + ' swiper-pagination-bullet--svg-animation"><svg width="28" height="28" viewBox="0 0 28 28"><circle class="svg__circle" cx="14" cy="14" r="10" fill="none" stroke-width="2"></circle><circle class="svg__circle-inner" cx="14" cy="14" r="2" stroke-width="3"></circle></svg></span>';
				// },
			},
		});
	}
}
</script>

<style scoped>
* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	vertical-align: middle;
}

.bdt-timeline-container {
	display: flow-root;
	box-sizing: content-box;
	/* max-width: 1200px; */
	margin-left: auto;
	margin-right: auto;
	overflow: hidden;
	margin-top: 50px;
}

.upk-salf-slider-wrapper {
	display: flex;
	flex-direction: row;
	background: #fff;
	box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
	height: 400px;
	padding: 30px;
	position: relative;
}

.upk-salf-slider-wrapper .upk-salf-item {
	position: relative;
	display: flex;
	flex-direction: row-reverse;
}

.upk-salf-slider-wrapper .upk-salf-item.swiper-slide-active .upk-salf-title,
.upk-salf-slider-wrapper .upk-salf-item.swiper-slide-active .upk-salf-desc,
.upk-salf-slider-wrapper .upk-salf-item.swiper-slide-active .upk-salf-button {
	opacity: 1;
}

.upk-salf-slider-wrapper .upk-salf-item .upk-salf-image-wrap {
	height: 100%;
	width: 100%;
}

.upk-salf-slider-wrapper .upk-salf-item .upk-xanc-img {
	display: block;
	width: 100%;
	height: 100%;
	object-fit: contain;
}

.upk-salf-slider-wrapper .upk-salf-item .upk-salf-content-wrap {
	position: absolute;
	left: 0;
	bottom: 0;
	top: unset;
	max-width: 460px;
	overflow: hidden;
	background: #fff 8a;
	backdrop-filter: blur(15px);
	transition: backdrop-filter 0.9s;
	padding: 20px;
	padding-left: 20px;
}

.upk-salf-slider-wrapper .upk-salf-item .upk-salf-title {
	font-size: 23px;
	font-weight: 700;
	line-height: 1.2;
	color: #2b2d42;
	text-transform: capitalize;
	margin-bottom: 20px;
	opacity: 0;
}

.upk-salf-slider-wrapper .upk-salf-item .upk-salf-desc {
	color: #656565;
	font-size: 14px;
	line-height: 1.6;
	text-transform: capitalize;
	margin-bottom: 20px;
	opacity: 0;
}

.upk-salf-slider-wrapper .upk-salf-item .upk-salf-button {
	opacity: 0;
}

.upk-salf-slider-wrapper .upk-salf-item .upk-salf-button .link {
	color: #2b2d42;
	cursor: pointer;
	font-weight: 500;
	text-decoration: none;
	text-transform: capitalize;
	font-size: 14px;
	transition: all 0.3s ease;
}

.upk-salf-slider-wrapper .upk-salf-item .upk-salf-button .link:hover {
	color: #ff215a;
}

.upk-salf-slider-wrapper .upk-salf-item .upk-salf-button .link--arrowed {
	display: inline-block;
}

.upk-salf-slider-wrapper .upk-salf-item .upk-salf-button .link--arrowed .arrow-icon {
	position: relative;
	top: 0;
	-webkit-transition: -webkit-transform 0.3s ease;
	transition: -webkit-transform 0.3s ease;
	transition: transform 0.3s ease;
	transition: transform 0.3s ease, -webkit-transform 0.3s ease;
	vertical-align: middle;
}

.upk-salf-slider-wrapper .upk-salf-item .upk-salf-button .link--arrowed .arrow-icon--circle {
	transition: stroke-dashoffset 0.3s ease;
	stroke-dasharray: 95;
	stroke-dashoffset: 95;
}

.upk-salf-slider-wrapper .upk-salf-item .upk-salf-button .link--arrowed g {
	stroke: currentColor;
	color: #2b2d42;
}

.upk-salf-slider-wrapper .upk-salf-item .upk-salf-button .link--arrowed:hover .arrow-icon {
	transform: translate3d(5px, 0, 0);
}

.upk-salf-slider-wrapper .upk-salf-item .upk-salf-button .link--arrowed:hover .arrow-icon--circle {
	stroke-dashoffset: 0;
}

.upk-salf-slider-wrapper .upk-salf-item .upk-salf-button .link--arrowed:hover g {
	color: #ff215a;
}

.upk-salf-slider-wrapper .upk-page-scroll {
	position: absolute;
	bottom: 8%;
	right: 5%;
	transform: rotate(90deg);
	z-index: 1;
	display: none;
}

.upk-salf-slider-wrapper .upk-page-scroll .arrow-up {
	height: 70px;
	width: 70px;
	display: block;
	background: #fff c9;
	backdrop-filter: blur(18px);
	position: relative;
	cursor: pointer;
	transition: all 0.5s cubic-bezier(0.25, 1.7, 0.35, 1.5);
	transform: rotate(-90deg);
	overflow: hidden;
}

.upk-salf-slider-wrapper .upk-page-scroll .arrow-slide {
	left: 0;
	top: -100%;
	width: 100%;
	height: 100%;
	background: #ff215a;
	position: absolute;
	display: block;
	z-index: 0;
}

.upk-salf-slider-wrapper .upk-page-scroll .long-arrow-left {
	display: block;
	margin: 30px auto;
	width: 16px;
	height: 16px;
	border-top: 2px solid #2b2d42;
	border-left: 2px solid #2b2d42;
}

.upk-salf-slider-wrapper .upk-page-scroll .long-arrow-left {
	transform: rotate(-135deg);
}

.upk-salf-slider-wrapper .upk-page-scroll .long-arrow-left::after {
	content: "";
	display: block;
	width: 2px;
	height: 25px;
	background-color: #2b2d42;
	transform: rotate(-45deg) translate(8px, 3px);
	left: 0;
	top: 0;
}

.upk-salf-slider-wrapper .upk-page-scroll .arrow-up:hover {
	transition: all 0.1s;
}

.upk-salf-slider-wrapper .upk-page-scroll .arrow-up:hover .left-arm:after {
	transform: rotate(-10deg);
}

.upk-salf-slider-wrapper .upk-page-scroll .arrow-up:hover .right-arm:after {
	transform: rotate(10deg);
}

.upk-salf-slider-wrapper .upk-page-scroll .arrow-up:hover .arrow-slide {
	transition: all 0.5s ease-in-out;
	transform: translateY(200%);
}

.upk-salf-slider-wrapper .upk-salf-nav-pag-wrap {
	position: absolute;
	top: 0;
	height: 100%;
	right: 0;
}

.upk-salf-slider-wrapper .upk-salf-navigation {
	margin-top: 40px;
	margin-right: 2px;
}

.upk-salf-slider-wrapper .upk-salf-navigation .link--arrowed {
	display: inline-block;
}

.upk-salf-slider-wrapper .upk-salf-navigation .link--arrowed .arrow-icon {
	position: relative;
	top: 0;
	-webkit-transition: -webkit-transform 0.3s ease;
	transition: -webkit-transform 0.3s ease;
	transition: transform 0.3s ease;
	transition: transform 0.3s ease, -webkit-transform 0.3s ease;
	vertical-align: middle;
}

.upk-salf-slider-wrapper .upk-salf-navigation .link--arrowed .arrow-icon--circle {
	transition: stroke-dashoffset 0.3s ease;
	stroke-dasharray: 95;
	stroke-dashoffset: 95;
}

.upk-salf-slider-wrapper .upk-salf-navigation .link--arrowed g {
	stroke: currentColor;
	color: #2b2d42;
}

.upk-salf-slider-wrapper .upk-salf-navigation .link--arrowed:hover .arrow-icon {
	transform: translate3d(5px, 0, 0);
}

.upk-salf-slider-wrapper .upk-salf-navigation .link--arrowed:hover .arrow-icon--circle {
	stroke-dashoffset: 0;
}

.upk-salf-slider-wrapper .upk-salf-navigation .link--arrowed:hover g {
	color: #ff215a;
}

.upk-salf-slider-wrapper .upk-salf-navigation .upk-button-next {
	margin-top: 15px;
	transform: rotate(90deg);
}

.upk-salf-slider-wrapper .upk-salf-navigation .upk-button-prev {
	transform: rotate(-90deg);
}

.upk-salf-slider-wrapper .upk-salf-pagi-wrap {
	position: absolute;
	top: 43%;
	right: 0;
	margin-right: 22px;
}

@-webkit-keyframes progress {
	0% {
		stroke-dashoffset: 75;
		opacity: 1;
	}

	95% {
		stroke-dashoffset: 0;
		opacity: 1;
	}

	100% {
		opacity: 0;
		stroke-dashoffset: 0;
	}
}

@-moz-keyframes progress {
	0% {
		stroke-dashoffset: 75;
		opacity: 1;
	}

	95% {
		stroke-dashoffset: 0;
		opacity: 1;
	}

	100% {
		opacity: 0;
		stroke-dashoffset: 0;
	}
}

@-o-keyframes progress {
	0% {
		stroke-dashoffset: 75;
		opacity: 1;
	}

	95% {
		stroke-dashoffset: 0;
		opacity: 1;
	}

	100% {
		opacity: 0;
		stroke-dashoffset: 0;
	}
}

@keyframes progress {
	0% {
		stroke-dashoffset: 75;
		opacity: 1;
	}

	95% {
		stroke-dashoffset: 0;
		opacity: 1;
	}

	100% {
		opacity: 0;
		stroke-dashoffset: 0;
	}
}

.upk-salf-slider-wrapper .upk-salf-pagi-wrap .swiper-pagination-bullet {
	background-color: transparent;
	opacity: 0.8;
}

.upk-salf-slider-wrapper .upk-salf-pagi-wrap .swiper-pagination-bullet--svg-animation {
	width: 20px;
	height: 20px;
	margin: 6px -7px;
	display: inline-block;
}

.upk-salf-slider-wrapper .upk-salf-pagi-wrap .swiper-pagination-bullet--svg-animation svg {
	-webkit-transform: rotate(-90deg);
	-moz-transform: rotate(-90deg);
	-ms-transform: rotate(-90deg);
	-o-transform: rotate(-90deg);
	transform: rotate(-90deg);
}

.upk-salf-slider-wrapper .upk-salf-pagi-wrap .swiper-pagination-bullet--svg-animation .svg__circle-inner {
	stroke: #2b2d42;
	fill: transparent;
	-webkit-transition: all 0.3s ease;
	-moz-transition: all 0.3s ease;
	-ms-transition: all 0.3s ease;
	-o-transition: all 0.3s ease;
	transition: all 0.3s ease;
}

.upk-salf-slider-wrapper .upk-salf-pagi-wrap .swiper-pagination-bullet-active .svg__circle {
	stroke: #ff215a;
	stroke-dasharray: 75;
	stroke-dashoffset: 0;
	-webkit-animation: progress 4s ease-in-out 1 forwards;
	-moz-animation: progress 4s ease-in-out 1 forwards;
	-ms-animation: progress 4s ease-in-out 1 forwards;
	animation: progress 4s ease-in-out 1 forwards;
}

.upk-salf-slider-wrapper .upk-salf-pagi-wrap .swiper-pagination-bullet-active .svg__circle-inner {
	fill: #2b2d42;
	stroke: #ff215a;
}

@media (min-width: 768px) {
	.upk-salf-slider-wrapper {
		height: 550px;
		padding: 60px;
	}

	.upk-salf-slider-wrapper .upk-page-scroll {
		bottom: 4%;
		display: inherit;
	}

	.upk-salf-slider-wrapper .upk-salf-item .upk-salf-title {
		font-size: 40px;
	}

	.upk-salf-slider-wrapper .upk-salf-item .upk-salf-content-wrap {
		max-width: 400px;
		padding: 40px;
		padding-left: 0;
		top: 50%;
		transform: translateY(-50%);
		bottom: unset;
	}

	.upk-salf-slider-wrapper .upk-salf-item .upk-salf-image-wrap {
		width: 80%;
	}

	.upk-salf-slider-wrapper .upk-salf-navigation {
		margin-top: 60px;
		margin-right: 20px;
	}

	.upk-salf-slider-wrapper .upk-salf-pagi-wrap {
		margin-right: 47px;
	}

	.upk-salf-slider-wrapper .upk-salf-pagi-wrap .swiper-pagination-bullet--svg-animation {
		margin: 6px 0;
	}
}

@media (min-width: 1024px) {
	.upk-salf-slider-wrapper {
		height: 650px;
		padding: 70px;
	}

	.upk-salf-slider-wrapper .upk-page-scroll {
		bottom: 9%;
	}

	.upk-salf-slider-wrapper .upk-salf-item .upk-salf-title {
		font-size: 50px;
	}

	.upk-salf-slider-wrapper .upk-salf-item .upk-salf-content-wrap {
		max-width: 460px;
		padding: 50px;
		padding-left: 0;
	}

	.upk-salf-slider-wrapper .upk-salf-item .upk-salf-desc {
		font-size: 16px;
	}

	.upk-salf-slider-wrapper .upk-salf-item .upk-salf-button .link {
		font-size: 16px;
	}

	.upk-salf-slider-wrapper .upk-salf-item .upk-salf-image-wrap {
		width: 70%;
	}

	.upk-salf-slider-wrapper .upk-salf-navigation {
		margin-top: 85px;
		margin-right: 30px;
	}

	.upk-salf-slider-wrapper .upk-salf-pagi-wrap {
		margin-right: 53px;
	}

	.upk-salf-slider-wrapper .upk-salf-pagi-wrap .swiper-pagination-bullet--svg-animation {
		margin: 6px -5px;
	}
}

@media (min-width: 1440px) {
	.upk-salf-slider-wrapper {
		height: 700px;
		padding: 80px;
	}

	.upk-salf-slider-wrapper .upk-salf-item .upk-salf-title {
		font-size: 55px;
	}
}

.button {
	background: #f00;
	padding: 18px 20px;
	text-transform: uppercase;
	margin-top: 50px;
	margin-bottom: 50px;
	display: inline-block;
	text-decoration: none;
	font-weight: 700;
	font-size: 15px;
	color: #fff;
}</style>
