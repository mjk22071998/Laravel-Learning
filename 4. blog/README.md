# Blog Project

## Features

-   User authentication (login, registration, password reset)
-   Create, edit, and delete blog posts
-   View single blog posts
-   Categorize posts with tags
-   Comment on posts
-   WYSIWYG editor for post content
-   HTML Purifier for post content sanitization against XSS attacks.
-   Responsive design with a user-friendly interface
-   Reusable components for consistent UI

## Installation

1. Clone the repository.
2. Run `composer install` to install dependencies.
3. Set up your `.env` file and run migrations with `php artisan migrate`.
4. Start the Vite server with `npm run dev` for asset compilation.
5. Start the Laravel server with `php artisan serve`.

## Usage

-   Access the application at `http://localhost:8000`.
-   Use the navigation to explore blog posts, categories, and user authentication features.
-   The front end is powered by Vite, allowing for fast development and hot module replacement.
