
export default defineNuxtRouteMiddleware(async (to) => {

  const $auth = useAuth();



  if (to.meta?.auth === false || !to.name) {
    return;
  }

  if (to.meta?.guest) {
    if ($auth.loggedIn) {
      return navigateTo('/');
    }
    return;
  }


  if (!$auth.loggedIn && !to.meta.login) {
    return navigateTo(`/login`);
  } else if ($auth.loggedIn && to.meta.login) {
    return navigateTo(`/dashboard`);
  }
});
