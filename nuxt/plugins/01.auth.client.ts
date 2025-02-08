

export default defineNuxtPlugin(async (nuxt) => {
  const $auth = useAuth();





  // await $api.get($app().BK_URL.csrf);
  await $api
    .get<any>(`${$app().BK_URL.api}/user`)
    .then((res) => {
      $auth.setUser(res);
      $auth.setLoginStatus(true);
    }).catch(() =>{})
});
