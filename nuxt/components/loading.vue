<script setup lang="ts">
const span = ref() as Ref<HTMLElement>;
// onMounted(() =>{
//     // window.getComputedStyle(span.value.parentElement).paddingTop
//    const style =  window.getComputedStyle(span.value.parentElement);
//    const need = parseInt(style.height)-(parseInt(style.paddingTop)+parseInt(style.paddingBottom));
//    console.log(style.height);
// //    span.value.style.width = need+'px';
//    span.value.style.height = need+'px';
// })
</script>


<template>
    <span ref="span"><svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M25.5476 10.5714C22.1012 7.00196 18.5 0 18.5 0C18.5 0 15.5636 7.04883 12.3333 10.5714C8.46344 14.7915 0 18.5 0 18.5C0 18.5 8.52559 20.8589 12.3333 24.6667C16.1411 28.4744 18.5 37 18.5 37C18.5 37 21.5274 28.4891 25.5476 24.6667C29.2288 21.1665 37 18.5 37 18.5C37 18.5 29.326 14.4847 25.5476 10.5714Z"/>
</svg>
</span>
</template>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@keyframes  rotate360 {
    100% {
        transform: rotateZ(360deg);
    }
}
span {
    width: 30px;
    height: 30px;
    display: block;
    margin: 0 auto;
    animation: rotate360 1s infinite cubic-bezier(0.31, 0.79, 0.34, 0.77);
    display: flex;
    justify-content: center;
    align-items: center;
    svg {
        // width: 100%;
        width: 20px;
        fill:$color_white
        // height: 20px;
    }

}
</style>
