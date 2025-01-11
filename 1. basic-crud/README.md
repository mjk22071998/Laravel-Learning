# Basic CRUD Operations Project

## Description

This project demonstrates the fundamental Create, Read, Update, and Delete (CRUD) operations in a Laravel application. The primary focus is on managing product data through a simple interface and performing basic operations efficiently using Eloquent ORM. It serves as an educational project for understanding Laravel's core functionalities for database interactions and form handling.

## Features

1. **Product Management:**

    - Add new products.
    - View a list of all products.
    - Edit product details.
    - Delete products.

2. **Validation:**

    - Ensures data integrity with validation rules for product fields such as name, stock, price, and optional description.

3. **Database Interaction:**
    - Utilizes Eloquent ORM for seamless interaction with the `Product` model and database table.

## Controllers and Functionality

### `ProductController`

-   **`index()`**: Retrieves all products and passes them to the `products.index` view for display.
-   **`create()`**: Returns a view for adding a new product.
-   **`edit(Product $product)`**: Returns a view for editing the details of a specific product.
-   **`store(Request $request)`**: Handles the creation of a new product after validating input data.
-   **`update(Request $request, Product $product)`**: Updates an existing product's details after validating input data.
-   **`delete(Product $product)`**: Deletes a specific product and redirects to the product list.

## Validation Rules

-   **`name`**: Required (string).
-   **`stock`**: Required (numeric).
-   **`price`**: Required (decimal, up to 2 decimal places).
-   **`description`**: Optional.

## Purpose

This project is ideal for:

-   Beginners learning Laravel basics.
-   Practicing CRUD operations with Eloquent ORM.
-   Understanding data validation and form handling in Laravel.
