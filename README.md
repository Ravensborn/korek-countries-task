## Korek - Countries Assignment

The countries project is a web application built with Laravel 10 and Laravel Livewire that allows users to fetch all countries in the world and search for specific countries by name or filter countries by region. The project includes a user-friendly front-end interface and is designed to provide a seamless user experience.

The application uses Laravel's built-in features and packages to ensure security, reliability, and scalability. The code is well-structured, following Laravel's best practices and conventions, making it easy to maintain and extend.

## Installation

- Make sure you are on latest version of composer.
- Clone the repo.
- Navigate to the project directory and run `composer install`.
- Fire up your web server or run `php artisan serve`.
- That's it.

## Notes
- If you're willing to run the project on a non-root path like `https://localhost/myprojects/this-project` or `https://project.test/this-project`, please make sure to make necessary changes to livewire config, as described [here](https://laravel-livewire.com/docs/2.x/installation#configuring-the-asset-base-url).
- 

## The Project
- The project consists of two pages that are built with Laravel Livewire.
- The frontend components are: `resources/views/livewire/countries/index.blade.php` and `resources/views/livewire/countries/show.blade.php`.
- The backend components are: `Http/Livewire/Countries/Index.php` and `Http/Livewire/Countries/Show.php`.
- The project boots and does an API call to `restcountries.com` to fetch the data, after that all the filtering is done client side for better user experience.
- The show country page fetches the country data from the API based on its lowercase `cca3` code.
## Demo
 - A demo of the application is live at [demo.rozhapp.com](https://demo.rozhapp.com).
