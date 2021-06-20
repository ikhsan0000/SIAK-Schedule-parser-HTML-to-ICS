//Constants
const staticCacheName = 'static-v1';
const assets = [
    'home.php',
    'app.js', 
    'css/mystyle.css',
    'images/offline.png',
    'fallback_offline.html'
];

//install SW event
self.addEventListener('install', e => 
{
    console.log('SW installed');
    e.waitUntil(
        caches.open(staticCacheName).then(async cache =>{
        console.log('caching . . .');
        cache.addAll(assets);
        console.log('caching completed.');
        })
    );
});

//activate SW event
self.addEventListener('activate', e =>
{
    e.waitUntil(
        caches.keys().then(keys =>
        {
            return Promise.all(keys
                .filter(key => key !== staticCacheName)
                .map(key => caches.delete(key))
            )
        })
    );
});

// fetch event
self.addEventListener('fetch', e => 
{
    // console.log('fetch event', e);
    e.respondWith(
        caches.match(e.request).then(cachesRespond =>
        {
            return cachesRespond || fetch(e.request).then(console.log(e.request))
        }).catch(() => caches.match('fallback_offline.html'))
    );
});


// Push notification
self.addEventListener('push', e =>
{
    console.log('SW Push Received');
    console.log('SW Push this: ' + e.data.text());

    const title = "Hey, SchedUIe here!";
    const option = {
        body: e.data.text(),
        icon: 'images/logo192.png',
        badge: 'images/logo144.png'
    };
    
    const notifPromise = self.registration.showNotification(title, option);
    e.waitUntil(notifPromise);
});