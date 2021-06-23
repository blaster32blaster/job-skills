# Job Skills

the objective of this application is to add skills to a list, rate yourself, and then see a list of jobs
ordered by relevancy

## Framework Setup

- clone project locally.
- ensure that docker is running on the system and has sufficient resources allocated.
- navigate to root project directory
- run command :

  ``` bash
  docker-compose up
  ```

## Use of Application

- navigate to localhost:8077
  
## FAQ

- if there is a port conflict on a user's local system, change the port listed in the root docker-compose.yml

## Things to improve

- There should be more tests written here.  Ran short on time and wasnt able to build these out to the desired extent
- clean up the search functionality some.  This feature could be made leaner and more reusable
- Bring in a front end unit testing framework
