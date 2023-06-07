import { router } from "./router.js";
import { handleNotLogged } from "./auth-check.js";
import { AudioPlayer } from "./player.js";

const player = new AudioPlayer();

window.addEventListener('hashchange', router);
window.addEventListener('load', router);

window.document.addEventListener('notlogged', handleNotLogged);

// window.document.addEventListener('pagechange', (e) => {
//     console.log("Event pagechange received " + location.href);
//     location.href = e.detail.href;
// });


// window.document.addEventListener('iframeready', (e) => {
//     console.log(document.getElementById('inner-content').contentWindow.document);
// });

window.document.addEventListener('playmusic', (e) => {
    console.log("Event playmusic received ");
    console.log(window.sessionStorage.getItem('playmusic'));
    player.playNew(JSON.parse(window.sessionStorage.getItem('playmusic')));
});
