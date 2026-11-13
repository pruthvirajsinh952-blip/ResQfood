
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

include "db.php";

$userId = (int) $_SESSION["user_id"];

$stmt = $conn->prepare(
    "SELECT food_name, category, quantity, unit, location,
            pickup_time, status, created_at
     FROM food_donations
     WHERE user_id = ?
     ORDER BY created_at DESC"
);

$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$totalDonations = 0;
$availableDonations = 0;
$claimedDonations = 0;

$donations = [];

while ($food = $result->fetch_assoc()) {
    $donations[] = $food;
    $totalDonations++;

    if ($food["status"] === "available") {
        $availableDonations++;
    } elseif ($food["status"] === "claimed") {
        $claimedDonations++;
    }
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard | ResQfood</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        .dashboard-page {
           
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    background: #f7f5ee;
    color: #20352a;
    font-family: "Segoe UI", Arial, sans-serif;
}

.dashboard-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 42px 28px;
}

.dashboard-heading {
    margin-bottom: 28px;
}

.dashboard-heading h1 {
    margin: 0 0 10px;
    color: #173d2b;
    font-size: clamp(30px, 4vw, 42px);
    letter-spacing: -1.2px;
}

.dashboard-heading p {
    color: #728075;
    line-height: 1.7;
}

.dashboard-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 30px;
}

.dashboard-actions a {
    display: inline-block;
    padding: 12px 19px;
    border-radius: 10px;
    background: #1d5738;
    color: white;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.2s, transform 0.2s;
}

.dashboard-actions a:hover {
    background: #12452b;
    transform: translateY(-2px);
}

.dashboard-actions a.secondary {
    background: #fff;
    color: #245338;
    border: 1px solid #e3e8df;
}

.dashboard-actions a.secondary:hover {
    background: #eaf2e8;
}

.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 20px;
    margin-bottom: 42px;
}

.dashboard-stat {
    position: relative;
    overflow: hidden;
    padding: 26px;
    background: #fff;
    border: 1px solid #e9e9df;
    border-radius: 18px;
    box-shadow: 0 6px 24px rgba(31, 56, 38, 0.04);
}

.dashboard-stat::after {
    content: "";
    position: absolute;
    right: -22px;
    top: -22px;
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: #edf5e9;
}

.dashboard-stat span {
    position: relative;
    z-index: 1;
    display: block;
    margin-bottom: 15px;
    color: #748075;
    font-size: 14px;
}

.dashboard-stat strong {
    position: relative;
    z-index: 1;
    color: #1b5735;
    font-size: 38px;
    font-weight: 700;
}

.dashboard-page h2 {
    margin: 0 0 20px;
    color: #203b2b;
    font-size: 24px;
}

.dashboard-table-wrap {
    overflow-x: auto;
    background: #fff;
    border: 1px solid #e8e9e1;
    border-radius: 16px;
    box-shadow: 0 6px 24px rgba(31, 56, 38, 0.04);
}

.dashboard-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
}

.dashboard-table th,
.dashboard-table td {
    padding: 17px 18px;
    border-bottom: 1px solid #edf0e9;
    text-align: left;
    white-space: nowrap;
    font-size: 14px;
}

.dashboard-table th {
    background: #f2f5ec;
    color: #526653;
    font-weight: 600;
}

.dashboard-table tbody tr:hover {
    background: #fafbf7;
}

.dashboard-table tbody tr:last-child td {
    border-bottom: none;
}

.dashboard-status {
    display: inline-block;
    padding: 6px 11px;
    border-radius: 20px;
    background: #e3f4e4;
    color: #24683a;
    font-size: 12px;
    font-weight: 700;
}

.dashboard-empty {
    padding: 38px 22px;
    border: 1px dashed #cbd7c9;
    border-radius: 16px;
    background: #fff;
    text-align: center;
}

.dashboard-empty p {
    color: #748075;
    line-height: 1.6;
}

