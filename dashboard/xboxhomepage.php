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
    <title>Endless Xbox Options</title>    <script src="../html_is_public_already_retard.js"></script>

    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            overflow-y: auto; /* Allow scrolling */
            color: white;
            font-family: Arial, sans-serif;
            background: linear-gradient(270deg, #4B0082, #000000);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .top-bar {
            width: 100%;
            background-color: BlueViolet;
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        .top-bar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }

        .logo {
            margin-top: 70px; /* Space for top bar */
            width: 150px; /* Adjust size as needed */
            height: auto;
            display: block;
        }

        .title {
            font-size: 48px;
            animation: neon 1s infinite alternate;
            text-align: center;
        }

        @keyframes neon {
            from {
                text-shadow: 0 0 10px white, 0 0 20px white, 0 0 30px white;
            }
            to {
                text-shadow: 0 0 20px BlueViolet, 0 0 30px BlueViolet, 0 0 40px BlueViolet;
            }
        }

        .description {
            margin: 20px 20px 50px; 
            text-align: center;
            font-size: 20px;
            line-height: 1.5;
            color: #ccc; 
        }

        .button-list {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%; 
        }

        .button {
            background: transparent;
            border: 2px solid black;
            color: white;
            padding: 15px 30px;
            margin: 10px 0;
            font-size: 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: border-color 0.3s ease, color 0.3s ease, background 0.3s ease;
            width: 80%; 
            text-align: center;
            font-weight: bold; 
            text-transform: uppercase; 
            text-decoration: none; 
        }

        .button:hover {
            border-color: white;
        }

        .button:active {
            border-color: BlueViolet;
            background: rgba(0, 0, 255, 0.1); 
        }
    </style>
</head>
<body onload="checkAuth();">
    <script>
    function checkAuth() {
        const expires = localStorage.getItem('authExpires');
        if (!expires || Math.floor(Date.now() / 1000) > expires) {
            window.location.href = 'xbox.php';
        }
    }
    </script>
    <div class="top-bar">
        <a href="index.php">Home</a>
        <a href="https://t.me/zurgpower/4">Help</a>
    </div>
    
    <!-- Logo Section -->
    <img src="../assets/img/icon.png" alt="Logo" class="logo">
    
    <div class="title">Welcome To Endless Xbox Options</div>

    <div class="description">
        Discover entertaining options to troll and have fun! Below, you'll find a collection of features designed for maximum enjoyment and mischief.
    </div>

    <div class="button-list">
        <a href="xboxparty.php" class="button">Xbox Party Functions</a>
        <a href="ban.php" class="button">Ban Hammer</a>
        <a href="resolve.php" class="button">Gamertag Resolver</a>
        <a href="xbox.php" class="button">Unauth/Change Account</a>
        <a href="profilelook.php" class="button">Profile Lookup</a>
        <a href="gamepull.php" class="button">Game Displayer</a>
        <a href="messageplayer.php" class="button">Message Player</a>
        <a href="invspam.php" class="button">Invite Spammer</a>
        <a href="friendparty.php" class="button">Friends & Followers tool</a>
    </div>
</body>
</html>
