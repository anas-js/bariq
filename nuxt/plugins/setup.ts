import vclick from "click-outside-vue3"
export default defineNuxtPlugin(async (nuxt) => {
    nuxt.vueApp.use(vclick);

    // await document.fonts.ready
});