.dashboard-empty a {
    color: #1d5738;
    font-weight: 700;
    text-decoration: none;
}

@media (max-width: 700px) {
    .dashboard-page {
        padding: 28px 16px;
    }

    .dashboard-stats {
        grid-template-columns: 1fr;
        gap: 14px;
    }

    .dashboard-stat {
        padding: 22px;
    }

    .dashboard-table th,
    .dashboard-table td {
        padding: 13px;
    }
}

        }

        .dashboard-heading {
            margin-bottom: 28px;
        }

        .dashboard-heading h1 {
            margin-bottom: 8px;
            color: #183b2a;
        }

        .dashboard-heading p {
            color: #66736a;
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 35px;
        }

        .dashboard-stat {
            padding: 22px;
            background: #f1f8f2;
            border-radius: 14px;
        }

        .dashboard-stat span {
            display: block;
            color: #53665a;
            margin-bottom: 10px;
        }

        .dashboard-stat strong {
            font-size: 30px;
            color: #218838;
        }

        .dashboard-table-wrap {
            overflow-x: auto;
        }

        .dashboard-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .dashboard-table th,
        .dashboard-table td {
            padding: 14px;
            border-bottom: 1px solid #e5ebe6;
            text-align: left;
        }

        .dashboard-table th {
            background: #f1f8f2;
        }

        .dashboard-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #e4f5e8;
            color: #176b2b;
            font-size: 13px;
        }

        .dashboard-empty {
            padding: 28px;
            border-radius: 14px;
            background: #f6f8f6;
            text-align: center;
        }

        .dashboard-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }

        .dashboard-actions a {
            display: inline-block;
            padding: 11px 16px;
            border-radius: 8px;
            background: #218838;
            color: white;
            text-decoration: none;
        }

        .dashboard-actions a.secondary {
            background: #e8f3ea;
            color: #176b2b;
        }

        @media (max-width: 650px) {
            .dashboard-stats {
                grid-template-columns: 1fr;
            }
        }
        
.dashboard-eyebrow {
    display: inline-block;
    margin-bottom: 16px;
    padding: 8px 12px;
    border: 1px solid #dce9d9;
    border-radius: 30px;
    background: #eaf3e6;
    color: #28613b;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2px;
}

.dashboard-heading h1 {
    max-width: 760px;
    margin: 0 0 14px;
    color: #173d2b;
    font-size: clamp(34px, 5vw, 54px);
    font-weight: 750;
    line-height: 1.12;
    letter-spacing: -2px;
}

.dashboard-heading .heading-dot {
    color: #65a66d;
}

.dashboard-heading p {
    margin-top: 0;
    font-size: 16px;
    line-height: 1.8;
}

.dashboard-heading p strong {
    color: #245638;
}

.stat-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 22px;
}

.stat-icon {
    display: flex !important;
    align-items: center;
    justify-content: center;
    width: 46px;
    height: 46px;
    margin: 0 !important;
    border-radius: 14px;
    background: #edf4e9;
    font-size: 22px !important;
}

.stat-label {
    margin: 0 !important;
    font-size: 10px !important;
    font-weight: 800;
    letter-spacing: 1px;
    text-align: right;
}

.dashboard-stat h3 {
    position: relative;
    z-index: 1;
    margin: 0 0 12px;
    color: #455b4b;
    font-size: 15px;
    font-weight: 600;
}

.dashboard-stat strong {
    display: block;
    margin-bottom: 10px;
    font-size: 44px;
    line-height: 1;
}

.dashboard-stat p {
    position: relative;
    z-index: 1;
    margin: 0;
    color: #7a877b;
    font-size: 13px;
}

.total-stat {
    border-top: 4px solid #315e42;
}

.available-stat {
    border-top: 4px solid #7ba65b;
}

.claimed-stat {
    border-top: 4px solid #d3a15c;
}

.available-stat .stat-icon {
    background: #e8f4df;
}

