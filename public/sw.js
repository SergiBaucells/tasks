importScripts("/service-worker/precache-manifest.1a57c9ce9e25f7ada26b4cc1bb37735c.js", "https://storage.googleapis.com/workbox-cdn/releases/3.6.3/workbox-sw.js");

workbox.skipWaiting()
workbox.clientsClaim()

workbox.precaching.precacheAndRoute(self.__precacheManifest)
// workbox.precaching.precacheAndRoute([]) També funciona i workbox substitueix pel que pertoca -> placeholder

// images
workbox.routing.registerRoute(
  new RegExp('.(?:jpg|jpeg|png|gif|svg|webp)$'),
  workbox.strategies.cacheFirst({
    cacheName: 'images',
    plugins: [
      new workbox.expiration.Plugin({
        maxEntries: 20,
        purgeOnQuotaError: true
      })
    ]
  })
)

workbox.routing.registerRoute(
  '/',
  workbox.strategies.staleWhileRevalidate({ cacheName: 'landing' })
)

workbox.routing.registerRoute(
  '/css/footer.css',
  workbox.strategies.staleWhileRevalidate({ cacheName: 'landing' })
)

