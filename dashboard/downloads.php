<?php
include '../includes/keyauth.php';
error_reporting(0); 


if (!isset($_SESSION['user_data'])) {
	header("Location: ../login/");
	exit();
}




$name = "";
$ownerID = "";
$KeyAuthApp = new KeyAuth\api("Endless Multi Tool","wgB5e4ZSpP");
  $name = "Endless Multi Tool";
  $ownerID = "wgB5e4ZSpP";

if (!isset($_SESSION['sessionid'])) {
	$KeyAuthApp->init();
}




function isMobileDevice() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $mobileKeywords = array(
        'mobile', 'android', 'iphone', 'ipod', 'blackberry', 'windows phone', 'opera mini',
        'iemobile', 'webos', 'palm', 'symbian', 'midp', 'wap', 'vodafone', 'mobi', 'kindle'
    );
  
    foreach ($mobileKeywords as $keyword) {
        if (stripos($userAgent, $keyword) !== false) {
            return true;
        }
    }
  
    return false;
}






?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endless Downloads</title>
    <link rel="icon" href="https://i.imghippo.com/files/GPi7602xQ.PNG" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="../html_is_public_already_retard.js"></script>

    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #1E1E1E, #000);
            color: #f5f5f5;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            background: #0f0f0f;
            width: 250px;
            padding: 1.5rem 2rem;
            position: fixed;
            height: 100%;
            top: 0;
            left: -250px; /* Sidebar initially hidden */
            transition: left 0.3s ease;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        }

        .sidebar.open {
            left: 0;
        }

        .sidebar h2 {
            color: #8a2be2;
            font-size: 2rem;
            margin-bottom: 2rem;
            text-transform: uppercase;
        }

        .sidebar a {
            display: block;
            color: #f5f5f5;
            text-decoration: none;
            padding: 1rem;
            border-radius: 5px;
            margin: 1rem 0;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar a:hover {
            background-color: #8a2be2;
            color: #000;
        }

        .sidebar .active {
            background-color: #8a2be2;
            color: #000;
        }

        /* Hamburger Button */
        .hamburger {
            display: block;
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 2rem;
            cursor: pointer;
            z-index: 200;
            color: #f5f5f5;
        }

        .hamburger:hover {
            color: #8a2be2;
        }

        /* Main Content */
        .main-content {
            margin-left: 20;
            padding: 2rem;
            width: 100%;
            transition: margin-left 0.3s ease;
            margin-left: 60px;
        }

        .main-content.open {
            margin-left: 350px;
        }

        .main-content header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 2rem;
            border-bottom: 2px solid #8a2be2;
        }

        .main-content header h1 {
            font-size: 2.5rem;
            color: #8a2be2;
        }

        /* Button Styling for Downloads */
        .button-list a {
            display: block;
            margin-bottom: 1.5rem;
            text-decoration: none;
        }

        .download-button {
            background: #8a2be2;
            color: #fff;
            padding: 12px 15px;
            font-size: 1.1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        .download-button:hover {
            background: #00bcd4;
        }

        /* Footer Styling */
        footer {
            background: rgba(30, 30, 30, 0.9);
            text-align: center;
            padding: 1rem 0;
            color: #aaa;
            font-size: 0.9rem;
            position: absolute;
            width: 100%;
            bottom: 0;
            margin-left: -40px;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h2>Downloads</h2>
        <a href="index.php">Dashboard</a>
        <a href="xboxhomepage.php">Xbox AIO</a>
        <a href="iptools.php">IP Tools</a>
        <a href="endlessedit.php">Editor</a>
        <a href="downloads.php" class="active">Downloads</a>
        <a href="https://t.me/zurgpower">Telegram</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Hamburger Button -->
    <span class="hamburger" id="hamburger">&#9776;</span>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <header>
            <h1>Endless Downloads</h1>
        </header>

        <!-- Download Section -->
        <div class="button-list">
            <!-- Download Button for File 1 -->
            <a href="https://filebin.net/kbxogt016lj945ix" download>
                <button class="download-button">Download Endless Software(ZIP Pass:endless)</button>
            </a>

            <!-- Download Button for File 2 -->
            <a href="https://mega.nz/file/Z7Yj1BAb#Y3C9BUZifacbIfhkPa6dPxyIyQR7JEUatETTBQPsPuk" download>
                <button class="download-button">Download Better Than Fiddler</button>
            </a>

            <!-- Download Button for File 3 -->
            <a href="https://mega.nz/file/dzRHEZ7a#LNF2Lsj3uMG9PUOJH2qrQg6EDPbzSwGvPMqdkY2e8lw" download>
                <button class="download-button">Download the files for Endless Tool/Software</button>
            </a>

            <!-- More download buttons as needed -->
        </div>

        <footer>
            &copy; 2024 Endless Products. All Rights Reserved.
        </footer>
    </div>

    <script>
        // Sidebar toggle functionality
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            mainContent.classList.toggle('open');
        });
    </script>

</body>
</html>

