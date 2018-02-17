# Workshop plan

## Presentation on Interfaces
- What are interfaces
- Why use them
- Guiding heuristic (is there is more than one instance of something in the same codebase, use an interface)
- Language as the key (extract what we want to do from how we're going to do it)
- The benefits
- Testing
- Containers and providers
- PSR3 and Monolog
- Flysystem
- The workshop

## Workshop 
- Take an existing repo
- Task 1: Simple
	- Extract the logger logic and wrap in the PSR3 interfaces 
	- Swap the implementation with Monolog
- Task 2: Advanced
	- Extract Guzzle API calls, hide behind interface
	- Use a fake implementation in the acceptance tests
- Task 3: Showing off
	- Implement a cache for getting the list of contacts
	- Write a cache in both Redis and a file system
	- Make it easy to switch one version for another
	- Time how fast each cache is
	- Make it easy to enable or disable the timer
	- Cache must be cleared when a user is stored
	
## Workshop implementation:
Use https://github.com/bestmomo/laravel5-5-example as a base template

Done: 
- Added HTTP request logging, do it with standard write to file PHP logic
- Fetched quote from API and displayed the result
- Added test for Http logger
- Added test for index page view
- Added acceptance test for contact add/get
- Figured out challenge 3

TODO:

Task descriptions
1. Refactor request logging, put the implementation details behind a PSR3 interface
2. Don't hit the real API during acceptance tests, use a fake instead
3. Cache the contact query results. We don't know if redis or filebased is better, so implement both, time how they perform 