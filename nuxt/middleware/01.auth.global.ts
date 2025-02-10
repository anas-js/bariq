
export default defineNuxtRouteMiddleware(async (to) => {

  const $auth = useAuth();



  if (to.meta?.auth === false || !to.name) {
    console.log("go4");
    return;
  }

  if (to.meta?.guest) {
    if ($auth.loggedIn) {
        console.log("go3");
      return navigateTo('/');
    }
    return;
  }


  if (!$auth.loggedIn && !to.meta.login) {
    console.log("go");
    return navigateTo(`/login`);
  } else if ($auth.loggedIn && to.meta.login) {
    console.log("go2");
    return navigateTo(`/dashboard`);
  }
});
