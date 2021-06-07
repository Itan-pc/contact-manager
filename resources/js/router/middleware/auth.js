export default async function auth({ next, store }) {
  if (!store.getters.auth.isAuthorized) {
      next({
        name: "login"
      });
  }

  return next();
}
