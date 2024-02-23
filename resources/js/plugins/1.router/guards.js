import { useCookie } from '@core/composable/useCookie';

export const setupGuards = (router) => {
  router.beforeEach((to, from, next) => {
    const isLoggedIn = !!(useCookie('userData').value && useCookie('accessToken').value);

    // DEBUGGING
    
    console.log('Stored Cookies: ')
    console.log('IsLoggedIn: ', isLoggedIn);
    console.log(useCookie('userData').value);
    console.log(useCookie('accessToken').value);
    console.log(useCookie('rememberToken').value);
    
    //

    if (isLoggedIn) {
      if (to.name === 'login') {
        next({ name: 'dashboard', query: { to: to.fullPath } });
      }
      next();
    } 
    else {
      if (to.name !== 'login') {
        next({ name: 'login', query: { to: to.fullPath } });
      } else {
        next();
      }
    }
  });
};
