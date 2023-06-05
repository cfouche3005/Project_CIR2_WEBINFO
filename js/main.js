import { router } from "./router.js";
import { handleNotLogged } from "./auth-check.js";

window.addEventListener('hashchange', router);
window.addEventListener('load', router);

window.document.addEventListener('notlogged', handleNotLogged);
window.document.addEventListener('pagechange', (e) => {
    location.href = e.detail.href;
});
