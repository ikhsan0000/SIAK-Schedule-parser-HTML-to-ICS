//Constants
const staticCacheName = 'static';
const assets = [
    '/home.html',
    '/app.js', 
    'css/style.css',
    'img/header-pattern-150.png'
];

//install SW event
self.addEventListener('install', e => 
{
    console.log('SW installed');
    e.waitUntil(
        caches.open(staticCacheName).then(cache =>{
        console.log('caching . . .');
        cache.addAll(assets);
        })
    );
});

//activate SW event

self.addEventListener('activate', e =>
{
    console.log('SW has been activated');
});

// fetch event
self.addEventListener('fetch', e => 
{
    // console.log('fetch event', e);
    e.respondWith(
        caches.match(e.request).then(cachesRespond =>{
            return cachesRespond || fetch(e.request);
        })
    )
});

// Push notification
self.addEventListener('push', e =>
{
    console.log('SW Push Received');
    console.log('SW Push this: "${event.data.text()}"');

    const title = "Hey, SchedUIe here!";
    const option = {
        body: 'Tanggal Cuti Bersama Direvisi A!',
        icon: 'images/logo192.png',
        badge: 'images/logo144.png'
    };
    
    const notifPromise = self.registration.showNotification(title, option);
    e.waitUntil(notifPromise);
});