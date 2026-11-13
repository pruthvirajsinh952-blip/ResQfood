
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

include "db.php";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: food.php");
    exit;
}

if (
    !isset($_POST["food_id"]) ||
    filter_var($_POST["food_id"], FILTER_VALIDATE_INT) === false ||
    (int)$_POST["food_id"] < 1
) {
    header("Location: food.php?claim=invalid");
    exit;
}

$foodId = (int)$_POST["food_id"];

$sql = "UPDATE food_donations
        SET status = 'claimed'
        WHERE id = ? AND status = 'available'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $foodId);
$stmt->execute();

if ($stmt->affected_rows === 1) {
    $status = "success";
} else {
    $status = "unavailable";
}

$stmt->close();
$conn->close();

header("Location: food.php?claim=" . $status);
exit;
?>
