import { useCookie } from '@core/composable/useCookie';
import axios from 'axios';

export const setupGuards = (router) => {
  router.beforeEach((to, from, next) => {
    const isLoggedIn = !!(useCookie('userData').value && useCookie('accessToken').value); // Check if user is logged in 

    // DEBUGGING
    console.log('Stored Cookies: ')
    console.log('IsLoggedIn: ', isLoggedIn);
    console.log(useCookie('userData').value);
    console.log(useCookie('accessToken').value);
    console.log(useCookie('rememberToken').value);
    
    if (isLoggedIn) {

      // Logic to keep logged in or not
      const handleBeforeUnload = async (event) => {
        // Cancel the event
        event.preventDefault();
        // Chrome requires returnValue to be set
        event.returnValue = '';

        // Logout and clear Cookies if not Keep
        if (!useCookie('rememberToken').value || typeof useCookie('rememberToken').value === 'undefined') {
          try {
              await axios.post('/api/auth/logout');
              useCookie('userData').value = null;
              useCookie('accessToken').value = null;
          } catch (error) {
              console.error('Logout Failed:', error);
          }
        }
      };
    
      // Add event listener for beforeunload event when the component is mounted
      window.addEventListener('beforeunload', handleBeforeUnload);
    
      // Remove event listener for beforeunload event when the component is unmounted
      onBeforeUnmount(() => {
        window.removeEventListener('beforeunload', handleBeforeUnload);
      });

      // Push to dashboard if Logged In
      if (to.name === 'login') {
        next({ name: 'dashboard', query: { to: to.fullPath } });
      }
      next();
    } 
    else {
      // Push to Login if Not Logged In
      if (to.name !== 'login') {
        next({ name: 'login', query: { to: to.fullPath } });
      } else {
        next();
      }
    }
  });
};
