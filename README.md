# inmakes

Create a PHP class that retrieves data from a remote REST API and caches the results to improve
performance.
The class should have the following features:

1. A constructor method that takes the URL of the REST API as an argument.
2. A public method called "getData" that retrieves the data from the API.
3. The "getData" method should first check if the data is already cached. If it is, return the cached
data. If not,
retrieve the data from the API, cache it, and return it.
4. The cached data should be stored for a configurable amount of time (e.g. 5 minutes) before being
invalidated and re-fetched from the API.

Additional requirements:
The class should be flexible enough to work with any REST API that returns JSON data.
The class should handle errors gracefully, e.g. if the API is down or returns an error response.
The caching mechanism should be efficient and not consume too much memory or disk space.
The class should be well-documented and include appropriate comments and unit tests.

Note: You may use built-in PHP functions for making HTTP requests, working with JSON data, and
caching data.
