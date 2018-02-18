# Workshop: Using interfaces effectively
This is a simple Laravel 5.5 PHP app that has been modified for the purpose of this workshop. It's a standard blog that's backed by sqlite, so there should be nothing surprising. 

## Getting Started
In order to run this codebase you'll need the following.
System Requirements:
- PHP 7+
- Redis
- SQLite
- Composer
- Webserver (apache/nginx)

Don't worry if you don't have all this setup on your machine, if you have docker or vagrant, we've got you covered.

### Docker
If you have docker installed, then it's much simpler to get started. Simply following [this tutorial](/install-docker.md).

### Vagrant
Vagrant is almost as easy as Docket. Simply following [this tutorial](/install-vagrant.md).

### Testing
After making your changes you'll want to ensure that you haven't broken anything, that's why there are a couple of unit/acceptance tests already in place.
To run the tests, simple run the following in the root dir of the app.

```
./vendor/bin/phpunit tests/
```

## The Challenges
As part of this workshop, there are three challenges. 

Notes:
- Interfaces are the key to each of these.
- You should work with your team to choose which challenge you'll focus on. 
- If you complete a challenge feel free to move onto another.
- You can use whatever library/technologies you like to complete them.
- If you need to modify the tests to get it working, feel free to do so.
- There are no wrong answers, there are just better implementations

### 1. PSR3 (Beginner)
We want to switch from our own naive implementation of a logger to the PSR3 standard
Notes:
- Extract the logger logic and wrap in a PSR3 interface
- Bind your implementation to the interface and inject it into the middleware
- Swap the implementation with Monolog

### 2. Slow API (Intermediate)
We are connecting to an API to fetch quotes to display in the app. This API is incredibly slow (ok, it isn't, but just pretend it is) and this is slowing down our acceptance tests.
This is impacting releases and development, so we want to use a fake version during acceptance tests.
Notes:
- When testing use the fake
- When in local/staging/production use the real one

### 3. Caching and timing (Hardmode)
The contacts list in admin is constantly getting hit with requests and it's impacting the DB (more pretending please). To fix this we want to cache the contact query results. 
We don't know if Redis or a Filesytem cache is better, so implement both, and time how they perform.
Notes:
- Write a cache in both Redis and the file system
- Make it easy to switch one version for another
- Time how fast each cache is
- Make it easy to enable or disable the timer
- Cache must be cleared when a user is stored (expect Eloquent to get in the way here)

