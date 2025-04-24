
const option = {
  headers: {
    Accept: "application/json",
  },

  async onRequest({ request, options }) {
    const host = new URL(request).hostname;
    if ($app().domain.includes(host)) {
      options.credentials = "include";
      // if (options.method == "POST") {

      // }



      options.headers = new Headers(options.headers || {});
      options.headers.set("X-XSRF-TOKEN",useCookie('XSRF-TOKEN').value);
      // options.headers.set(
      //   "Authorization",
      //   String("Bearer " + cookie.get("juzr_token"))
      // );
    }
  },
  async onResponseError({ request, options, response }) {
    const $auth = useAuth();
    if (response.status === 419) {
      await $api.get($app().BK_URL.csrf, {
        credentials: "include",
      });
    }

    if (response.status === 429) {
      $msg({
        text: 'العديد من الطلبات يرجى المحاولة بعد دقيقة',
        type: "error",
      });
    }

    if (response.status === 401 && $auth.loggedIn) {
    //   await window.location.reload();
    }

    if (response.status === 503) {
      await navigateTo("/503", {
        external: true,
      });
    }
  },
  retry : 0
};

export const $api = {
  get: $fetch.create({
    ...option,
    method: "GET",


  }),
  post: $fetch.create({
    ...option,
    method: "POST",

  }),
};
