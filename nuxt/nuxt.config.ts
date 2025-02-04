// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  app :{
    head : {
        link : [
            {href:"https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@400..800&display=swap", rel:'stylesheet'}
        ]
    }
  },
  css:[
    '~/assets/main.scss',
    "remixicon/fonts/remixicon.css",
  ],
  devtools: { enabled: false }
})
