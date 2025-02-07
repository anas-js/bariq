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
    <span ref="span"><img src="~/assets/images/star.svg" /></span>
</template>

<style lang="scss" scoped>
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
    img {
        // width: 100%;
        width: 20px;
        // height: 20px;
    }

}
</style>
