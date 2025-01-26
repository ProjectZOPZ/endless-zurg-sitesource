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
    <title>Xbox Auth Settings</title>
    <link rel="stylesheet" href="../notify.css" />    <script src="../html_is_public_already_retard.js"></script>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: black;
            overflow: hidden;
            color: white; /* Text color for all elements */
            transition: color 0.3s ease; /* Smooth transition for text color */
        }
        .title {
            font-size: 48px;
            text-align: center;
            animation: neon 1s infinite alternate;
            margin-bottom: 20px; /* Added margin for spacing */
        }
        @keyframes neon {
            from {
                text-shadow: 0 0 10px indigo, 0 0 20px indigo, 0 0 30px indigo, 0 0 40px indigo;
            }
            to {
                text-shadow: 0 0 20px white, 0 0 30px white, 0 0 40px white, 0 0 50px indigo;
            }
        }
        .container {
            padding: 20px;
            background: rgba(0, 0, 0, 0.8);
            border: 2px solid indigo;
            border-radius: 10px;
            box-shadow: 0 0 20px indigo;
            width: 80%; /* Adjusted width for better fit */
            max-width: 600px; /* Added max-width to prevent too much stretching */
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: calc(100% - 22px); /* Adjusted width to prevent overflowing borders */
            padding: 10px;
            border: 2px solid indigo;
            border-radius: 5px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            box-shadow: 0 0 10px indigo;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        input:hover {
            border-color: red; /* Hover effect for border */
            box-shadow: 0 0 20px red; /* Neon effect on hover */
        }
        input:focus {
            border-color: white;
            box-shadow: 0 0 20px white;
            outline: none;
        }
        button {
            width: 100%;
            padding: 10px;
            border: 2px solid indigo;
            border-radius: 5px;
            background: black;
            color: white;
            cursor: pointer;
            box-shadow: 0 0 10px indigo;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, color 0.3s ease;
        }
        button:hover {
            border-color: white;
            box-shadow: 0 0 20px white;
        }
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        .line {
            position: absolute;
            width: 2px;
            height: 100px;
            background: indigo;
            opacity: 0.8;
            animation: move 10s linear infinite;
        }
        @keyframes move {
            from {
                transform: translateY(-100px);
            }
            to {
                transform: translateY(100vh);
            }
        }
        .theme-selector {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.7);
            border: 2px solid indigo;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 0 10px indigo;
        }
        .home-link {
            position: fixed;
            top: 20px;
            left: 20px;
            color: white;
            text-decoration: none;
            padding: 10px;
            border: 2px solid indigo;
            border-radius: 5px;
            background: black;
            box-shadow: 0 0 10px indigo;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, color 0.3s ease;
            z-index: 999;
        }
        .home-link:hover {
            border-color: white;
            box-shadow: 0 0 20px white;
        }
    </style>
