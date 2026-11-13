
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | ResQfood</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="navbar">
    <div class="logo"><span>ResQ</span>food</div>

    <nav>
        <a href="index.php">Home</a>
        <a href="food.php">Rescue Food</a>
        <a href="donate.php">Donate</a>
        <a href="index.php#how-it-works">How It Works</a>
        <a href="about.php">About Us</a>
        <a href="contact.php" class="active">Contact</a>
    </nav>

    <div class="nav-buttons">
        <?php if (isset($_SESSION["user_id"])): ?>
            <span class="login-btn">
                Hi, <?php echo htmlspecialchars($_SESSION["user_name"]); ?>
            </span>
            <a href="dashboard.php" class="login-btn">Dashboard</a>
            <a href="logout.php" class="signup-btn">Logout</a>
        <?php else: ?>
            <a href="login.php" class="login-btn">Login</a>
            <a href="register.php" class="signup-btn">Get Started</a>
        <?php endif; ?>
    </div>
</header>

<section class="why-section">
    <div class="section-heading">
        <span>GET IN TOUCH</span>
        <h2>We'd Love to <em>Hear From You.</em></h2>
        <p>
            Have questions, suggestions or want to help reduce
            food waste? Connect with the ResQfood team.
        </p>
    </div>

    <div class="feature-grid">

        <div class="feature-card">
            <div class="feature-icon">📧</div>
            <h3>Email Us</h3>
            <p>Reach out for questions and support.</p>
            <a href="mailto:resqfood.team@gmail.com">
                resqfood.team@gmail.com
            </a>
        </div>

        <div class="feature-card">
            <div class="feature-icon">📍</div>
            <h3>Our Location</h3>
            <p>Ahmedabad, Gujarat, India.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🤝</div>
            <h3>Work With Us</h3>
            <p>
                Join us in rescuing surplus food and
                supporting local communities.
            </p>
        </div>

    </div>
</section>

<section class="cta-section">
    <h2>Together We Can Make <br><span>A Difference.</span></h2>
    <p>Every effort counts towards reducing food waste.</p>
    <a href="donate.php" class="primary-btn">Start Donating →</a>
</section>

<footer>
    <div class="footer-logo"><span>ResQ</span>food</div>
    <p>Rescue food. Reduce waste. Feed communities.</p>
    <p class="copyright">© 2026 ResQfood. College Project.</p>
</footer>

<script src="js/script.js"></script>
</body>
</html>
