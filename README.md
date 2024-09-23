# Online Retail Web Application 2.0

This is a web application designed to manage an online retail platform. The application allows users to browse products, add items to the cart, and make purchases. The admin panel provides an interface to manage inventory, orders, and customer data. 

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Configuration](#configuration)
- [File Structure](#file-structure)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

---

## Features

1. **Product Catalog**: Users can browse a list of products with details such as price and description.
2. **Shopping Cart**: Users can add products to their cart and proceed to checkout.
3. **Admin Dashboard**: Admins can manage products, view orders, and analyze sales statistics.
4. **User Authentication**: Secure login and registration functionality for both customers and administrators.
5. **Database Backups**: Option for admins to manually trigger database backups.
6. **File Management**: Ability to upload and manage files (e.g., product images) through the admin panel.
7. **Monitoring System**: Includes system metrics such as server uptime, memory usage, and database statistics.

---

## Technologies Used

- **Backend Language**: PHP (for business logic and connecting to the database)
- **Frontend**: HTML, CSS (for layout and styling), JavaScript (for dynamic functionality)
- **Database**: MySQL (for storing product, order, and user data)
- **Server**: Apache 
- **Version Control**: Git and GitHub (for code management)
- **Deployment**: Render (for hosting the web application) -> Implementaion stage
- **Containerization (Optional)**: Docker (for consistent deployment environments)

---

## Installation

### Step 1: Clone the Repository
First, you need to clone this repository to your local machine. Use the following command:


git clone https://github.com/YOUR_USERNAME/online-retail.git
Step 2: Install Dependencies
For this PHP project, you'll need to ensure your environment has the following installed:

PHP (v7.4 or higher)
MySQL Server
XAMPP (to serve the application)
Step 3: Setup Database
Create a MySQL database named project.
Run the provided SQL file (db.sql) to set up the necessary tables.
Update the database connection details in the file config.php or system_info.php as necessary:

$con = mysqli_connect("localhost", "root", "", "project");

Step 4: Start the Server
If you're using a local environment like XAMPP or WAMP, place your project in the htdocs directory and start Apache and MySQL services. Then access the application by visiting http://localhost/online-retail/.

Configuration
Database Configuration: Update config.php or system_info.php with your MySQL database credentials.
File Permissions: Ensure that the uploads/ directory has write permissions if using file upload functionality.
Backup Configuration: Modify the backup.php script to adjust the backup path or schedule automatic backups using cron jobs (if applicable).

File Structure
Here’s a breakdown of the main files in this project:

index.php: The home page of the application displaying the product catalog.
cart.php: Manages the shopping cart functionality.
admin/: Contains the admin panel files for managing the store, including:
dashboard.php: Displays the admin dashboard with system statistics.
products.php: Admin page for managing product listings.
orders.php: View and manage customer orders.
system_info.php: Contains system monitoring functions for server uptime, CPU load, memory usage, etc.
backup.php: Script to manually trigger a database backup.
style.css: Contains the styling for the entire web application.
uploads/: Directory for storing uploaded product images or other files.
db.sql: SQL file containing the database structure required for the application.
Dockerfile: (Optional) Instructions for containerizing the application for deployment.

Usage
Frontend:
Customers can browse products, add items to their shopping cart, and proceed to checkout.
Login or create an account to view past orders or complete purchases.
Admin Panel:
Admins can log in to manage products, view orders, and backup the database from the admin dashboard.
File upload functionality allows admins to upload product images.

Deployment
To deploy this project on Render:

Create a Dockerfile in the root directory for deployment if using Docker. Ensure the PHP and Apache environment is set up correctly (instructions provided in the README).
Push your code to a GitHub repository.
Connect your GitHub repository to Render and configure the service for PHP or Docker.

Contributing
Contributions are welcome! If you would like to improve this project, feel free to fork the repository and submit a pull request.
Fork the repository.
Create your feature branch (git checkout -b feature/your-feature).
Commit your changes (git commit -m 'Add some feature').
Push to the branch (git push origin feature/your-feature).
Open a pull request.

License
Public
---

### Steps to Deploy on GitHub
1. **Extract your project files** and ensure that all code is organized properly.
Push your code and make sure everything is live on GitHub.
