
<?php
session_start();
include "db.php";

$message = "";

if (isset($_GET["registered"]) && $_GET["registered"] === "1") {
    $message = "Account created successfully! You can now log in.";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($email === "" || $password === "") {
        $message = "Please enter your email and password.";
    } else {
        $stmt = $conn->prepare(
            "SELECT id, name, email, password
             FROM users
             WHERE email = ?"
        );

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result(
                $userId,
                $userName,
                $userEmail,
                $passwordHash
            );
            $stmt->fetch();

            if (password_verify($password, $passwordHash)) {
                session_regenerate_id(true);

                $_SESSION["user_id"] = $userId;
                $_SESSION["user_name"] = $userName;
                $_SESSION["user_email"] = $userEmail;

                $stmt->close();
                $conn->close();

                header("Location: index.php");
                exit;
            }
        }

        $message = "Invalid email or password.";
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | ResQfood</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        .auth-page {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 32px 16px;
            background: #f3f8f3;
            font-family: Arial, sans-serif;
        }

        .auth-card {
            width: 100%;
            max-width: 440px;
            padding: 32px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
            box-sizing: border-box;
        }

        .auth-brand {
            color: #218838;
            font-size: 27px;
            font-weight: 800;
            text-decoration: none;
        }

        .auth-card h1 {
            margin: 22px 0 8px;
            color: #183b2a;
            font-size: 28px;
        }

        .auth-subtitle {
            margin-bottom: 24px;
            color: #66736a;
            line-height: 1.5;
        }

        .auth-form label {
            display: block;
            margin: 16px 0 7px;
            color: #26372c;
            font-weight: 600;
        }

        .auth-form input {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #d5dfd7;
            border-radius: 9px;
            font-size: 15px;
            box-sizing: border-box;
        }

        .auth-form input:focus {
            outline: 2px solid #b7e4c1;
            border-color: #218838;
        }

        .auth-submit {
            width: 100%;
            margin-top: 24px;
            padding: 13px;
            border: 0;
            border-radius: 9px;
            background: #218838;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
        }

        .auth-submit:hover {
            background: #176b2b;
        }

        .auth-message {
            padding: 12px;
            border-radius: 8px;
            margin: 16px 0;
            background: #eaf7ed;
            color: #176b2b;
            line-height: 1.4;
        }

        .auth-footer {
            margin-top: 22px;
            text-align: center;
            color: #66736a;
        }

        .auth-footer a {
            color: #218838;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <main class="auth-page">
        <section class="auth-card">
            <a class="auth-brand" href="index.php">ResQfood</a>

            <h1>Welcome back!</h1>
            <p class="auth-subtitle">
                Log in to continue rescuing food and helping your community.
            </p>

            <?php if ($message !== ""): ?>
                <div class="auth-message">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form class="auth-form" method="POST" action="login.php">
                <label for="email">Email address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    autocomplete="email"
                    required
                >

                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="current-password"
                    required
                >

                <button class="auth-submit" type="submit">
                    Log In →
                </button>
            </form>

            <p class="auth-footer">
                Don't have an account?
                <a href="register.php">Create an account</a>
            </p>
        </section>
    </main>
</body>
</html>
