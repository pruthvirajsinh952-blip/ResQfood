
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Donate Food | ResQfood</title>

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
            <a href="food.php">Rescue Food</a>
            <a href="donate.php" class="active">Donate</a>
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


    <!-- Donate Page -->
    <main class="donate-page">

        <div class="donate-heading">

            <span class="page-label">MAKE AN IMPACT</span>

            <h1>
                Give Food a
                <em>Second Chance.</em>
            </h1>

            <p>
                Have extra food? List it on ResQfood and help connect
                perfectly good food with people who need it.
            </p>

        </div>


        <!-- Donation Form -->
        <div class="donate-container">

            <form id="donateForm" method="POST" action="">

                <!-- Food Information -->
                <div class="form-section">

                    <div class="form-section-title">
                        <span>01</span>

                        <div>
                            <h2>Food Information</h2>
                            <p>Tell us about the food you want to donate.</p>
                        </div>
                    </div>


                    <div class="form-grid">

                        <div class="form-group">

                            <label for="foodName">
                                Food Name
                            </label>

                            <input
                                type="text"
                                id="foodName"
                                name="foodName"
                                placeholder="e.g. Vegetable Biryani"
                                required>

                        </div>


                        <div class="form-group">

                            <label for="category">
                                Food Category
                            </label>

                            <select id="category" name="category" required>

                                <option value="">
                                    Select category
                                </option>

                                <option value="meals">
                                    Meals
                                </option>

                                <option value="bakery">
                                    Bakery
                                </option>

                                <option value="fruits">
                                    Fruits & Vegetables
                                </option>

                            </select>

                        </div>


                        <div class="form-group">

                            <label for="quantity">
                                Quantity
                            </label>

                            <input
                                type="number"
                                id="quantity"
                                name="quantity"
                                placeholder="e.g. 25"
                                min="1"
                                required>

                        </div>


                        <div class="form-group">

                            <label for="unit">
                                Quantity Unit
                            </label>

                            <select id="unit" name="unit" required>

                                <option value="">
                                    Select unit
                                </option>

                                <option value="meals">
                                    Meals
                                </option>

                                <option value="items">
                                    Items
                                </option>

                                <option value="kg">
                                    Kilograms
                                </option>

                            </select>

                        </div>

                    </div>


                    <div class="form-group full-width">

                        <label for="description">
                            Food Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="Describe the food, ingredients, packaging, etc."
                            required></textarea>

                    </div>

                </div>


                <!-- Pickup Information -->
                <div class="form-section">

                    <div class="form-section-title">

                        <span>02</span>

                        <div>
                            <h2>Pickup Information</h2>
                            <p>Help rescuers know where and when to collect it.</p>
                        </div>

                    </div>


                    <div class="form-grid">

                        <div class="form-group">

                            <label for="location">
                                Pickup Location
                            </label>

                            <input
                                type="text"
                                id="location"
                                name="location"
                                placeholder="e.g. Satellite, Ahmedabad"
                                required>

                        </div>


                        <div class="form-group">

                            <label for="pickupTime">
                                Pickup Before
                            </label>

                            <input
                                type="time"
                                id="pickupTime"
                                name="pickupTime"
                                required>

                        </div>

                    </div>

                </div>


                <!-- Donor Information -->
                <div class="form-section">

                    <div class="form-section-title">

                        <span>03</span>

                        <div>
                            <h2>Donor Information</h2>
                            <p>Tell rescuers who they will collect the food from.</p>
                        </div>

                    </div>


                    <div class="form-grid">

                        <div class="form-group">

                            <label for="donorName">
                                Donor / Organization Name
                            </label>

                            <input
                                type="text"
                                id="donorName"
                                name="donorName"
                                placeholder="e.g. Green Leaf Restaurant"
                                required>

                        </div>


                        <div class="form-group">

                            <label for="phone">
                                Contact Number
                            </label>

                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                placeholder="e.g. 9876543210"
                                pattern="[0-9]{10}"
                                required>

                        </div>

                    </div>

                </div>


                <!-- Submit -->
                <div class="donate-submit">

                    <div>
                        <strong>Ready to rescue some food?</strong>

                        <p>
                            Your donation could help someone today.
                        </p>
                    </div>

                    <button type="submit" class="primary-btn">
                        List Food for Rescue →
                    </button>

                </div>

            </form>

        </div>

    </main>


    <!-- Success Notification -->
    <div id="donateNotification" class="claim-notification">

        <span>✓</span>

        <div>

            <strong>Food Listed Successfully!</strong>

            <p>
                Your donation has been added for rescue.
            </p>

        </div>

        <button onclick="closeDonationNotification()">
            ×
        </button>

    </div>


    <!-- Footer -->
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
<?php
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $foodName = $_POST["foodName"];
    $category = $_POST["category"];
    $quantity = $_POST["quantity"];
    $unit = $_POST["unit"];
    $description = $_POST["description"];
    $location = $_POST["location"];
    $pickupTime = $_POST["pickupTime"];
    $donorName = $_POST["donorName"];
    $phone = $_POST["phone"];

$sql = "INSERT INTO food_donations
        (food_name, category, quantity, unit, description,
         location, pickup_time, donor_name, phone, user_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$userId = (int) $_SESSION["user_id"];

$stmt->bind_param(
    "ssissssssi",
    $foodName,
    $category,
    $quantity,
    $unit,
    $description,
    $location,
    $pickupTime,
    $donorName,
    $phone,
    $userId
);


    if ($stmt->execute()) {
        $message = "success";
    } else {
        $message = "error";
    }

    $stmt->close();
}
?>