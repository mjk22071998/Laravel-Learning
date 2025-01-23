# RESTFUL API

This project is a RESTful API built with Laravel, providing various endpoints for user authentication, vehicle management, and inspections. The project does not include any views, focusing solely on API routes and controllers.

## Installation Instructions

1. Clone the repository:

    ```bash
    git clone <repository-url>
    ```

2. Navigate to the project directory:

    ```bash
    cd <project-directory>
    ```

3. Install dependencies:

    ```bash
    composer install
    ```

4. Set up the environment file:

    ```bash
    cp .env.example .env
    ```

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Run the migrations:

    ```bash
    php artisan migrate
    ```

7. Start the server:

    ```bash
    php artisan serve
    ```

## API Routes

### Authentication Routes

-   `POST /register`: Registers a new user.
-   `POST /login`: Logs in a user.
-   `POST /logout`: Logs out a user (requires authentication).

### User Routes

-   `GET /getDrivers`: Retrieves a list of drivers.
-   `POST /users/{userId}/assign-vehicle`: Assigns a vehicle to a user.
-   `GET /users/{userId}/assigned-vehicles`: Retrieves assigned vehicles for a user.

### Vehicle Routes

-   `GET /vehicles`: Retrieves all vehicles.
-   `POST /vehicles`: Adds a new vehicle.
-   `PUT /vehicles/{id}`: Updates an existing vehicle.
-   `DELETE /vehicles/{id}`: Deletes a vehicle.

### Inspection Routes

-   `GET /inspections`: Retrieves all inspections.
-   `POST /inspections`: Stores a newly created inspection.
-   `PUT /inspections/{id}`: Updates an existing inspection.
