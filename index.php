<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trimatric Medi-Stock Manager | Home</title>
    <link rel="stylesheet" href="view/design/indexDesign.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <div class="nav-container">
            <a href="index.php" style="text-decoration: none;">
                <div class="logo">TRIMATRIC <span>MEDI-STOCK</span></div>
            </a>

            <nav>
                <a href="index.php">Home</a>
                <a href="#doctors">Our Doctors</a>
                <a href="#medical-tests">Tests & Pricing</a>
                <a href="#contact">Contact</a>
                <a href="view/loginPage.php" class="login-btn-header">Login</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-overlay">
            <h1>Advanced Healthcare <br>Stock Management</h1>
            <p>Providing precision, reliability, and care through technology in Bangladesh.</p>
            <div class="hero-btns">
                <a href="#contact" class="cta-primary">Book Serial</a>
                <a href="#medical-tests" class="cta-secondary">View Prices</a>
            </div>
        </div>
    </section>

    <main class="container">
        <section id="doctors" class="section">
            <h2 class="section-title">Meet Our Specialists</h2>
            <div class="doctor-grid">
                <div class="doc-card">
                    <div class="doc-avatar">👨‍⚕️</div>
                    <h3>Dr. Ariful Islam</h3>
                    <p class="specialty">Senior Cardiologist</p>
                    <p class="doc-desc">🕒 Mon - Wed (10am - 4pm) <br> Fee: ৳ 1,000</p>
                </div>
                <div class="doc-card">
                    <div class="doc-avatar">👩‍⚕️</div>
                    <h3>Dr. Nusrat Jahan</h3>
                    <p class="specialty">Consultant Neurologist</p>
                    <p class="doc-desc">🕒 Sat - Thu (5pm - 9pm) <br> Fee: ৳ 1,200</p>
                </div>
                <div class="doc-card">
                    <div class="doc-avatar">👨‍⚕️</div>
                    <h3>Dr. Raihan Kabir</h3>
                    <p class="specialty">Orthopedic Surgeon</p>
                    <p class="doc-desc">🕒 Friday (9am - 1pm) <br> Fee: ৳ 800</p>
                </div>
            </div>
        </section>

        <section id="medical-tests" class="section">
            <h2 class="section-title">Medical Test Prices</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Test Name</th>
                            <th>Category</th>
                            <th>Price (BDT)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Digital X-Ray</td>
                            <td>Imaging</td>
                            <td>৳ 800</td>
                            <td class="status-available">Available</td>
                        </tr>
                        <tr>
                            <td>ECG (12-Lead)</td>
                            <td>Cardiac</td>
                            <td>৳ 500</td>
                            <td class="status-available">Available</td>
                        </tr>
                        <tr>
                            <td>MRI (Brain)</td>
                            <td>Advanced Imaging</td>
                            <td>৳ 8,500</td>
                            <td class="status-booking">Pre-book</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="contact" class="section contact-section">
            <div class="contact-main-card">
                <h2 class="section-title">Get In Touch</h2>

                <!-- Policy Banner -->
                <div class="serial-policy-banner">
                    <span class="policy-icon">⚠️</span>
                    <p><strong>Appointment Policy:</strong> We follow a strict <b>"First Call, First Serial"</b> system. Please call during office hours.</p>
                </div>

                <!-- Cards Grid -->
                <div class="contact-box-grid">

                    <!-- Phone Card -->
                    <div class="info-card">
                        <div class="card-icon">📞</div>
                        <h3>Phone</h3>
                        <div class="card-content">
                            <p>+880 1700-000000</p>
                            <p>+880 2-9876543</p>
                        </div>
                        <span class="card-tag">Official Line</span>
                    </div>

                    <!-- Time Card -->
                    <div class="info-card">
                        <div class="card-icon">🕒</div>
                        <h3>Calling Time</h3>
                        <div class="card-content">
                            <p>Sat – Thu : 9 AM – 8 PM</p>
                            <p class="emergency">Friday : Emergency Only</p>
                        </div>
                        <span class="card-tag">Availability</span>
                    </div>

                    <!-- Location Card -->
                    <div class="info-card">
                        <div class="card-icon">📍</div>
                        <h3>Location</h3>
                        <div class="card-content">
                            <p>House 12, Road 5</p>
                            <p>Dhanmondi, Dhaka</p>
                        </div>
                        <span class="card-tag">Visit Us</span>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer>
        <p>&copy; 2026 Trimatric Medi-Stock Manager | Serving Healthcare in Dhaka</p>
    </footer>

</body>

</html>