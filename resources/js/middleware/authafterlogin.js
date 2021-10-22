export default function authafterlogin({ next, router}) {
    if (localStorage.getItem('usertoken')) {
      return router.push({ name: 'welcome' });
    }
    return next();
  }