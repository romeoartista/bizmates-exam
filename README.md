# Bizmates PHP Developer Exam    

### Setup    
```
// Clone repository
$ git clone git@github.com:romeoartista/bizmates-exam.git

// Create .env file from .env.example
$ cp .env.example .env

// Install composer packages
$ composer install

// Install node packages
$ npm install

// Generate Laravel app key
$ php artisan key:generate

// Run migration
// When asked if you would like to create the database, answer yes
$ php artisan migrate

// Compile Vue files by Vite
$ npm run build

// Start PHP build-in webserve
$ php artisan serve
```
    
### Usage    
```
Browse to http://localhost:8000 on a web browser to start using
```

### Explanation
```
The frontend design in my mind is the best implementation as it allows a potential user to see everything they want to see of a city.

I opted with a service design pattern so that the service classes are able to isolate itself from the business logic and would only be concerned of their purpose.
```