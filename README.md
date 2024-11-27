https://www.canva.com/design/DAGTqn_zT4k/m_qjnrnzXJ7QeIWbZrm6QA/edit?utm_content=DAGTqn_zT4k&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton

This is a link to our First Presentation Slides 

http://169.239.251.102:3341/~papa.badu/EVPH-Project/akornorhome.php
This a link to our website 

http://169.239.251.102:3341/phpmyadmin/index.php?route=/&route=%2F&db=webtech_fall2024_papa_badu
This is the link to our Database 

https://www.canva.com/design/DAGTqn_zT4k/m_qjnrnzXJ7QeIWbZrm6QA/edit?utm_content=DAGTqn_zT4k&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton
This is the link to our slides

OUR PLANNED IMPLEMENTATIONS
Architecture Overview:
1. Planned Website Pages:
* Home Page: A welcoming page displaying the restaurant's basic information, promotions.
* Contact Us: Provides the option to contact Akornor hub for further enquireies
* About Us: Provides further information about Akornor hub
* Menu Page: A dynamic page that displays the daily meal options, prices, and special offers.
* Order Page: Allows users to place online orders.
* Reservation Page: Provides a system for customers to reserve tables, especially during peak hours.
* Feedback/Review Page: A section for users to leave feedback, rate meals.
* Admin Dashboard: Restricted to staff, this page enables management of the menu, orders, customer feedback, and site updates.
2. Supporting Tables and PHP Functions:
* Database Tables:
    * users: Stores user information (e.g., name, email, role - admin or customer).
    * menu_items: Stores all available food items, prices, and descriptions.
    * orders: Logs order details (user, items ordered, status, payment info).
    * reservations: Manages table reservation information (user, time, number of people).
    * feedback: Stores customer feedback and reviews.
* Key PHP Functions:
    * admin_menu_backend(): Handles adding new menu items (name, description, price) to the database.
    * auth_functions(): Handles user login and role-based authentication checks.
    * cancel_order(): Cancels an existing customer order in the system.
    * cancel_reservation(): Cancels a reservation in the system.
    * delete_user(): Deletes a user account from the system.
    * make_reservation(): Allows customers to create a new reservation in the system.
    * place_order(): Enables customers to place a new order in the system.
    * submit_feedback(): Submits customer feedback into the database.
    * update_order_status(): Updates the status of an existing order (e.g., from pending to completed).
    * update_user():Updates user information (e.g., name, contact details) in the database.
3. Implementation Status:
* Home Page: Basic layout completed with dynamic content integrated.
* Menu Page: Fully functional dynamic display of menu items with prices.
* Order Page: Complete form functionality for placing orders, integrated with the back-end.
* Reservation Page: Fully integrated with the reservations table for managing reservations.
* Feedback Page: Form functionality implemented and fully operational.
* Admin Dashboard: Fully implemented with menu and order management functions integrated.
* Contact Us Page: Complete page with necessary contact information.
* About Us Page: Completed with detailed information about the restaurant and services.
4. Frontend Technologies:
* CSS: A custom stylesheet is being used to ensure a consistent color scheme and responsive layout across all pages.
* JavaScript/jQuery: Basic form validation and dynamic updates to the menu page rely on jQuery.
* No frameworks: No external CSS frameworks (e.g., Bootstrap) are being used to keep the code lightweight and custom.
The design also follows responsive web design principles to cater to both desktop and mobile users.
5. Demo:
The demo will showcase the Menu Page, where users can view the daily menu items and prices, and the Order Page, where they can place an order. The demo will illustrate the core functionality that helps Akornor handle online orders, demonstrating the website's value to students and staff.

6.Instructions Setup the Server
Import the sql file located in the db folder and link the database in the db file in the same folder to connect.

