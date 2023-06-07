const routes = [
    {path: '/', page: 'home', filepath: 'routes/home/page.html' },
    {path: '/auth/login', page: 'login', filepath: 'routes/auth/login/page.html'},
    {path: '/auth/register', page: 'register', filepath: 'routes/auth/register/page.html'},
    {path: '/user/profile', page: 'profile', filepath: 'routes/user/profile/page.html'},
    {path: '/user/library/albums', page: 'albums', filepath: 'routes/user/library/albums/page.html'},
    {path: '/user/library/playlists', page: 'playlists', filepath: 'routes/user/library/playlists/page.html'},
    {path: '/content/album', page: 'album', filepath: 'routes/content/album/page.html'},
    {path: '/content/playlist', page: 'playlist', filepath: 'routes/content/playlist/page.html'},
    {path: '/content/artist', page: 'artist', filepath: 'routes/content/artist/page.html'},
    {path: '/error', page: 'error', filepath: 'routes/error/page.html'},
    {path: '/reseach', page: 'research', filepath: 'routes/research/page.html'},
]

let currentRoute = 'routes/home/page.html';

function FindRoute(path,routes){
    return routes.find((route) => route.path === path);
}



const router = () => {
    const url = location.hash.split('$');
    console.log("Hash change " + location.href);
    console.log(url);
    if (url.length > 1) {
        const parseLocation = () => url[0].slice(1,-1).toLowerCase() || '/';
        console.log(parseLocation());
        const page = FindRoute(parseLocation(),routes);
        currentRoute = page.filepath;
        console.log(page.page);
        console.log(url[1]);
        $('#inner-content').attr( 'src', window.location.pathname + currentRoute )
        window.document.addEventListener('iframeready', (e) => {
            console.count("Event iframeready received ");
            document.getElementById('inner-content').contentWindow.document.dispatchEvent(new CustomEvent('pagewithdata', {detail: {data: true}, bubbles: false}));
            console.count("Event pagewithdata sent ");
        },);
    }else{
        const parseLocation = () => location.hash.slice(1).toLowerCase() || '/';
        console.log(parseLocation());
        const page = FindRoute(parseLocation(),routes);
        currentRoute = page.filepath;
        console.log(page.page);
        $('#inner-content').attr( 'src', window.location.pathname + currentRoute )
    }
}

export {router};