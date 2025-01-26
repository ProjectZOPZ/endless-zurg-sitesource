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
    <meta property="og:url" content="https://everlastingaio.xyz/">
    <link rel="stylesheet" href="../notify.css" />
    <script src="../html_is_public_already_retard.js"></script>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
    <title>Endless Products</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg, black, indigo);
            background-size: 200% 200%;
            animation: gradient 10s ease infinite;
            color: #ffffff; /* Default text color as white */
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .top-bar {
            background-color: BlueViolet;
            padding: 10px;
            display: flex;
            align-items: center;
        }

        .top-bar a {
            color: #ffffff; /* Neon white */
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
            transition: color 0.3s;
        }

        .top-bar a:hover {
            color: #000000; /* Neon black on hover */
        }

        h1 {
            color: #ffffff; /* Neon white for header */
            text-align: center;
            margin-top: 20px;
        }

        #dataGrid {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        #dataGrid th, #dataGrid td {
            border: 1px solid #8A2BE2; /* BlueViolet border */
            padding: 10px;
            text-align: center;
            color: #ffffff; /* Neon white for table text */
        }

        #dataGrid th {
            background-color: transparent;
        }

        .notice {
            text-align: center;
            color: #ffffff; /* Neon white */
            font-weight: bold;
            margin-top: 10px;
        }

        .button {
            background-color: transparent;
            border: 2px solid #8A2BE2; /* Starts as BlueViolet */
            color: #ffffff; /* Neon white for button text */
            padding: 10px 20px;
            margin: 20px auto;
            display: block;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
            font-weight: bold; /* Makes button text bold */
        }

        .button:hover {
            border-color: #ffffff; /* Changes border color to neon white on hover */
            color: #ffffff; /* Keeps button text as neon white */
        }

        #gamesSupported {
            text-align: center;
            color: #ffffff; /* Neon white for games supported text */
            font-weight: bold;
            margin-top: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            text-align: center; /* Center-aligns the list */
            color: #ffffff; /* Ensures list text is neon white */
        }

        li {
            margin: 5px 0; /* Adds spacing between list items */
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <a href="index.php">Home</a>
    </div>
    <h1>Welcome To Endless Game Displayer</h1>
    <button onclick="LoadGamePlayers()" class="button">Pull Game</button>

    <table id="dataGrid">
        <thead>
            <tr>
                <th>Gamertag</th>
                <th>IP Address</th>
                <th>XUID</th>
            </tr>
        </thead>
        <tbody id="dataContents">
            <tr>
                <td>n/a</td>
                <td>n/a</td>
                <td>n/a</td>
            </tr>
        </tbody>
    </table>

    <div id="gamesSupported">GAMES SUPPORTED FOR ENDLESS GAME DISPLAYER:</div><br>
    <center>                    
    <b>Any Game that supports the Xbox API should work.</b><br><br>
    <b>Verified Games:</b><br><br>
    • ARK: Survival Evolved<br>
    • Halo: The Master Chief Collection<br>
    • Halo Wars 2<br>
    • Happy Wars<br>
    • Forza Horizon 3<br>
    • Forza Horizon 4<br>
    • Forza Motorsport 7<br>
    • Astroneer<br>
    • Wasteland 3<br>
    • Human Fall Flat<br>
    • White Noise 2<br>
    • Brawlhalla<br>
    • TerraTech<br>
    • Borderlands 2<br>
    • Borderlands The PreSequel<br>
    • Doom Eternal<br>
    • Mortal Kombat 11<br>
    • Dead or Alive 6<br>
    • CarX Drift Racing Online<br>
    
    <br><br>
    </center>


    <script>
        function handleResponse(data) {
            if (data.success) {
                document.getElementById('dataContents').innerHTML = data.html;
            } else {
                document.getElementById('dataContents').innerHTML = "<tr><td>n/a</td><td>n/a</td><td>n/a</td></tr>";
                showError(data.message);
            }
        }

        function handleError() {
            showError("Error With API!");
        }

        function showError(message) {
            new Notify({
                status: "error",
                title: "Error!",
                text: message,
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

        function LoadGamePlayers() {
            const authToken = localStorage.getItem('authToken');
            const authenticity = "<?php echo $authGen;?>";
            
            let myNotify = new Notify({
                status: "info",
                title: "Pulling...",
                text: "Please wait.",
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
                fetch(`../ENAPI/GamePull.php?token=${authToken}&authenticity=${authenticity}`, {
                    method: 'GET',
                })
                .then(response => response.json())
                .then(data => {
                    handleResponse(data);
                })
                .catch(() => {
                    showError("Error with API!");
                })
                .finally(() => {
                    if (myNotify) {
                        myNotify.close();
                    }
                });
            } else {
                showError("Authentication token is missing!");
                if (myNotify) {
                    myNotify.close();
                }
            }
        }
    </script>

    
</body>
</html>
