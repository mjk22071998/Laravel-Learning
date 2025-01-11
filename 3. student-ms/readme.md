# Student Management System

## Overview

The **Student Management System** is a web-based application built with Laravel. It allows administrators to manage students, classes, and subjects efficiently. Each student belongs to a specific class and can enroll in multiple subjects.

## Features

-   **Student Management**
    -   Add new students.
    -   Assign students to classes.
    -   Enroll students in multiple subjects.
-   **Class Management**
    -   Define and manage classes.
-   **Subject Management**
    -   Define and assign subjects to students.
-   **Eloquent Relationships**
    -   `belongsTo`, `hasMany`, and `belongsToMany` relationships for efficient data handling.

## Technologies Used

-   **Backend:** Laravel Framework
-   **Frontend:** Blade Templates
-   **Database:** MySQL
-   **ORM:** Eloquent

## Installation

### Prerequisites

-   PHP >= 8.0
-   Composer
-   MySQL
-   Node.js & npm (for frontend assets)

### Steps

1. Clone the repository:
    ```bash
    git clone https://github.com/your-repo/student-management-system.git
    cd student-management-system
    ```
2. Install dependencies:
    ```bash
    composer install
    npm install && npm run dev
    ```
3. Set up the `.env` file:

    - Copy `.env.example` to `.env`:
        ```bash
        cp .env.example .env
        ```
    - Update database credentials in the `.env` file.

4. Run migrations and seed the database:
    ```bash
    php artisan migrate --seed
    ```
5. Generate the application key:
    ```bash
    php artisan key:generate
    ```
6. Start the development server:
    ```bash
    php artisan serve
    ```

## Usage

1. Access the application in your browser:
    ```
    http://127.0.0.1:8000
    ```
2. Navigate to the **Students** section to add, edit, or delete students.
3. Use the dropdowns to assign a class and subjects to a student during the creation process.

## Eloquent Relationships

### Student Model

-   Belongs to a `User`.
-   Belongs to a `ClassModel`.
-   Has many-to-many relationships with `Subject` through the `student_subject` pivot table.

### ClassModel

-   Has many `Student` models.

### Subject

-   Has many-to-many relationships with `Student` models through the `student_subject` pivot table.

## Key Endpoints

### Web Routes

-   `GET /students` - List all students.
-   `GET /students/create` - Show the form to create a new student.
-   `POST /students` - Store a new student.
-   `GET /classes` - List all classes.
-   `GET /subjects` - List all subjects.

## Database Schema

### Tables

1. **users**
    - Stores user information (name, email, password).
2. **students**
    - Links to `users` and `class_models`.
3. **class_models**
    - Stores class details.
4. **subjects**
    - Stores subject details.
5. **student_subject**
    - Pivot table for the many-to-many relationship between students and subjects.

## Contributing

1. Fork the repository.
2. Create a new branch:
    ```bash
    git checkout -b feature-name
    ```
3. Commit your changes:
    ```bash
    git commit -m "Add new feature"
    ```
4. Push to your branch:
    ```bash
    git push origin feature-name
    ```
5. Submit a pull request.

## License

This project is open-source and available under the [MIT License](LICENSE).
