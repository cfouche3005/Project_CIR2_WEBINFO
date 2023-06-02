const routes = [
    { path: '/', page: 'home' },
    {path: '/auth/login', page: 'login'},
    {path: '/auth/register', page: 'register'},
    {path: '/user/profile', page: 'profile'},
    {path: '/user/library/albums', page: 'albums'},
    {path: '/user/library/playlists', page: 'playlists'},

]


const router = () => {
    const parseLocation = () => location.hash.slice(1).toLowerCase() || '/';
    const
}

$('#inner-content').src();