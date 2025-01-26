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



include $_SERVER['DOCUMENT_ROOT'] . '/includes/encryption.php';

$filename = $_SERVER['DOCUMENT_ROOT'] . '/includes/encryption.php';

if (file_exists($filename)) {
} else {
    die("error with server.");
    return;
}

$authGen = GenerateAPIkey();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Endless Products offers a range of tools and services including VPNs, Xbox tools, sniffers, stressers, and more. Explore our solutions for enhanced security and performance.">
    <meta property="og:title" content="Endless Products">
    <meta property="og:description" content="Explore our range of tools and services including VPNs, Xbox tools, sniffers, and more.">
    <meta property="og:url" content="https://everlastingaio.xyz/">    <script src="../html_is_public_already_retard.js"></script>

    <link rel="stylesheet" href="../notify.css" />

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
    <title>Endless Products</title>
    <style>
        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background: linear-gradient(270deg, black, indigo);
            background-size: 400% 400%;
            animation: gradientBackground 15s ease infinite;
        }
        .top-bar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            background-color: BlueViolet;
            padding: 20px;
            text-align: left;
        }
        .top-bar a {
            color: white;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .top-bar a:hover {
            color: black;
        }
        h1 {
            color: white;
            text-shadow: 0 0 10px white;
            font-size: 36px;
        }
        p {
            color: white;
            text-shadow: 0 0 10px white;
            font-size: 18px;
            max-width: 800px;
            text-align: center;
            margin-bottom: 40px;
        }
        .notice {
            font-size: 22px;
            color: BlueViolet;
            animation: pulse 2s infinite;
            text-shadow: 0 0 20px white;
        }
        @keyframes pulse {
            0% { text-shadow: 0 0 5px BlueViolet; }
            50% { text-shadow: 0 0 20px white; }
            100% { text-shadow: 0 0 5px BlueViolet; }
        }
        .input-box {
            width: 300px;
            padding: 15px;
            margin-bottom: 20px;
            border: 2px solid BlueViolet;
            background-color: transparent;
            color: white;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        .input-box::placeholder {
            color: white;
            text-shadow: none; /* Remove neon effect from the placeholder text */
        }
        .input-box:focus {
            outline: none;
            border-color: white;
        }
        .button {
            padding: 15px 30px;
            margin: 10px;
            border: 2px solid BlueViolet;
            background-color: transparent;
            color: white;
            font-size: 18px;
            text-shadow: 0 0 10px white;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }
        .button:hover {
            border-color: white;
        }
        /* ComboBox styles */
        .combo-box {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }
        select {
            padding: 10px;
            margin: 5px;
            border: 2px solid BlueViolet;
            background-color: transparent;
            color: white;
            font-size: 16px;
            text-shadow: 0 0 10px white;
            transition: border-color 0.3s ease, color 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <a href="index.php">Home</a>
    </div>

    <h1>Invite Spammer</h1>
    <p>Spam your friends with invites to parties and games with the Endless Invite Spammer. Whether you're sending a single invite or flooding their inbox with spam, this tool will make sure they know you're waiting! With the ability to bypass invite blocks, nothing will stop you from reaching out. Flood their notifications and get that game or party started!</p>

    <div class="notice">ENTER THE GAMERTAG BELOW</div>
    <input id="gtag" type="text" class="input-box" placeholder="Enter a gamertag...">

    <div>
        <button onclick="InviteUser(document.getElementById('gtag').value)" class="button">Invite Player</button>
    </div>

    <!-- ComboBox for color changer -->
    <div class="combo-box">
        <select id="themeChanger">
            <option value="BlueViolet">BlueViolet</option>
            <option value="Red">Red</option>
            <option value="Green">Green</option>
            <option value="Yellow">Yellow</option>
        </select>

        <select id="textChanger">
            <option value="white">Neon White</option>
            <option value="cyan">Neon Cyan</option>
            <option value="lime">Neon Lime</option>
        </select>
    </div>

    <script>
        const themeChanger = document.getElementById("themeChanger");
        const textChanger = document.getElementById("textChanger");

        themeChanger.addEventListener("change", function() {
            document.querySelectorAll(".input-box, .button, .top-bar").forEach(function(el) {
                el.style.borderColor = themeChanger.value;
                el.style.backgroundColor = 'transparent'; // Keep the buttons transparent
            });
        });

        textChanger.addEventListener("change", function() {
            document.querySelectorAll("h1, p, .notice, .button, .input-box, .top-bar a").forEach(function(el) {
                el.style.color = textChanger.value;
                el.style.textShadow = `0 0 10px ${textChanger.value}`;
            });
        });




        function InviteUser(gtag)
        {
            const authToken = localStorage.getItem('authToken');
            const authenticity = "<?php echo $authGen; ?>";
            let myNotify = new Notify({
                status: "info",
                title: "Invite Service",
                text: "Sending...",
                effect: 'fade',
                speed: 300,
                showIcon: true,
                showCloseButton: true,
                autoclose: false,
                autotimeout: 2500,
                gap: 20,
                distance: 20,
                type: 'outline',
                position: 'right top'
            });
            if (authToken) {
                fetch(`../ENAPI/InviteTool.php?token=${authToken}&authenticity=${authenticity}&gt=${encodeURIComponent(gtag)}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (myNotify) {
                        myNotify.close();
                    }
                    if(data.success)
                    {
                        new Notify({
                            status: "success",
                            title: "Invite Service",
                            text: "Invite Received by target!",
                            effect: 'fade',
                            speed: 300,
                            showIcon: true,
                            showCloseButton: true,
                            autoclose: true,
                            autotimeout: 2500,
                            gap: 20,
                            distance: 20,
                            type: 'outline',
                            position: 'right top'
                        });
                    }
                    else
                    {
                        new Notify({
                            status: "error",
                            title: "Invite Service",
                            text: data.message,
                            effect: 'fade',
                            speed: 300,
                            showIcon: true,
                            showCloseButton: true,
                            autoclose: true,
                            autotimeout: 2500,
                            gap: 20,
                            distance: 20,
                            type: 'outline',
                            position: 'right top'
                        });
                    }
                })
                .catch(() => {
                    if (myNotify) {
                        myNotify.close();
                    }
                });
            }
        }
    </script>
</body>
</html>
