

<?php
// Utility function to create user directory, subfolders, and store JSON
function createUserFolderAndJson( $firstname, $lastname, $email, $pword, $date, $country, $why) {
    // Sanitize folder name: only allow letters, numbers, hyphens, underscores
    $folderName = preg_replace('/[^a-zA-Z0-9_\-]/', '_', strtolower($firstname . '_' . $lastname));
    $baseDir = __DIR__ . '/p-users';
    if (!is_dir($baseDir)) mkdir($baseDir, 0777, true);
    $userDir = $baseDir . '/' . $folderName;
    if (!is_dir($userDir)) mkdir($userDir, 0777, true);

    // Create 'pp' and 'work' subfolders
    $ppDir = $userDir . '/pp';
    $workDir = $userDir . '/work';
    if (!is_dir($ppDir)) mkdir($ppDir, 0777, true);
    if (!is_dir($workDir)) mkdir($workDir, 0777, true);

    // Create or update user.json in that folder
    $userData = [
        'firstname' => $firstname,
        'lastname'  => $lastname,
        'email'     => $email,
        'pword'     => $pword,
        'date'      => $date,
        'country'   => $country,
        'why'       => $why
    ];

    $jsonPath = $userDir . '/profile.json';
    file_put_contents($jsonPath, json_encode($userData, JSON_PRETTY_PRINT));
    // Optionally, set permissions
    @chmod($jsonPath, 0666);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['firstname'])) {
    // Get POST data safely
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $pword = isset($_POST['pword']) ? trim($_POST['pword']) : '';
    $date = isset($_POST['date']) ? trim($_POST['date']) : '';
    $country = isset($_POST['country']) ? trim($_POST['country']) : '';
    $why = isset($_POST['why']) ? trim($_POST['why']) : '';

    // Simple validation (optional, improve as needed)
    if ($firstname && $lastname && $email && $pword && $date && $country && $why) {
        // Connect to MySQL
        $conn = new mysqli($host, $user, $password, $database);

        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Prepare statement to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO pusers (firstname, lastname, email, pword, date, country, why) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $firstname, $lastname, $email, $pword, $date, $country, $why);

        if ($stmt->execute()) {
            // Create user folder, subfolders, and save JSON data
            createUserFolderAndJson($firstname, $lastname, $email, $pword, $date, $country, $why);
           // Redirect to avoid resubmission
            header('Location: v4.5.php?success=1');
            exit;
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
        $conn->close();
    } else {
        echo "<p>Please fill in all fields!</p>";
    }
}

// Show a message if redirected after successful signup
if (isset($_GET['success']) && $_GET['success'] == '1') {
    $successMsg = "<p>Thank you! Your data has been submitted.</p>";
}

?>