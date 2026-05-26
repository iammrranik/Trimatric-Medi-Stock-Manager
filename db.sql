-- =============================================
-- 1. DATABASE SETUP
-- =============================================
DROP DATABASE IF EXISTS trimatric_medi_manager;
CREATE DATABASE trimatric_medi_manager;
USE trimatric_medi_manager;

-- =============================================
-- 2. TABLE CREATION
-- =============================================

CREATE TABLE inventory (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(50) NOT NULL,
    purchase_date DATE NOT NULL,
    quantity INT DEFAULT 0,
    category VARCHAR(50),
    expire_date DATE NOT NULL,
    status VARCHAR(20)
);

CREATE TABLE patients (
    patient_serial INT PRIMARY KEY AUTO_INCREMENT,
    patient_name VARCHAR(50) NOT NULL,
    phone_no VARCHAR(15) NOT NULL,
    record_task_type VARCHAR(10)
);

CREATE TABLE payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_name VARCHAR(50) NOT NULL,
    phone_no VARCHAR(15) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    patient_serial INT,
    FOREIGN KEY (patient_serial) REFERENCES patients(patient_serial)
);

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

-- =============================================
-- 3. DATA POPULATION
-- =============================================

INSERT INTO inventory (product_name, purchase_date, quantity, category, expire_date, status) VALUES
('Paracetamol 500mg', '2025-10-01', 500, 'Tablet', '2027-10-01', 'Valid'),
('Amoxicillin Syrup', '2025-11-15', 50, 'Liquid', '2026-05-20', 'Valid'),
('Surgical Masks (Box)', '2026-01-10', 100, 'Equipment', '2029-01-01', 'Valid'),
('Vitamin C Chewable', '2024-05-01', 200, 'Supplement', '2025-12-30', 'Expired'),
('Digital Thermometer', '2026-01-05', 15, 'Devices', '2030-01-01', 'Valid'),
('Omeprazole 20mg', '2025-01-10', 300, 'Capsule', '2026-12-30', 'Valid'),
('Azithromycin 500', '2025-02-15', 150, 'Tablet', '2027-01-01', 'Valid'),
('Normal Saline', '2025-03-20', 40, 'Liquid', '2026-03-20', 'Valid'),
('Napa Extend', '2025-05-05', 1000, 'Tablet', '2028-05-05', 'Valid'),
('Hand Gloves (Box)', '2026-01-01', 200, 'Equipment', '2030-01-01', 'Valid'),
('Ciprofloxacin', '2024-01-01', 50, 'Tablet', '2025-01-01', 'Expired'),
('Insulin Glargine', '2025-12-01', 30, 'Injection', '2026-12-01', 'Valid'),
('Metformin 850mg', '2025-06-10', 400, 'Tablet', '2027-06-10', 'Valid'),
('Hydrocortisone', '2025-08-15', 25, 'Cream', '2026-08-15', 'Valid'),
('Antiseptic Wipes', '2025-09-01', 500, 'Equipment', '2028-09-01', 'Valid'),
('Atorvastatin 10mg', '2025-02-28', 200, 'Tablet', '2027-02-28', 'Valid'),
('Salbutamol Inhaler', '2025-11-20', 60, 'Devices', '2026-11-20', 'Valid'),
('Oral Rehydration Salt', '2026-01-05', 1000, 'Supplement', '2028-01-05', 'Valid'),
('Amlodipine 5mg', '2025-04-12', 350, 'Tablet', '2027-04-12', 'Valid'),
('Cetirizine Syrup', '2025-03-15', 80, 'Liquid', '2026-09-15', 'Valid'),
('Surgical Spirit', '2025-07-20', 100, 'Liquid', '2027-07-20', 'Valid'),
('Bandage Roll', '2026-01-15', 300, 'Equipment', '2031-01-15', 'Valid'),
('Gauze Pads', '2026-01-15', 500, 'Equipment', '2031-01-15', 'Valid'),
('Disposable Syringe', '2026-02-01', 1000, 'Equipment', '2030-02-01', 'Valid'),
('Adhesive Plaster', '2025-10-10', 50, 'Equipment', '2028-10-10', 'Valid'),
('Vitamin D3', '2024-06-01', 100, 'Supplement', '2025-11-01', 'Expired'),
('Calcium + D', '2025-05-15', 250, 'Tablet', '2027-05-15', 'Valid'),
('Diclofenac Gel', '2025-08-01', 120, 'Cream', '2027-08-01', 'Valid'),
('Eyewash Solution', '2025-09-15', 40, 'Liquid', '2026-09-15', 'Valid'),
('Nebulizer Machine', '2026-01-10', 5, 'Devices', '2035-01-10', 'Valid'),
('Glucometer Strips', '2026-01-20', 50, 'Devices', '2028-01-20', 'Valid'),
('Losartan 50mg', '2025-03-01', 300, 'Tablet', '2027-03-01', 'Valid'),
('Clopidogrel', '2025-04-20', 180, 'Tablet', '2027-04-20', 'Valid'),
('Pantoprazole', '2025-06-01', 600, 'Tablet', '2028-06-01', 'Valid'),
('Esomeprazole 40mg', '2025-05-15', 400, 'Capsule', '2027-05-15', 'Valid'),
('Folic Acid', '2025-02-10', 500, 'Tablet', '2027-02-10', 'Valid'),
('Iron Supplement', '2025-01-15', 400, 'Capsule', '2027-01-15', 'Valid'),
('Multivitamin Syrup', '2025-11-01', 150, 'Liquid', '2026-11-01', 'Valid'),
('Hand Soap 5L', '2025-12-01', 20, 'Liquid', '2027-12-01', 'Valid'),
('Povidone Iodine', '2025-08-20', 60, 'Liquid', '2027-08-20', 'Valid'),
('Face Shields', '2025-01-05', 50, 'Equipment', '2029-01-05', 'Valid'),
('Thermometer Probe Covers', '2025-10-01', 1000, 'Equipment', '2030-10-01', 'Valid'),
('Zinc Sulfate', '2025-07-01', 300, 'Tablet', '2027-07-01', 'Valid'),
('Albendazole', '2025-09-01', 200, 'Tablet', '2027-09-01', 'Valid'),
('Loperamide', '2025-08-05', 150, 'Capsule', '2027-08-05', 'Valid'),
('Bisoprolol 5mg', '2025-04-10', 100, 'Tablet', '2027-04-10', 'Valid'),
('Spironolactone', '2025-02-20', 120, 'Tablet', '2027-02-20', 'Valid'),
('Dexamethasone', '2025-11-15', 80, 'Injection', '2026-11-15', 'Valid'),
('Glycerin Suppository', '2025-06-25', 50, 'Suppository', '2027-06-25', 'Valid'),
('Hydrogen Peroxide', '2025-03-10', 45, 'Liquid', '2027-03-10', 'Valid'),
('Cotton Wool (Roll)', '2026-01-10', 100, 'Equipment', '2031-01-10', 'Valid'),
('Stethoscope', '2026-01-05', 10, 'Devices', '2036-01-05', 'Valid'),
('BP Cuff Spare', '2025-12-10', 15, 'Devices', '2030-12-10', 'Valid'),
('Alcohol Swabs', '2026-01-15', 2000, 'Equipment', '2029-01-15', 'Valid'),
('Napa 500mg', '2025-01-01', 5000, 'Tablet', '2028-01-01', 'Valid');

