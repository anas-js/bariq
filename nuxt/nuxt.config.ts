// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  ssr: false,
  app :{

    head : {
        link : [
            {href:"https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@400..800&display=swap", rel:'stylesheet'}
        ]
    }
  },
  css:[
    '~/assets/styles/main.scss',
    "remixicon/fonts/remixicon.css",
  ],
  devServer: {
    host: "bariq.app",
    port: 3000,
    https: {
      cert: "C:\\laragon\\etc\\ssl\\laragon.crt",
      key: "C:\\laragon\\etc\\ssl\\laragon.key",
    },
  },
  devtools: { enabled: false },
})
