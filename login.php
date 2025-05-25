<?php
session_start();

$email = $password = "";
$emailErr = $passwordErr = $loginErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $valid = false;
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $valid = false;
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        $valid = false;
    } else {
        $password = $_POST["password"];
    }

    if ($valid) {
        // Placeholder login validation
        // In real app, check credentials from database
        if ($email === "user@example.com" && $password === "password123") {
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $email;
            header("Location: index.php");
            exit;
        } else {
            $loginErr = "Invalid email or password";
        }
    }
}
?>

<?php include 'header.php'; ?>

<section class="max-w-md mx-auto py-16">
    <h2 class="text-3xl font-bold text-center mb-8">Login</h2>

    <?php if ($loginErr): ?>
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6 text-center">
            <?= $loginErr ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="login.php" class="bg-gray-100 p-8 rounded shadow">
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" id="email" name="email" value="<?= $email ?>" class="w-full p-2 border border-gray-300 rounded" />
            <span class="text-red-600 text-sm"><?= $emailErr ?></span>
        </div>
        <div class="mb-6">
            <label for="password" class="block font-semibold mb-1">Password</label>
            <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded" />
            <span class="text-red-600 text-sm"><?= $passwordErr ?></span>
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded transition duration-300">
            Login
        </button>
    </form>
</section>

<?php include 'footer.php'; ?>
