// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  ssr: false,
  app :{

    head : {
        title : "Bariq",
        link : [
            {href:"https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@400..800&display=swap", rel:'stylesheet'}
        ]
    }
  },
  appConfig : {
    BK_URL: {
        api: "https://bariq.app/api",
        csrf: `https://bariq.app/sanctum/csrf-cookie`,
      },
      FR_URL: 'https://bariq.app:3000',
      domain: 'bariq.app',
  },
  css:[
    '~/assets/styles/main.scss',
    "remixicon/fonts/remixicon.css",
  ],
  modules : ['@hypernym/nuxt-anime'],
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
