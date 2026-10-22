-- create_admin_and_bookings.sql
-- Run this SQL once in phpMyAdmin to ensure tables exist

CREATE DATABASE IF NOT EXISTS hecor_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE hecor_db;

CREATE TABLE IF NOT EXISTS bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    device_type VARCHAR(50) NOT NULL,
    issue_description TEXT NOT NULL,
    preferred_date DATE,
    status VARCHAR(20) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Initial admin (plain-text password per your choice)
INSERT INTO admins (username, password) VALUES ('admin', 'hecor2025');
