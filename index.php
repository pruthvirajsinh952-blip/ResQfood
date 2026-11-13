<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ResQfood | Rescue Food. Reduce Waste.</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Navigation Bar -->
    <header class="navbar">

        <div class="logo">
            <span>ResQ</span>food
        </div>

        
<nav>
    <a href="index.php" class="active">Home</a>
    <a href="food.php">Rescue Food</a>
    <a href="donate.php">Donate</a>
    <a href="#how-it-works">How It Works</a>
    <a href="about.php">About Us</a>
    <a href="contact.php">Contact</a>
</nav>





<div class="nav-buttons">
    <?php if (isset($_SESSION["user_id"])): ?>
        <span class="login-btn">
            Hi, <?php echo htmlspecialchars($_SESSION["user_name"]); ?>
        </span>

        <a href="dashboard.php" class="login-btn">Dashboard</a>
        <a href="logout.php" class="signup-btn">Logout</a>

        <button class="mobile-menu-btn"
                type="button"
                aria-label="Toggle navigation"
                aria-expanded="false"
                onclick="toggleMobileMenu()">
            ☰
        </button>

    <?php else: ?>
        <a href="login.php" class="login-btn">Login</a>

        <button class="mobile-menu-btn"
                type="button"
                aria-label="Toggle navigation"
                aria-expanded="false"
                onclick="toggleMobileMenu()">
            ☰
        </button>

        <a href="register.php" class="signup-btn">Get Started</a>
    <?php endif; ?>
</div>

</header>



    <!-- Hero Section -->
    <section class="hero">

        <div class="hero-content">

            <div class="hero-badge">
                ♻️ Together Against Food Waste
            </div>

            <h1>
                Good Food
                <span>Deserves</span>
                Another Chance.
            </h1>

            <p>
                ResQfood connects surplus food with people and communities
                who need it — reducing food waste, one meal at a time.
            </p>

            <div class="hero-buttons">
                <a href="donate.php" class="primary-btn">
                    🍱 Donate Food
                </a>

                <a href="food.php" class="secondary-btn">
                    Find Food →
                </a>
            </div>

            <div class="hero-stats">

                <div>
                    <strong>1,250+</strong>
                    <small>Meals Rescued</small>
                </div>

                <div>
                    <strong>320+</strong>
                    <small>Donations</small>
                </div>

                <div>
                    <strong>85+</strong>
                    <small>Volunteers</small>
                </div>

            </div>

        </div>


        <!-- Hero Visual -->
        <div class="hero-visual">

            <div class="food-card">

               <div class="food-image">
    <img src="ngo-food-donation.jpg"
     alt="NGO volunteers distributing meals to people">
</div>
                <div class="food-info">

                    <div>
                        <h3>Fresh Meals Available</h3>
                        <p>Ready for rescue</p>
                    </div>

                    <span class="available">
                        ● Available
                    </span>

                </div>

                <div class="food-location">
                    📍 Ahmedabad &nbsp; • &nbsp; 24 meals
                </div>

            </div>

            <div class="floating-card">
                ❤️ <strong>24 Meals</strong> rescued today
            </div>

        </div>

    </section>


    <!-- Why ResQfood -->
    <section class="why-section">

        <div class="section-heading">

            <span>WHY RESQFOOD?</span>

            <h2>
                Small Actions.
                <br>
                <em>Big Impact.</em>
            </h2>

            <p>
                Every meal rescued is a step towards a world where
                good food never goes to waste.
            </p>

        </div>


        <div class="feature-grid">

            <div class="feature-card">
                <div class="feature-icon">♻️</div>

                <h3>Reduce Waste</h3>

                <p>
                    Rescue surplus food before it ends up in
                    landfills.
                </p>
            </div>


            <div class="feature-card">
                <div class="feature-icon">🤝</div>

                <h3>Help Communities</h3>

                <p>
                    Connect extra food with people and organizations
                    who need it.
                </p>
            </div>


            <div class="feature-card">
                <div class="feature-icon">🚚</div>

                <h3>Easy Pickup</h3>

                <p>
                    Make donating and collecting surplus food
                    simple and convenient.
                </p>
            </div>

        </div>

    </section>


    <!-- How It Works -->
    <section class="how-section" id="how-it-works">

        <div class="section-heading">

            <span>HOW IT WORKS</span>

            <h2>
                Rescue Food in
                <em>3 Simple Steps.</em>
            </h2>

        </div>


        <div class="steps">

            <div class="step">
                <div class="step-number">01</div>

                <h3>List Surplus Food</h3>

                <p>
                    Restaurants, events and individuals can
                    list their extra food.
                </p>
            </div>


            <div class="step">
                <div class="step-number">02</div>

                <h3>Someone Claims It</h3>

                <p>
                    Volunteers or organizations discover and
                    claim available food.
                </p>
            </div>


            <div class="step">
                <div class="step-number">03</div>

                <h3>Food Gets Rescued</h3>

                <p>
                    The food is collected and delivered to
                    where it is needed.
                </p>
            </div>

        </div>

    </section>


    <!-- Call To Action -->
    <section class="cta-section">

        <h2>
            Have Extra Food?
            <br>
            <span>Don't Waste It. ResQ It.</span>
        </h2>

        <p>
            Your extra meal could become someone's much-needed meal.
        </p>

        <a href="donate.php" class="primary-btn">
            Start Donating →
        </a>

    </section>


    <!-- Footer -->
    
<footer>

    <div class="footer-logo">
        <span>ResQ</span>food
    </div>

    <p>
        Rescue food. Reduce waste. Feed communities.
    </p>

 
<div class="footer-links">
    <a href="index.php">Home</a>
    <span class="footer-separator">|</span>

    <a href="about.php">About Us</a>
    <span class="footer-separator">|</span>

    <a href="contact.php">Contact Us</a>
    <span class="footer-separator">|</span>

    <a href="food.php">Rescue Food</a>
    <span class="footer-separator">|</span>

    <a href="donate.php">Donate Food</a>
</div>

    <p class="copyright">
        © 2026 ResQfood. College Project.
    </p>

</footer>



    <script src="js/script.js"></script>

<script>
function toggleMobileMenu() {
    const nav = document.querySelector('.navbar nav');
    const button = document.querySelector('.mobile-menu-btn');

    if (!nav || !button) return;

    const isOpen = nav.classList.toggle('mobile-nav-open');
    button.setAttribute('aria-expanded', isOpen);
}

document.addEventListener('DOMContentLoaded', function () {
    const nav = document.querySelector('.navbar nav');
    const button = document.querySelector('.mobile-menu-btn');

    if (!nav || !button) return;

    nav.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            nav.classList.remove('mobile-nav-open');
            button.setAttribute('aria-expanded', 'false');
        });
    });
});
</script>


</body>
</html>