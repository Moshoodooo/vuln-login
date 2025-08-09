<?php
session_start();

// Hardcoded "database"
$users = [
    ['username' => 'cyber', 'password' => 'cyber123'],
    ['username' => 'user', 'password' => 'userpass']
];

// If form submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ❌ Deliberately vulnerable logic for testing
    foreach ($users as $user) {
        if ($username == $user['username'] && $password == $user['password']) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        }
    }
    $error = "Invalid credentials!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Quicksand', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #6e45e2, #88d3ce);
            overflow: hidden;
        }

        /* Animated background circles */
        .background-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.25;
            filter: blur(80px);
            animation: float 10s infinite alternate ease-in-out;
        }
        .shape1 { width: 300px; height: 300px; background: #ff9a9e; top: -100px; left: -100px; }
        .shape2 { width: 400px; height: 400px; background: #fad0c4; bottom: -150px; right: -150px; }
        .shape3 { width: 250px; height: 250px; background: #a1c4fd; top: 50%; left: 60%; transform: translate(-50%, -50%); }

        @keyframes float {
            from { transform: translateY(0px); }
            to { transform: translateY(30px); }
        }

        .container {
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 15px;
            max-width: 380px;
            width: 90%;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            text-align: center;
            z-index: 2;
        }
        h2 {
            margin-bottom: 1.5rem;
            color: #333;
            font-weight: 700;
        }
        .form-group {
            margin-bottom: 1rem;
            text-align: left;
        }
        label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #444;
            display: block;
            margin-bottom: 0.4rem;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
            outline: none;
            transition: all 0.3s ease;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #6e45e2;
            box-shadow: 0 0 8px rgba(110, 69, 226, 0.3);
        }
        input[type="submit"] {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(135deg, #6e45e2, #88d3ce);
            border: none;
            color: white;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.3s;
        }
        input[type="submit"]:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #5a37c5, #6bc4b8);
        }
        .error {
            color: red;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        .hint {
            font-size: 0.85rem;
            color: #555;
            margin-top: 1rem;
        }
        @media (max-width: 500px) {
            .container {
                padding: 1.5rem;
            }
            h2 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
    <!-- Decorative background shapes -->
    <div class="background-shape shape1"></div>
    <div class="background-shape shape2"></div>
    <div class="background-shape shape3"></div>

    <div class="container">
        <h2> SecureBySh00d</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" placeholder="Enter your password" required>
            </div>
            <input type="submit" value="Login">
        </form>
        <p class="hint">Hint: Try <b>cyber/cyber123</b></p>
    </div>
</body>
</html>