.claimed-stat .stat-icon {
    background: #fbf0df;
}

@media (max-width: 700px) {
    .stat-top {
        margin-bottom: 16px;
    }

    .dashboard-stat strong {
        font-size: 38px;
    }
}

.dashboard-status {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 12px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

.status-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: currentColor;
}

.status-available {
    background: #e6f5e8;
    color: #23723c;
}

.status-claimed {
    background: #fff0dc;
    color: #98611e;
}

.dashboard-table-wrap {
    border-radius: 16px;
    overflow-x: auto;
    box-shadow: 0 10px 30px rgba(31, 56, 38, 0.06);
}

.dashboard-table th {
    padding-top: 18px;
    padding-bottom: 18px;
    font-size: 11px;
    letter-spacing: 0.8px;
    text-transform: uppercase;
}

.dashboard-table td {
    padding-top: 19px;
    padding-bottom: 19px;
}

.dashboard-table tbody tr {
    transition: background 0.2s;
}

.dashboard-table tbody tr:hover {
    background: #f5f8f0;
}

    </style>
</head>
<body>

    <main class="dashboard-page">
       
<div class="dashboard-heading">
    <span class="dashboard-eyebrow">RESQFOOD • YOUR IMPACT</span>
    <h1>Make a difference, one meal at a time<span class="heading-dot">.</span></h1>
    <p>
        Welcome back,
        <strong><?php echo htmlspecialchars($_SESSION["user_name"]); ?></strong>.
        Here's your food rescue activity at a glance.
    </p>
</div>

        <div class="dashboard-actions">
            <a href="donate.php">+ Donate Food</a>
            <a href="food.php" class="secondary">Browse Food</a>
            <a href="index.php" class="secondary">Home</a>
        </div>

       
<section class="dashboard-stats">

    <div class="dashboard-stat total-stat">
        <div class="stat-top">
            <span class="stat-icon">🍱</span>
            <span class="stat-label">YOUR CONTRIBUTION</span>
        </div>
        <h3>Total Donations</h3>
        <strong><?php echo $totalDonations; ?></strong>
        <p>Food listings you've shared</p>
    </div>

    <div class="dashboard-stat available-stat">
        <div class="stat-top">
            <span class="stat-icon">🌱</span>
            <span class="stat-label">READY TO RESCUE</span>
        </div>
        <h3>Available Food</h3>
        <strong><?php echo $availableDonations; ?></strong>
        <p>Waiting for someone to claim</p>
    </div>

    <div class="dashboard-stat claimed-stat">
        <div class="stat-top">
            <span class="stat-icon">❤️</span>
            <span class="stat-label">IMPACT MADE</span>
        </div>
        <h3>Food Claimed</h3>
        <strong><?php echo $claimedDonations; ?></strong>
        <p>Successfully claimed listings</p>
    </div>

</section>


        <h2>My Donations</h2>

        <?php if (count($donations) > 0): ?>
            <div class="dashboard-table-wrap">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Food</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Location</th>
                            <th>Pickup Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($donations as $food): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($food["food_name"]); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($food["category"]); ?>
                                </td>
                                <td>
                                    <?php echo (int) $food["quantity"]; ?>
                                    <?php echo htmlspecialchars($food["unit"]); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($food["location"]); ?>
                                </td>
                                <td>
                                    <?php echo date("g:i A", strtotime($food["pickup_time"])); ?>
                                </td>
                                <td>
                                   
<span class="dashboard-status status-<?php echo htmlspecialchars(strtolower($food["status"])); ?>">
    <span class="status-dot"></span>
    <?php echo htmlspecialchars(ucfirst($food["status"])); ?>
</span>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="dashboard-empty">
                <h3>No donations yet</h3>
                <p>Your food donations will appear here after you submit them.</p>
                <a href="donate.php">Donate your first meal →</a>
            </div>
        <?php endif; ?>
    </main>

</body>
</html>