INSERT INTO patients (patient_name, phone_no, record_task_type) VALUES
('Rahim Uddin', '01700112233', 'Eye Check'), ('Karim Ahmed', '01800112233', 'Emergency'), ('Nusrat Jahan', '01900112233', 'Surgery'),
('Abul Kashem', '01500112233', 'Follow-up'), ('Fatima Begum', '01300112233', 'Vaccine'), ('Arif Hossain', '01600112201', 'Checkup'),
('Momena Begum', '01600112202', 'Surgery'), ('Tanvir Ahmed', '01600112203', 'Emergency'), ('Sonia Akter', '01600112204', 'Follow-up'),
('Rakib Khan', '01600112205', 'Vaccine'), ('Jashim Uddin', '01600112206', 'Consult'), ('Laila Hasan', '01600112207', 'Checkup'),
('Kamrul Islam', '01600112208', 'Surgery'), ('Shirin Akter', '01600112209', 'Emergency'), ('Zahid Hasan', '01600112210', 'Follow-up'),
('Rina Begum', '01600112211', 'Vaccine'), ('Anwar Hossain', '01600112212', 'Checkup'), ('Sabina Yasmin', '01600112213', 'Consult'),
('Faruk Ahmed', '01600112214', 'Surgery'), ('Taslima Nasrin', '01600112215', 'Emergency'), ('Rafiqul Islam', '01600112216', 'Follow-up'),
('Hamida Khatun', '01600112217', 'Vaccine'), ('Nurul Haque', '01600112218', 'Checkup'), ('Saleha Begum', '01600112219', 'Consult'),
('Azizul Islam', '01600112220', 'Surgery'), ('Bilkis Akter', '01600112221', 'Emergency'), ('Mizanur Rahman', '01600112222', 'Follow-up'),
('Rokeya Begum', '01600112223', 'Vaccine'), ('Shafiqul Islam', '01600112224', 'Checkup'), ('Jahanara Alam', '01600112225', 'Consult'),
('Habibur Rahman', '01600112226', 'Surgery'), ('Parvin Akter', '01600112227', 'Emergency'), ('Mustafa Kamal', '01600112228', 'Follow-up'),
('Salma Khatun', '01600112229', 'Vaccine'), ('Ibrahim Khalil', '01600112230', 'Checkup'), ('Kulsum Begum', '01600112231', 'Consult'),
('Yunus Ali', '01600112232', 'Surgery'), ('Asma Ul Husna', '01600112233', 'Emergency'), ('Mahbubur Rahman', '01600112234', 'Follow-up'),
('Khurshida Begum', '01600112235', 'Vaccine'), ('Rezaul Karim', '01600112236', 'Checkup'), ('Nazma Akter', '01600112237', 'Consult'),
('Shahidul Islam', '01600112238', 'Surgery'), ('Amena Khatun', '01600112239', 'Emergency'), ('Ashraful Islam', '01600112240', 'Follow-up'),
('Firoza Begum', '01600112241', 'Vaccine'), ('Monir Hossain', '01600112242', 'Checkup'), ('Razia Sultana', '01600112243', 'Consult'),
('Mainul Islam', '01600112244', 'Surgery'), ('Hasina Akter', '01600112245', 'Emergency'), ('Golam Sarwar', '01600112246', 'Follow-up'),
('Sultana Razia', '01600112247', 'Vaccine'), ('Kabir Ahmed', '01600112248', 'Checkup'), ('Maksuda Begum', '01600112249', 'Consult'),
('Samiul Haque', '01600112250', 'Surgery');

