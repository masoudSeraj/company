<template>
    <main class="container mx-auto">
        <div class="content bg-organization-yellow-900 text-black text-sm lg:w-1/2 w-full z-10">
            <h1 class="text-4xl mb-4">مراحل ثبت سفارش</h1>
            <p>در صورت هر گونه سوال می‌توانید از طریق سیستم چت وب سایت سوال خود را بپرسید یا با تلفن شرکت تماس حاصل نمایید.</p>
            <ol>
                <li>تماس با شماره شرکت یا ارسال پیام به سیستم چت وب سایت</li>
                <li>اعلام نیازمندی‌های مورد نظر برای روانکار مطلوب</li>
                <li>اعلام پیشنهاد روانکار از طرف متخصصین فنی شرکت سانیار لوب تک</li>
                <li>ارسال روانکار به مقصد</li>
                <li>ارائه حواله پالایشگاه</li>
            </ol>
        </div>
        <div class="lg:w-1/2 w-full relative">
            <OrderSlider></OrderSlider>
        </div>
    </main>
</template>

<script>
import OrderSlider from '@/Pages/Main/Sections/OrderSteps/OrderSlider.vue'
export default{
    components: {
        OrderSlider
    }
}

</script>

<style scoped>
main {
  /* background: #fff; */
  overflow: hidden;
  display: flex;
  box-shadow: 0px 6px 18px rgba(0,0,0,0.161);
  flex-direction: column-reverse;
}
@media screen and (min-width: 900px) {
  main {
    flex-direction: row;
  }
}
main .content {
  padding: 3em 2em;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
@media screen and (min-width: 900px) {
  main .content {
    padding: 5em 4.5em;
  }
}
main .content a {
  text-decoration: none;
  color: #838383;
  font-size: 0.9rem;
  display: flex;
  align-items: center;
}
main .content a:hover {
  color: #eb8a88;
}
main .content span {
  font-size: 0.9rem;
  font-weight: 500;
}
main .content h1 {
  text-transform: capitalize;
  font-weight: 700;
}
main .content p {
  max-width: 350px;
}
main .content svg {
  width: 26px;
  margin-right: 10px;
}
main hr {
  background: #cecece;
  width: 30%;
  height: 1px;
  border: none;
  display: block;
  margin: 4em 0 1em 0;
}
@media screen and (min-width: 600px) {
  main hr {
    transform: rotate(90deg);
  }
}
@media screen and (min-width: 900px) {
  main hr {
    transform: rotate(0deg);
  }
}
ol {
  list-style: none;
  margin: 0;
  padding: 0;
  counter-reset: section;
  margin: 2em 0 2.5em 0;
}
li {
  display: flex;
  align-items: center;
  position: relative;
}
li+li {
  margin-top: 1em;
}
li::before {
  counter-increment: section;
  content: counters(section, '.') ' ';
  background: #000;
  color: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
  min-width: 26px;
  width: 26px;
  height: 26px;
  border-radius: 50%;
  font-size: 0.9rem;
  font-weight: 200;
  margin-right: 1em;
  position: relative;
  z-index: 66;
}
li:not(:last-child):after {
  content: '';
  width: 1px;
  height: 200%;
  background: #000;
  position: absolute;
  left: 12.5px;
  top: 50%;
}

/* Slider */



</style>
