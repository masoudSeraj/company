<template>
  <footer class="tw-bg-gray-900">
    <div class="tw-px-4 tw-pt-16 tw-mx-auto sm:tw-max-w-xl md:tw-max-w-full lg:tw-max-w-screen-xl md:tw-px-24 lg:tw-px-8">
      <div class="tw-grid tw-row-gap-10 tw-mb-8 lg:tw-grid-cols-6">
        
        <div class="tw-text-white md:tw-max-w-md lg:tw-col-span-4">
                <div class="tw-flex tw-flex-col">
                    <div class="tw-object-contain tw-w-40 tw-h-40 tw-mb-3">
                      <img :src="settingsProps?.logo">
                    </div>
                    <div class="tw-text-xs">
                      <div class="tw-mb-3">
                        <p v-html="settingsProps?.description">
                        </p>
                      </div>
                        <div class="tw-mb-3">
                          <p v-html="settingsProps?.working_hour">
                          </p>
                        </div>
                      <div class="tw-mb-3">
                        <p v-html="settingsProps?.phone">
                        </p>
                      </div>
                        
                      <div class="tw-mb-3">
                        <p v-html="settingsProps?.address">
                        </p>
                      </div>
                    </div>
                </div>
            </div>

        <div class="md:tw-max-w-md lg:tw-col-span-2">
          <div style="width: 100%">
              <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=36.84741,54.47896+(My%20Business%20Name)&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                <a href="https://www.maps.ie/distance-area-calculator.html">area maps</a>
              </iframe>
          </div>
        </div>
      </div>
      <div class="tw-flex tw-flex-col tw-justify-between tw-pt-5 tw-pb-10 tw-border-t tw-border-gray-800 sm:tw-flex-row">
        <p class="tw-text-sm tw-text-gray-500">
          {{ settingsProps?.copyright }}
        </p>
        <div class="tw-flex tw-items-center tw-mt-4 tw-space-x-4 sm:tw-mt-0">

          <a v-for="social in socialsProps" :key="social.id" :href="social.link" class="tw-text-white tw-transition-colors tw-duration-300 hover:tw-text-teal-accent-400">
              <span v-html="social.icon.code">
              </span>
          </a>
          
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
    props: {
      settings: Object,
      socials: Object
    },
    data(){
      return {
        settingsProps: this.settings,
        socialsProps: this.socials
      }
    },  
    methods: {
        logo(){
            return this.$page.props.logo;
        },
    mounted(){
          // console.log(this.socialsProps)
          // console.log('yes')
        }
    },
}
</script>

<style scoped>
.footer {
  position: relative;
  width: 100%;
  background: #3586ff;
  min-height: 100px;
  padding: 20px 50px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.social-icon,
.menu {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 10px 0;
  flex-wrap: wrap;
}

.social-icon__item,
.menu__item {
  list-style: none;
}

.social-icon__link {
  font-size: 2rem;
  color: #fff;
  margin: 0 10px;
  display: inline-block;
  transition: 0.5s;
}
.social-icon__link:hover {
  transform: translateY(-10px);
}

.menu__link {
  font-size: 1.2rem;
  color: #fff;
  margin: 0 10px;
  display: inline-block;
  transition: 0.5s;
  text-decoration: none;
  opacity: 0.75;
  font-weight: 300;
}

.menu__link:hover {
  opacity: 1;
}

.footer p {
  color: #fff;
  margin: 15px 0 10px 0;
  font-size: 1rem;
  font-weight: 300;
}
</style>
