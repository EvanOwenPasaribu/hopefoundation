export default function auth({ next, router, from}) {
    if (!localStorage.getItem('usertoken')) {
      localStorage.setItem('urlcontinue', window.location.href );
      return router.push({ name: 'login' });
    }
    return next();
  }