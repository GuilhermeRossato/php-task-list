# PHP Task List App

A mobile-first progressive web app written with the `declarative-php` framework with google's material ui styling.

The application includes pagination, dynamic page changes and task saving on Memcache.

If you don't have memcache either install it locally or edit `/src/Connection.php` to connect to a local storage solution.

## Structure

The app was created with OOP in mind.

Initially, the layout of the page is served and then the page requests only the content of that url, every subsequent request only requests the content  of the page, without the headers and its scripts or styles

The index class is `ApplicationRouter` that distributes the request to `ApiResponse` or `ApiExecute`, depending on the nature of the request.

## Yet to be written

I should still create a manifest.json and configure asset caching for offline usage so that this can be used as a true web app, but the rest is in place.