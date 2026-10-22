HECOR Website + Booking System (XAMPP)
=====================================

Folder (place in XAMPP htdocs):
  htdocs/hecor/

Files included:
  - index.html
  - config.php
  - create_admin_and_bookings.sql
  - book_repair.php
  - success.html
  - admin_login.php
  - admin_dashboard.php
  - logout.php
  - email_notification.php

Database:
  - Name: hecor_db
  - SQL file: create_admin_and_bookings.sql (run in phpMyAdmin)

Admin credentials (local/test):
  - Username: admin
  - Password: hecor2025

PHPMailer (Gmail SMTP) Setup:
  1) Install Composer: https://getcomposer.org/download/
  2) From the project folder (htdocs/hecor) run:
       composer require phpmailer/phpmailer
  3) Open email_notification.php and set:
       - $smtpUsername = 'yourgmail@gmail.com';
       - $smtpPassword = 'your_app_password_here';
     For Gmail, create an App Password and use it here.
  4) Test the booking form (index.html) and verify you receive email.

How to install and run locally:
  1) Put the 'hecor' folder in C:\xampp\htdocs\
  2) Start Apache and MySQL from XAMPP Control Panel
  3) Open phpMyAdmin -> Import create_admin_and_bookings.sql (or run SQL)
  4) Visit: http://localhost/hecor/index.html
  5) Submit a booking via the form
  6) Login to admin: http://localhost/hecor/admin_login.php

Security notes:
  - Current admin password is stored in plain text (for local/testing only).
  - Before publishing, switch to hashed passwords and use HTTPS.
  - Do not commit sensitive credentials to public repos.

If you want, I can:
  - Convert admin passwords to hashed storage (recommended).
  - Create a version that does not require Composer (bundled PHPMailer).
  - Add an admin export CSV feature.