</head>
<body onload="localStorage.clear(), checkup()">
    <a href="index.php" class="home-link">Home</a> 
    <div class="background">
        <script>
            const background = document.querySelector('.background');
            const numLines = 50;
            for (let i = 0; i < numLines; i++) {
                const line = document.createElement('div');
                line.classList.add('line');
                line.style.left = `${Math.random() * 100}vw`;
                line.style.animationDuration = `${Math.random() * 5 + 5}s`;
                background.appendChild(line);
            }

            document.addEventListener('mousemove', (e) => {
                const lines = document.querySelectorAll('.line');
                lines.forEach(line => {
                    const rect = line.getBoundingClientRect();
                    const dx = e.clientX - rect.left - rect.width / 2;
                    const dy = e.clientY - rect.top - rect.height / 2;
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    const maxDist = 100;
                    if (dist < maxDist) {
                        line.style.transform = `translateY(${dist / 5}px)`;
                    } else {
                        line.style.transform = 'translateY(0)';
                    }
                });
            });
        </script>
    </div>
    <div id="apidownNotice" class="container">
        <div class="title">Welcome To The Xbox Side Of Endless</div>
        <form id="auth-form">
            <div class="form-group">
                <label for="auth-token">Xbox Auth Token</label>
                <input type="text" id="auth-token" name="auth-token" placeholder="Enter your Xbox Auth Token" required>
            </div>
            <div class="form-group">
                <button type="submit">Auth</button>
            </div>
        </form>
        <center>
        <a href="./auth.php"><u>Connect to xbox.com account.</u></a>
        </center>
    </div>

    <div class="theme-selector">
        <label for="theme">Theme:</label>
        <select id="theme" name="theme" onchange="changeTheme(this.value)">
            <option value="red">Red</option>
            <option value="white">White</option>
            <option value="yellow">Yellow</option>
            <option value="orange">Orange</option>
            <option value="indigo">Indigo</option>
            <option value="green">Green</option>
            <option value="cyan">Cyan</option>
        </select>
    </div>

    <script>
        function changeTheme(theme) {
            const body = document.body;
            body.style.color = theme;
            const titles = document.querySelectorAll('.title');
            titles.forEach(title => {
                title.style.textShadow = `0 0 10px ${theme}, 0 0 20px ${theme}, 0 0 30px ${theme}, 0 0 40px ${theme}`;
            });
            const shadows = document.querySelectorAll('.container, button, input');
            shadows.forEach(shadow => {
                shadow.style.boxShadow = `0 0 10px ${theme}`;
            });
            const lines = document.querySelectorAll('.line');
            lines.forEach(line => {
                line.style.background = theme;
            });
        }
    </script>
    <script>
    //// HTML isn't private code, so there's no problem with sharing it. Every line of HTML is meant to be seen by users so we have no issue with you sharing the "code", educate yourself before you speak because you sound retarded saying you are leaking HTML XD.   You are harmless, why not go view the html source of a .gov site and claim you hacked the goverment XD
    function unixtime() {
        return Math.floor(Date.now() / 1000);
    }
    document.getElementById('auth-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const authToken = document.getElementById('auth-token').value;
        const authenticity = "<?php echo $authGen;?>";
        if (authToken) {
        fetch(`../ENAPI/auth.php?token=${authToken}&authenticity=${authenticity}`, {
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                new Notify({
                    status: "success",
                    title: "Success!",
                    text: "Authentication Successful",
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

                localStorage.setItem('authToken', authToken);
                localStorage.setItem('authExpires', unixtime() + 46800);
                setTimeout(() => {
                    location.href = "./xboxhomepage.php";
                }, 3000);
            } else {
                new Notify({
                    status: "error",
                    title: "Error!",
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
        .catch(error => {
            new Notify({
                    status: "error",
                    title: "Error!",
                    text: "Error With API!",
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
        });
        } else {
            new Notify({
                    status: "error",
                    title: "Error!",
                    text: 'Please enter your Xbox Auth Token',
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
    });





    function checkup() {
    fetch(`../ENAPI/uptime.php?authenticity`, {
        method: 'GET',
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            console.log("API is up and running.");

        } else {
            document.getElementById('apidownNotice').innerHTML = `
                <i style="font-size: 78px; text-align: center; margin-bottom: 20px; display: block; color: mediumpurple;" class="fa fa-warning"></i>
                <div class="title">We are just updating a few things...</div>
                <div style="font-size: 28px;" class="title">We'll be back soon!</div>
            `;
        }
    })
    .catch(error => {
        console.error("Error fetching API status:", error); 
        document.getElementById('apidownNotice').innerHTML = `
            <i style="font-size: 78px; text-align: center; margin-bottom: 20px; display: block; color: mediumpurple;" class="fa fa-warning"></i>
            <div class="title">We are just updating a few things...</div>
            <div style="font-size: 28px;" class="title">We'll be back soon!</div>
        `;
    });
}



    </script>
</body>
</html>
