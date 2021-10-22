export default function authfordonatur({ next, router, from}) {
    if (localStorage.getItem('userstatus')=="0") {
      return router.push({ name: 'nameusers' });
    }
    return next();
  }