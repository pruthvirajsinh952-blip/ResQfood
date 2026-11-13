
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | ResQfood</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="navbar">

    <div class="logo">
        <span>ResQ</span>food
    </div>

    <nav>
        <a href="index.php">Home</a>
        <a href="food.php">Rescue Food</a>
        <a href="donate.php">Donate</a>
        <a href="index.php#how-it-works">How It Works</a>
        <a href="about.php" class="active">About Us</a>
        <a href="contact.php">Contact</a>
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
        <span>ABOUT RESQFOOD</span>

        <h2>
            Turning Surplus Food Into
            <em>Hope and Happiness.</em>
        </h2>

        <p>
            ResQfood is a food rescue platform designed to reduce
            food waste and connect surplus food with people and
            communities who need it.
        </p>
    </div>

    <div class="feature-grid">

        <div class="feature-card">
            <div class="feature-icon">🎯</div>
            <h3>Our Mission</h3>
            <p>
                To reduce food wastage by making surplus food
                available to people who need it.
            </p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🌍</div>
            <h3>Our Vision</h3>
            <p>
                A world where good food is valued and fewer
                meals are wasted.
            </p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🤝</div>
            <h3>Our Approach</h3>
            <p>
                Connecting food donors, volunteers and communities
                through a simple digital platform.
            </p>
        </div>

    </div>


</section>

<!-- Who We Are Section -->
<section class="why-section">

    <div class="section-heading">
        <span>WHO WE ARE</span>

        <h2>
            More Than Food.
            <em>It's About People.</em>
        </h2>

        <p>
            ResQfood provides a digital platform where restaurants,
            food businesses and individuals can share surplus food.
            People and organisations can discover available food
            and claim it before it goes to waste.
        </p>
    </div>

    <div class="feature-grid">

        <div class="feature-card">
            <div class="feature-icon">🍱</div>
            <h3>For Food Donors</h3>
            <p>
                Share surplus food and help make it available
                to people who need it.
            </p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">❤️</div>
            <h3>For Communities</h3>
            <p>
                Discover available food donations and
                connect with food donors.
            </p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🌱</div>
            <h3>For the Environment</h3>
            <p>
                Reduce unnecessary food waste and encourage
                responsible food management.
            </p>
        </div>

    </div>

</section>

<!-- Call To Action -->
<section class="cta-section">

    <h2>
        Be Part of the Change.
        <br>
        <span>Rescue Food With Us.</span>
    </h2>

    <p>Every rescued meal makes a difference.</p>

    <a href="donate.php" class="primary-btn">
        Donate Food →
    </a>
</section>

<footer>
    <div class="footer-logo">
        <span>ResQ</span>food
    </div>

    <p>Rescue food. Reduce waste. Feed communities.</p>

    <p class="copyright">
        © 2026 ResQfood. College Project.
    </p>
</footer>

<script src="js/script.js"></script>

</body>
</html>
