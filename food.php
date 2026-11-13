<?php
session_start();
include "db.php";

$sql = "SELECT * FROM food_donations
        WHERE status = 'available'
        ORDER BY created_at DESC";

$result = $conn->query($sql);

if (!$result) {
    die("Could not load food donations.");
}

$foodCount = $result->num_rows;
$claimStatus = $_GET['claim'] ?? '';

$claimSuccess = ($claimStatus === 'success');

$claimUnavailable = in_array(
    $claimStatus,
    ['unavailable', 'invalid'],
    true
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rescue Food | ResQfood</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Navigation -->
    <header class="navbar">

        <div class="logo">
            <span>ResQ</span>food
        </div>

        <nav>
            <a href="index.php">Home</a>
            <a href="food.php" class="active">Rescue Food</a>
            <a href="donate.php">Donate</a>
            <a href="index.php#how-it-works">How It Works</a>
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


    <!-- Food Page Hero -->
    <section class="food-page">

        <div class="food-page-heading">

            <div>
                <span class="page-label">AVAILABLE NEAR YOU</span>

                <h1>
                    Rescue <em>Good Food.</em>
                </h1>

                <p>
                    Discover surplus food available for pickup and help
                    prevent perfectly good meals from going to waste.
                </p>
            </div>

           <div class="food-count">
    <strong><?php echo $foodCount; ?></strong>
    <span>donations available</span>
</div>

        </div>


        <!-- Search + Filter -->
        <div class="food-tools">

            <div class="search-box">
                🔍
                <input
                    type="text"
                    id="foodSearch"
                    placeholder="Search food or restaurant..."
                    onkeyup="searchFood()"
                >
            </div>

            <select id="foodFilter" onchange="filterFood()">
                <option value="all">All Food</option>
                <option value="meals">Meals</option>
                <option value="bakery">Bakery</option>
                <option value="fruits">Fruits & Vegetables</option>
            </select>

        </div>


        <!-- Food Cards -->
        <div class="food-grid">

            <?php if ($result->num_rows > 0): ?>

                <?php while ($food = $result->fetch_assoc()): ?>

                    <div class="rescue-card"
                         data-category="<?php echo htmlspecialchars($food['category']); ?>">

                        <div class="rescue-image meal-image">
                            <?php
                            $category = strtolower($food['category']);

                            if ($category === 'bakery') {
                                echo '🥐';
                            } elseif ($category === 'fruits') {
                                echo '🍎';
                            } else {
                                echo '🍱';
                            }
                            ?>

                            <span class="fresh-badge">Available</span>
                        </div>

                        <div class="rescue-content">

                            <div class="rescue-top">
                                <span class="food-category">
                                    <?php echo htmlspecialchars(strtoupper($food['category'])); ?>
                                </span>

                                <span class="time-left">
                                    Food Rescue
                                </span>
                            </div>

                            <h2>
                                <?php echo htmlspecialchars($food['food_name']); ?>
                            </h2>

                            <p class="restaurant-name">
                                🏪 <?php echo htmlspecialchars($food['donor_name']); ?>
                            </p>

                            <div class="food-details">
                                <span>
                                    🍽 <?php echo (int)$food['quantity']; ?>
                                    <?php echo htmlspecialchars($food['unit']); ?>
                                </span>

                                <span>
                                    📍 <?php echo htmlspecialchars($food['location']); ?>
                                </span>
                            </div>
<!-- Food Location Map -->
<div class="food-map">

    <iframe
        src="https://www.google.com/maps?q=<?php echo urlencode($food['location']); ?>&output=embed"
        width="100%"
        height="180"
        style="border:0; border-radius:12px;"
        loading="lazy"
        allowfullscreen>
    </iframe>

    <a
        href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($food['location']); ?>"
        target="_blank"
        rel="noopener noreferrer">
        📍 View Full Location on Google Maps
    </a>

</div>
                            <div class="pickup">
                                <small>Pickup before</small>

                                <strong>
                                    <?php echo date('g:i A', strtotime($food['pickup_time'])); ?>
                                </strong>
                            </div>

                            <p>
                                <?php echo htmlspecialchars($food['description']); ?>
                            </p>

                            <form action="claim.php" method="POST">
    <input
        type="hidden"
        name="food_id"
        value="<?php echo (int)$food['id']; ?>">

    <button type="submit" class="claim-btn">
        Claim Food →
    </button>
</form>
                        </div>
                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="empty-food-message">
                    <h2>No food available right now 🍃</h2>
                    <p>Check back soon or help your community by donating food.</p>
                    <a href="donate.php" class="primary-btn">Donate Food →</a>
                </div>

            <?php endif; ?>

        </div>

            

        </div>

    </section>


  
    <!-- Claim Notification -->
    <div
        id="claimNotification"
        class="claim-notification <?php echo ($claimSuccess || $claimUnavailable) ? 'show' : ''; ?>">

        <span>
            <?php echo $claimSuccess ? '✓' : '⚠'; ?>
        </span>

        <div>
            <strong>
                <?php
                echo $claimSuccess
                    ? 'Food Claimed Successfully!'
                    : 'Food Not Available';
                ?>
            </strong>

            <p id="notificationText">
                <?php
                echo $claimSuccess
                    ? 'Your food has been reserved successfully. Please arrange pickup.'
                    : 'This donation may already have been claimed. Please choose another listing.';
                ?>
            </p>
        </div>

        <button
            type="button"
            onclick="closeNotification()"
            aria-label="Close notification">
            ×
        </button>

    </div>


    <footer>

        <div class="footer-logo">
            <span>ResQ</span>food
        </div>

        <p>
            Rescue food. Reduce waste. Feed communities.
        </p>

        <p class="copyright">
            © 2026 ResQfood. College Project.
        </p>

    </footer>


    <script src="js/script.js"></script>

</body>
</html>