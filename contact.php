<?php include 'header.php'; ?>

<section class="max-w-xl mx-auto py-16">
    <h2 class="text-3xl font-bold text-center mb-8">Contact Us</h2>
    <?php
    $name = $email = $service = $message = "";
    $nameErr = $emailErr = $serviceErr = $messageErr = "";
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

        if (empty($_POST["service"])) {
            $serviceErr = "Please select a service";
            $valid = false;
        } else {
            $service = htmlspecialchars($_POST["service"]);
        }

        if (empty($_POST["message"])) {
            $messageErr = "Message is required";
            $valid = false;
        } else {
            $message = htmlspecialchars(trim($_POST["message"]));
        }

        if ($valid) {
            // Here you would typically send an email or save to a database
            $successMsg = "Thank you for contacting us. We will get back to you soon.";
            // Clear form fields
            $name = $email = $service = $message = "";
        }
    }
    ?>

    <?php if ($successMsg): ?>
        <div class="bg-green-100 text-green-700 p-4 rounded mb-6 text-center">
            <?= $successMsg ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="contact.php" class="bg-gray-100 p-8 rounded shadow">
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
            <label for="service" class="block font-semibold mb-1">Service Needed</label>
            <select id="service" name="service" class="w-full p-2 border border-gray-300 rounded">
                <option value="">Select a service</option>
                <option value="Email List Building" <?= $service == "Email List Building" ? "selected" : "" ?>>Email List Building & Verification</option>
                <option value="Data Extraction" <?= $service == "Data Extraction" ? "selected" : "" ?>>Data Extraction & Web Scraping</option>
                <option value="Email Automation" <?= $service == "Email Automation" ? "selected" : "" ?>>Email Automation</option>
                <option value="Task Automation" <?= $service == "Task Automation" ? "selected" : "" ?>>Task Automation</option>
                <option value="B2B Lead Generation" <?= $service == "B2B Lead Generation" ? "selected" : "" ?>>B2B Lead Generation</option>
                <option value="Data Cleaning" <?= $service == "Data Cleaning" ? "selected" : "" ?>>Data Cleaning & Enrichment</option>
                <option value="Automation Tool Development" <?= $service == "Automation Tool Development" ? "selected" : "" ?>>Automation Tool Development</option>
                <option value="Tech Support" <?= $service == "Tech Support" ? "selected" : "" ?>>Tech Support & Integration</option>
            </select>
            <span class="text-red-600 text-sm"><?= $serviceErr ?></span>
        </div>
        <div class="mb-6">
            <label for="message" class="block font-semibold mb-1">Message</label>
            <textarea id="message" name="message" rows="5" class="w-full p-2 border border-gray-300 rounded"><?= $message ?></textarea>
            <span class="text-red-600 text-sm"><?= $messageErr ?></span>
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded transition duration-300">
            Send Message
        </button>
    </form>
</section>

<?php include 'footer.php'; ?>
