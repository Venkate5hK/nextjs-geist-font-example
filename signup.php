<?php
session_start();

$name = $email = $password = $confirm_password = "";
$nameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";
$successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $valid = false;
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

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
    } elseif (strlen($_POST["password"]) < 6) {
        $passwordErr = "Password must be at least 6 characters";
        $valid = false;
    } else {
        $password = $_POST["password"];
    }

    if (empty($_POST["confirm_password"])) {
        $confirmPasswordErr = "Please confirm your password";
        $valid = false;
    } elseif ($_POST["confirm_password"] !== $_POST["password"]) {
        $confirmPasswordErr = "Passwords do not match";
        $valid = false;
    } else {
        $confirm_password = $_POST["confirm_password"];
    }

    if ($valid) {
        // Placeholder for user registration logic
        $successMsg = "Registration successful. You can now log in.";
        $name = $email = $password = $confirm_password = "";
    }
}
?>

<?php include 'header.php'; ?>

<section class="max-w-md mx-auto py-16">
    <h2 class="text-3xl font-bold text-center mb-8">Sign Up</h2>

    <?php if ($successMsg): ?>
        <div class="bg-green-100 text-green-700 p-4 rounded mb-6 text-center">
            <?= $successMsg ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="signup.php" class="bg-gray-100 p-8 rounded shadow">
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Name</label>
            <input type="text" id="name" name="name" value="<?= $name ?>" class="w-full p-2 border border-gray-300 rounded" />
            <span class="text-red-600 text-sm"><?= $nameErr ?></span>
        </div>
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" id="email" name="email" value="<?= $email ?>" class="w-full p-2 border border-gray-300 rounded" />
            <span class="text-red-600 text-sm"><?= $emailErr ?></span>
        </div>
        <div class="mb-4">
            <label for="password" class="block font-semibold mb-1">Password</label>
            <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded" />
            <span class="text-red-600 text-sm"><?= $passwordErr ?></span>
        </div>
        <div class="mb-6">
            <label for="confirm_password" class="block font-semibold mb-1">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" class="w-full p-2 border border-gray-300 rounded" />
            <span class="text-red-600 text-sm"><?= $confirmPasswordErr ?></span>
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded transition duration-300">
            Sign Up
        </button>
    </form>
</section>

<?php include 'footer.php'; ?>