INSERT INTO payments (patient_name, phone_no, amount, patient_serial) VALUES
('Rahim Uddin', '01700112233', 500.00, 1), ('Karim Ahmed', '01800112233', 2500.00, 2), ('Nusrat Jahan', '01900112233', 15000.00, 3),
('Abul Kashem', '01500112233', 800.00, 4), ('Fatima Begum', '01300112233', 300.00, 5), ('Arif Hossain', '01600112201', 500.00, 6),
('Momena Begum', '01600112202', 45000.00, 7), ('Tanvir Ahmed', '01600112203', 2500.00, 8), ('Sonia Akter', '01600112204', 800.00, 9),
('Rakib Khan', '01600112205', 1200.00, 10), ('Jashim Uddin', '01600112206', 1500.00, 11), ('Laila Hasan', '01600112207', 500.00, 12),
('Kamrul Islam', '01600112208', 35000.00, 13), ('Shirin Akter', '01600112209', 4500.00, 14), ('Zahid Hasan', '01600112210', 1000.00, 15),
('Rina Begum', '01600112211', 1200.00, 16), ('Anwar Hossain', '01600112212', 500.00, 17), ('Sabina Yasmin', '01600112213', 1500.00, 18),
('Faruk Ahmed', '01600112214', 28000.00, 19), ('Taslima Nasrin', '01600112215', 5000.00, 20), ('Rafiqul Islam', '01600112216', 800.00, 21),
('Hamida Khatun', '01600112217', 1200.00, 22), ('Nurul Haque', '01600112218', 500.00, 23), ('Saleha Begum', '01600112219', 1500.00, 24),
('Azizul Islam', '01600112220', 32000.00, 25), ('Bilkis Akter', '01600112221', 6000.00, 26), ('Mizanur Rahman', '01600112222', 800.00, 27),
('Rokeya Begum', '01600112223', 1200.00, 28), ('Shafiqul Islam', '01600112224', 500.00, 29), ('Jahanara Alam', '01600112225', 1500.00, 30),
('Habibur Rahman', '01600112226', 40000.00, 31), ('Parvin Akter', '01600112227', 3500.00, 32), ('Mustafa Kamal', '01600112228', 1000.00, 33),
('Salma Khatun', '01600112229', 1200.00, 34), ('Ibrahim Khalil', '01600112230', 500.00, 35), ('Kulsum Begum', '01600112231', 1500.00, 36),
('Yunus Ali', '01600112232', 22000.00, 37), ('Asma Ul Husna', '01600112233', 7500.00, 38), ('Mahbubur Rahman', '01600112234', 800.00, 39),
('Khurshida Begum', '01600112235', 1200.00, 40), ('Rezaul Karim', '01600112236', 400.00, 41), ('Nazma Akter', '01600112237', 1500.00, 42),
('Shahidul Islam', '01600112238', 50000.00, 43), ('Amena Khatun', '01600112239', 4200.00, 44), ('Ashraful Islam', '01600112240', 1000.00, 45),
('Firoza Begum', '01600112241', 1200.00, 46), ('Monir Hossain', '01600112242', 500.00, 47), ('Razia Sultana', '01600112243', 1500.00, 48),
('Mainul Islam', '01600112244', 38000.00, 49), ('Hasina Akter', '01600112245', 5500.00, 50), ('Golam Sarwar', '01600112246', 800.00, 51),
('Sultana Razia', '01600112247', 1200.00, 52), ('Kabir Ahmed', '01600112248', 500.00, 53), ('Maksuda Begum', '01600112249', 1500.00, 54),
('Samiul Haque', '01600112250', 25000.00, 55);

