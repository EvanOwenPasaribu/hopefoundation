export default function authforadmin({ next, router, from}) {
    if (localStorage.getItem('userstatus')=="1") {
      return router.push({ name: 'welcome' });
    }
    return next();
  }