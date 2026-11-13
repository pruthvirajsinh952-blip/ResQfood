
<?php
include "db.php";

$message = "";
$messageType = "";

$name = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirm_password"] ?? "";

    if ($name === "" || $email === "" || $password === "") {
        $message = "Please fill in all required fields.";
        $messageType = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
        $messageType = "error";
    } elseif (strlen($password) < 8) {
        $message = "Password must be at least 8 characters.";
        $messageType = "error";
    } elseif ($password !== $confirmPassword) {
        $message = "Passwords do not match.";
        $messageType = "error";
    } else {
        $check = $conn->prepare(
            "SELECT id FROM users WHERE email = ?"
        );
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "An account with this email already exists.";
            $messageType = "error";
        } else {
            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $stmt = $conn->prepare(
                "INSERT INTO users (name, email, password)
                 VALUES (?, ?, ?)"
            );

            $stmt->bind_param(
                "sss",
                $name,
                $email,
                $hashedPassword
            );

            if ($stmt->execute()) {
                $stmt->close();
                $check->close();
                $conn->close();

                header("Location: login.php?registered=1");
                exit;
            } else {
                $message = "Registration failed. Please try again.";
                $messageType = "error";
            }

            $stmt->close();
        }

        $check->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | ResQfood</title>
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
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
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
            margin: 0 0 24px;
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
            line-height: 1.4;
        }

        .auth-message.error {
            background: #fff0f0;
            color: #a52222;
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

            <h1>Create your account</h1>
            <p class="auth-subtitle">
                Join your community in rescuing surplus food.
            </p>

            <?php if ($message !== ""): ?>
                <div class="auth-message <?php echo htmlspecialchars($messageType); ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form class="auth-form" method="POST" action="register.php">
                <label for="name">Full name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    maxlength="100"
                    autocomplete="name"
                    value="<?php echo htmlspecialchars($name); ?>"
                    required
                >

                <label for="email">Email address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    maxlength="150"
                    autocomplete="email"
                    value="<?php echo htmlspecialchars($email); ?>"
                    required
                >

                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    minlength="8"
                    autocomplete="new-password"
                    required
                >

                <label for="confirm_password">Confirm password</label>
                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    minlength="8"
                    autocomplete="new-password"
                    required
                >

                <button class="auth-submit" type="submit">
                    Create Account →
                </button>
            </form>

            <p class="auth-footer">
                Already have an account?
                <a href="login.php">Log in</a>
            </p>
        </section>
    </main>
</body>
</html>