INSERT INTO users (username, full_name, nid, email, address, password, phone_no, role) VALUES
('admin_user', 'System Administrator', '1234567890', 'admin@trimatric.com', 'Dhaka, Bangladesh', 'admin@123', '01711223344', 'Admin'),
('adm_haque', 'Inamul Haque', '3322110099', 'inamul@trimatric.com', 'Satkhira Town, Satkhira', 'haque_adm', '01711000129', 'Admin'),
('adm_hossain', 'Zakir Hossain', '1988123456789', 'zakir@trimatric.com', 'Sector 4, Uttara, Dhaka', 'admin!@#', '01711000101', 'Admin'),
('adm_joy', 'Joynal Abedin', '9900112233', 'joy@trimatric.com', 'Dinajpur Town, Dinajpur', 'joy_adm', '01611000121', 'Admin'),
('adm_khan', 'Salman Khan', '1975445566778', 'salman@trimatric.com', 'Boyra, Khulna', 'secureAdmin', '01511000105', 'Admin'),
('adm_munna', 'Munna Sheikh', '3344551122', 'munna@trimatric.com', 'Jhenaidah Sadar', 'munna_adm', '01911000145', 'Admin'),
('adm_reza', 'Selim Reza', '5544332211', 'selim@trimatric.com', 'Kushtia Town, Kushtia', 'selim_adm', '01811000115', 'Admin'),
('adm_sohel', 'Sohel Rana', '7766554433', 'sohel@trimatric.com', 'Thakurgaon Sadar', 'sohel_adm', '01811000137', 'Admin'),
('Isa', 'Moammad Isa', '1234567812', 'isa@gmail.com', 'mirpur', 'Isa@1234', '01652435433', 'Staff'),
('mod_ahmed', 'Imtiaz Ahmed', '1990556677889', 'imtiaz@trimatric.com', 'Maijdee, Noakhali', 'imtiaz99', '01911000109', 'Moderator'),
('mod_bashar', 'Abul Bashar', '1980554433221', 'bashar@trimatric.com', 'Patuakhali Sadar', 'bashar_mod', '01811000130', 'Moderator'),
('mod_chowdhury', 'Tanvir Chowdhury', '9988776655', 'tanvir@trimatric.com', 'Chasara, Narayanganj', 'tanvir_mod', '01611000106', 'Moderator'),
('mod_hassan', 'Mehedi Hassan', '1982112233445', 'mehedi@trimatric.com', 'Jessore Sadar, Jessore', 'mehedi_mod', '01611000113', 'Moderator'),
('mod_jahan', 'Nusrat Jahan', '5566778899', 'nusrat@trimatric.com', 'Agrabad, Chittagong', 'modPass99', '01811000102', 'Moderator'),
('mod_kabir', 'Humayun Kabir', '1989443322115', 'humayun@trimatric.com', 'Feni Sadar, Feni', 'kabir_mod', '01811000118', 'Moderator'),
('mod_laboni', 'Laboni Akter', '1988556677889', 'laboni@trimatric.com', 'Magura Sadar, Magura', 'laboni_mod', '01711000146', 'Moderator'),
('mod_muna', 'Munira Islam', '1991554433221', 'muna@trimatric.com', 'Coxs Bazar Sadar', 'muna_mod', '01711000122', 'Moderator'),
('mod_nadim', 'Nadim Mahmud', '1981667788990', 'nadim@trimatric.com', 'Bagerhat Sadar, Bagerhat', 'nadim_mod', '01711000150', 'Moderator'),
('mod_sajid', 'Sajid Khan', '1983998877665', 'sajid@trimatric.com', 'Joypurhat Sadar', 'sajid_mod', '01611000142', 'Moderator'),
('mod_salma', 'Salma Begum', '1984667788990', 'salma@trimatric.com', 'Sirajganj Sadar', 'salma_mod', '01511000134', 'Moderator'),
('mod_tania', 'Tania Sultana', '1986554433221', 'tania@trimatric.com', 'Nilphamari Sadar', 'tania_mod', '01911000138', 'Moderator'),
('mod_user', 'Inventory Manager', '1990123456789', 'mod@trimatric.com', 'Chittagong, Bangladesh', 'mod456', '01811223344', 'Moderator'),
('mod_yasmin', 'Farhana Yasmin', '1993223344556', 'farhana@trimatric.com', 'Laxmipur Sadar', 'farhana_mod', '01811000126', 'Moderator'),
('staff_ali', 'Mohammad Ali', '3344556677', 'ali@trimatric.com', 'Pabna Town, Pabna', 'ali_pass', '01511000112', 'Staff'),
('staff_asifa', 'Asifa Khatun', '1991443322115', 'asifa@trimatric.com', 'Gaibandha Sadar', 'asifa_pass', '01811000140', 'Staff'),
('staff_babu', 'Babu Miah', '8899001122', 'babu@trimatric.com', 'Sunamganj Sadar', 'babu_pass', '01811000133', 'Staff'),
('staff_beauty', 'Beauty Akter', '19974433221155667', 'beauty@trimatric.com', 'Moulvibazar Sadar', 'beauty_pass', '01711000132', 'Staff'),
('staff_begum', 'Rokeya Begum', '1122334455', 'rokeya@trimatric.com', 'Rangpur City, Rangpur', 'rokeya#2026', '01811000108', 'Staff'),
('staff_das', 'Pritom Das', '8877665544', 'pritom@trimatric.com', 'Behelbari, Mymensingh', 'pritom!@#', '01711000110', 'Staff'),
('staff_islam', 'Saiful Islam', '19853344556677889', 'saiful@trimatric.com', 'Barisal Sadar, Barisal', 'pass_saiful', '01711000107', 'Staff'),
('staff_jalil', 'Abdul Jalil', '2211009988', 'jalil@trimatric.com', 'Natore Sadar, Natore', 'jalil_staff', '01611000135', 'Staff'),
('staff_kamal', 'Kamal Uddin', '4455667788', 'kamal@trimatric.com', 'Jamalpur Sadar, Jamalpur', 'kamal_staff', '01811000123', 'Staff'),
('staff_khatun', 'Fatema Khatun', '19987766554433221', 'fatema@trimatric.com', 'Comilla Cantt, Comilla', 'fatema786', '01711000114', 'Staff'),
('staff_lily', 'Lily Akter', '19991122334455667', 'lily@trimatric.com', 'Panchagarh Sadar', 'lily_pass', '01711000136', 'Staff'),
('staff_luna', 'Luna Akter', '19941122334455667', 'luna@trimatric.com', 'Tangail Sadar, Tangail', 'luna_2026', '01511000120', 'Staff'),
('staff_manir', 'Manir Hossain', '4433221100', 'manir@trimatric.com', 'Kurigram Sadar, Kurigram', 'manir_staff', '01711000139', 'Staff'),
('staff_miah', 'Abul Miah', '1970667788990', 'abul@trimatric.com', 'Tongi, Gazipur', 'abul_staff', '01911000116', 'Staff'),
('staff_mim', 'Sumaiya Akter Mim', '1234509876', 'mim@trimatric.com', 'Rajshahi Town, Rajshahi', 'mim7890', '01311000104', 'Staff'),
('staff_moni', 'Moni Begum', '19967788990011223', 'moni@trimatric.com', 'Chandpur Sadar, Chandpur', 'moni_pass', '01611000128', 'Staff'),
('staff_mousumi', 'Mousumi Akter', '9988112233', 'mousumi@trimatric.com', 'Naogaon Sadar, Naogaon', 'mousumi_pass', '01711000143', 'Staff'),
('staff_nasir', 'Nasir Uddin', '5566443322', 'nasir@trimatric.com', 'Habiganj Sadar, Habiganj', 'nasir_staff', '01911000131', 'Staff'),
('staff_parvin', 'Shahana Parvin', '1995998877665', 'shahana@trimatric.com', 'Bogura Sadar, Bogura', 'shahana123', '01811000111', 'Staff'),
('staff_pavel', 'Pavel Islam', '19904455667788991', 'pavel@trimatric.com', 'Chapainawabganj Sadar', 'pavel_staff', '01811000144', 'Staff'),
('staff_rahman', 'Arifur Rahman', '19922233344455566', 'arif@trimatric.com', 'Zindabazar, Sylhet', 'staff123', '01911000103', 'Staff'),
('staff_rony', 'Rashed Rony', '7788990011', 'rony@trimatric.com', 'Sherpur Town, Sherpur', 'rony_rony', '01711000125', 'Staff'),
('staff_rony_2', 'Rony Hossain', '1122445566', 'rony2@trimatric.com', 'Narail Sadar, Narail', 'rony2_pass', '01811000147', 'Staff'),
('staff_rubel', 'Rubel Ahmed', '1122334499', 'rubel@trimatric.com', 'Lalmonirhat Sadar', 'rubel_staff', '01511000141', 'Staff'),
('staff_shila', 'Shila Akter', '19943344556677889', 'shila@trimatric.com', 'Meherpur Sadar, Meherpur', 'shila_pass', '01511000148', 'Staff'),
('staff_shumi', 'Shumi Akter', '19876655443322110', 'shumi@trimatric.com', 'Brahmanbaria Sadar', 'shumi_pass', '01911000124', 'Staff'),
('staff_shuvo', 'Abrar Shuvo', '2233445566', 'abrar@trimatric.com', 'Narsingdi Sadar, Narsingdi', 'shuvo_pass', '01311000119', 'Staff'),
('staff_siddique', 'Abu Siddique', '1100110011', 'siddique@trimatric.com', 'Bhola Sadar, Bhola', 'siddique123', '01511000127', 'Staff'),
('staff_tara', 'Tara Banu', '6677889900', 'tara@trimatric.com', 'Savar, Dhaka', 'tara1234', '01711000117', 'Staff'),
('staff_tushar', 'Tushar Ahmed', '5566112233', 'tushar@trimatric.com', 'Chuadanga Sadar', 'tushar_staff', '01611000149', 'Staff'),
('staff_user', 'Front Desk Employee', '19851234567890123', 'staff@trimatric.com', 'Sylhet, Bangladesh', 'staff789', '01911223344', 'Staff');

-- =============================================
-- 4. MAINTENANCE COMMANDS
-- =============================================
-- To clear all data:
-- TRUNCATE TABLE inventory;
-- TRUNCATE TABLE patients;
-- TRUNCATE TABLE payments;
-- TRUNCATE TABLE users;

-- To delete a specific table entirely:
-- DROP TABLE IF EXISTS payments;

-- To delete the entire database:
-- DROP DATABASE IF EXISTS trimatric_medi_manager;
