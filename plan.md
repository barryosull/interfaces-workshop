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
	- Extract repo logic into interface
	- Replace with redis impl
	- Run both at the same time, use existing to check result of the old

## Workshop implementation:
Use https://github.com/bestmomo/laravel5-5-example as a base template

Done: 
- Added HTTP request logging, do it with standard write to file PHP logic
- Fetched quote from API and displayed the result

TODO:
- Add test for Http logger
- Add test for index page view

Task descriptions
1. Refactor request logging, put the implementation details behind a PSR3 interface
2. Don't hit the real API during acceptance tests, use a fake instead
3. Store contacts in redis, but keep the DB version, run them side by side using one to check the result of the other, if they don't match, log an error