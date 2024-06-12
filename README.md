# NoteTaking App
Learning laravel by building a note taking app
## Setup
### Prerequisites:
- PHP 7.4 or higher
- Composer
- Node.js and npm
- MySQL or any other supported database
### Installation Steps:
- Install PHP dependencies: `composer install`
- Copy the .env.example file to .env: `cp .env.example .env`
- Generate an application key: `php artisan key:generate`
- Configure the database connection in the .env file
- Run database migrations: `php artisan migrate`
- Install JavaScript dependencies: `npm install`
- Build the assets: `npm run dev` (for development) or `npm run prod` (for production)
- Start the development server: `php artisan serve`