import { useCookie } from '@core/composable/useCookie';

export const setupGuards = (router) => {
  router.beforeEach((to, from, next) => {
    const isLoggedIn = !!(useCookie('userData').value && useCookie('accessToken').value);
    console.log(useCookie('userData').value);
    console.log(useCookie('accessToken').value);
    

    // Redirect to the home page if the user is already logged in and tries to access login or registration pages
    
    /*
    
    if ((to.name === 'login' || to.name === 'register') && isLoggedIn) {
      next({ name: 'dashboard' });
      return;
    }
    console.log(isLoggedIn);
    
    */
   
    // Redirect to the not-authorized page if the user doesn't have permission to access the route
    
    /*
    
    if (!canNavigate(to)) {
      if (isLoggedIn) {
        next({ name: 'not-authorized' });
      } else {
        // Redirect to a different route or display a message indicating lack of permission
        // Example: next({ name: 'unauthorized' });
        console.error('User does not have permission to access the route');
      }
      return;
    }
    
    */
    // Allow navigation to the requested route
    next();
  });
};
