<template>
    <Wrapper>
        <template  #content>
            <!-- <HeadTag 
                :ogTitle="head?.og?.title" 
                :ogDescription="head?.og.description"
                :ogType="head?.og?.type"
                :ogImage="head?.og?.image"
                :ogUrl="head?.og?.url"
                :favicon="head?.favicon"
        >
            </HeadTag> -->
            <Slider :sliders="$page.props.sliders.data"></Slider>
            <Testimonials :resumes="$page.props.resumes.data"></Testimonials>
            <Blog :posts="$page.props.posts.data" :settings="settings"></Blog>
        </template>
    </Wrapper>
</template>


<script>
import Wrapper from '@/Shared/Layouts/Wrapper.vue';
import { usePage } from '@inertiajs/vue3';
import Slider from '@/Pages/Main/Sections/Slider.vue';
import Testimonials from '@/Pages/Main/Sections/Testimonials.vue';
import Blog from '@/Pages/Main/Sections/Blog.vue';
import HeadTag from '@/Pages/Main/Sections/HeadTag.vue';

export default {
    props: {
          canLogin: Boolean,
          canRegister: Boolean,
    },
    
    data(){
        return {
            settings: null
        }
    },
    computed: {
        head : function(){
            return usePage().props.settings.data[0];
        },
    },
    methods:{
        
    },
    beforeMount(){
        this.settings = usePage().props.settings.data[0]?.posts
    },
    components:{
        Wrapper,
        Slider,
        Testimonials,
        Blog,
        HeadTag
    }
}
</script>
