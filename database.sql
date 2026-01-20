CREATE DATABASE trimatric_medi_manager;
USE trimatric_medi_manager;

-- 1. Users Table
CREATE TABLE users (
    username VARCHAR(20) PRIMARY KEY,
    full_name VARCHAR(50) NOT NULL,
    nid VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    address TEXT,
    password VARCHAR(32) NOT NULL,
    phone_no VARCHAR(15) NOT NULL,
    role VARCHAR(20) NOT NULL 
);

-- 2. Inventory Table
CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(50) NOT NULL,
    purchase_date DATE NOT NULL,
    quantity INT DEFAULT 0,
    category VARCHAR(50),
    expire_date DATE NOT NULL,
    status VARCHAR(20) 
);

-- 3. Main Patient Record Table
CREATE TABLE patients (
    patient_serial INT AUTO_INCREMENT PRIMARY KEY,
    patient_name VARCHAR(50) NOT NULL,
    phone_no VARCHAR(15) NOT NULL,
    record_task_type VARCHAR(10) 
);

-- 4. Payment Table linked to Patient
CREATE TABLE payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_name VARCHAR(50) NOT NULL,
    phone_no VARCHAR(15) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    patient_serial INT, 
    FOREIGN KEY (patient_serial) REFERENCES patients(patient_serial)
);



INSERT INTO users (username, full_name, nid, email, address, password, phone_no, role) 
VALUES 
('admin_user', 'System Administrator', '1234567890', 'admin@trimatric.com', 'Dhaka, Bangladesh', 'admin123', '01711223344', 'Admin'),
('mod_user', 'Inventory Manager', '1990123456789', 'mod@trimatric.com', 'Chittagong, Bangladesh', 'mod456', '01811223344', 'Moderator'),
('staff_user', 'Front Desk Employee', '19851234567890123', 'staff@trimatric.com', 'Sylhet, Bangladesh', 'staff789', '01911223344', 'Staff');



INSERT INTO inventory (product_name, purchase_date, quantity, category, expire_date, status) 
VALUES 
('Paracetamol 500mg', '2025-10-01', 500, 'Tablet', '2027-10-01', 'Valid'),
('Amoxicillin Syrup', '2025-11-15', 50, 'Liquid', '2026-05-20', 'Valid'),
('Surgical Masks (Box)', '2026-01-10', 100, 'Equipment', '2029-01-01', 'Valid'),
('Vitamin C Chewable', '2024-05-01', 200, 'Supplement', '2025-12-30', 'Expired'),
('Digital Thermometer', '2026-01-05', 15, 'Devices', '2030-01-01', 'Valid');


INSERT INTO patients (patient_name, phone_no, record_task_type) 
VALUES 
('Rahim Uddin', '01700112233', 'Checkup'),
('Karim Ahmed', '01800112233', 'Emergency'),
('Nusrat Jahan', '01900112233', 'Surgery'),
('Abul Kashem', '01500112233', 'Follow-up'),
('Fatima Begum', '01300112233', 'Vaccine');

INSERT INTO payments (patient_name, phone_no, amount, patient_serial) 
VALUES 
('Rahim Uddin', '01700112233', 500.00, 1),
('Karim Ahmed', '01800112233', 2500.00, 2),
('Nusrat Jahan', '01900112233', 15000.00, 3),
('Abul Kashem', '01500112233', 800.00, 4),
('Fatima Begum', '01300112233', 300.00, 5);