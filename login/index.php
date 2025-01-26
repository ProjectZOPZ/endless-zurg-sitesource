<?php
include '../includes/keyauth.php';
error_reporting(0); 
if (isset($_SESSION['user_data'])) {
	header("Location: /dashboard/");
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

$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : "";
$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : "";

// Check if Save Login button was pressed
if (isset($_POST['save-login'])) {
    // Validate the login credentials first
    if ($KeyAuthApp->login($_POST['username'], $_POST['password'])) {
        // Store login credentials in a cookie (valid for 30 days)
        setcookie("username", $_POST['username'], time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie("password", $_POST['password'], time() + (86400 * 30), "/");

        displaySuccess("Login saved successfully! Welcome " . $_POST['username']);
        echo "<meta http-equiv='Refresh' content='3;'>"; // Refresh after 3 seconds
    } else {
        displayError("Enter valid login information.");
    }
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
    <meta name="description" content="Endless Products offers a range of tools and services including VPNs, Xbox tools, sniffers, stressers, and more. Explore our solutions for enhanced security and performance.">
    <meta property="og:title" content="Endless Products">
    <meta property="og:description" content="Explore our range of tools and services including VPNs, Xbox tools, sniffers, and more.">
    <meta property="og:url" content="https://endlesstool.site/">
    <link rel="stylesheet" href="../notify.css" />    <script src="../html_is_public_already_retard.js"></script>


    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
    <title>Endless Products</title>

     <style>
        .menuv2 {
    display: block;
}
@media screen and (min-width:992px) {
    .menuv2 {
        display:none;
    }}




    .menuv2header {
    display: none;
}
.stats {
    display: none;
}


@media screen and (min-width: 992px) {
    .menuv2header {
        display: inline-block !important;
    }
}
@media screen and (min-width: 768px) {
    .stats {
        display: block !important;
    }
}
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #ffffff; /* White background for the page */
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;

        background: #050507;
        background-size: cover;
    }


    #login-card {
        background-color: #1e112f;
        display: flex;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        max-width: 800px; /* Adjust the maximum width of the login card */
        margin: 0 auto; /* Center the login card on the page horizontally */
    }

    #login-form {
        flex: 1;
        padding: 20px;
    }

   #xbx-code {
        flex: 1;
        position: relative;
        width: 300px;
        height: 300px;
        <?php if(isMobileDevice()){echo"display:none";}?>
        
    }

    form {
        max-width: 300px;
        margin: 0 auto;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #e8e8ef;
    }

    input {
        width: 100%;
        padding: 8px;
        margin-bottom: 16px;
        background: #4b3a61;
        border: none;
        border-radius: 4px;
    }

    button {
        background-color: #8551ed;
        color: #ffffff;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }


    #centered-image {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 50px; /* Set the maximum width of the centered image to 50px */
            max-height: 50px; /* Set the maximum height of the centered image to 50px */
        }

      
        @keyframes drawCheck {
      0% {
        stroke-dashoffset: 48;
      }
      50% {
        stroke-dashoffset: 0;
      }
      100% {
        stroke-dashoffset: 0;
      }
    }

    .container {
      position: absolute;
      width: 100px;
      height: 100px;
    }

    .checkmark {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .circle-border {
      fill: none;
      stroke: #4caf50;
      stroke-width: 2;
    }

    .checkmark__circle {
      fill: #4caf50;
      stroke: #4caf50;
      stroke-width: 2;
      stroke-dasharray: 48;
      stroke-dashoffset: 48;
      animation: drawCheck 0.5s ease-in-out forwards;
    }

    .checkmark__check {
      fill: none;
      stroke: #4caf50;
      stroke-width: 8;
      stroke-linecap: round;
      stroke-dasharray: 48;
      stroke-dashoffset: 48;
      animation: drawCheck 0.5s ease-in-out forwards;
    }


    .banned-message {
        text-align: center;
        color: #ac0010;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        margin-top: 60px;
        box-shadow: 0px 0px 20px rgb(0 0 0);
        margin-left: 50px;
        background: #ff00000a;
        margin-right: 50px;
}

.banned-message h3 {
    margin-top: 0;
}

.banned-message h4 {
    margin-bottom: 0;
    margin-top: -15px;
}

.banned-message i {
    font-size: 80px;
    border: solid 1px red;
    border-radius: 100px;
    color: #380202;
    width: 80px;
    padding: 5px;
    background: red;
    margin-bottom: 10px;
}
.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #0000006b;
    cursor:pointer;
}

.modal {
    padding: 20px;
    text-align: center;
    cursor:pointer;
}

.modal h1 {
    margin: 0;
    color:#e8e8e8;
    cursor:pointer;
}

video#bg-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; 
    z-index: -1;
}

</style>

</head>
<body>
<video autoplay muted playsinline id="bg-video">
    <source src="" type="video/mp4">
</video>

<script>
        let url;
        url = "../cdn/vidanime.php";
        const headers = {
            'token': 'SentinelCCfheiowfhowifhow'
        };
        fetch(url, { headers })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(parsedResponse => {
                const src = parsedResponse.src;
                var video = document.getElementById("bg-video");
                video.src = src;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    </script>

<div id="login-card">
    <div id="login-form">
   
            <form method="post">
                <label for="username">Username:</label>
                <input style="color:#fff;" type="text" id="username" name="username">

                <label for="password">Password:</label>
                <input style="color:#fff;" type="password" id="password" name="password">
                <button name="login" type="submit">Login ➜</button>
                <button style="background-color: #562da7;" name="register" type="submit">Register ➜</button>
				<button style="margin-top: 10px; background-color: #4b3a61;" name="save-login" type="submit">Save Login ➜</button>
            </form>
    </div>

    <div id="xbx-code">
            <center>
            </center>
    </div>
  </div>

    <?php
    
    if (isset($_POST['register'])) {
        echo "<meta http-equiv='Refresh' Content='0; url=https://www.instagram.com/endlessnochill/'>";
        return;
    }
    ?>


<script>
        document.getElementById('xbx-code').innerHTML = '<center><img style="margin-top:50px;width:190px;" src="../assets/img/icon.png" alt="endless logo" draggable="false"></center>';
</script>
<?php

if (isset($_POST['login'])) {
    if ($KeyAuthApp->login($_POST['username'], $_POST['password'])) {
        displaySuccess("Welcome ".$_POST['username']);
        echo "<meta http-equiv='Refresh' content='3;'>";
    } else {
        session_destroy();
        displayError("Enter valid login information.");
    }
}

function displayError($message) {
    ?>
    <script>
        new Notify({
            status: "error",
            title: "Error!",
            text: `<?php echo $message; ?>`,
            effect: 'fade',
            speed: 300,
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 5000,
            gap: 20,
            distance: 20,
            type: 'outline',
            position: 'right top'
        });
    </script>
    <?php
}


function displaySuccess($message) {
    ?>
    <script>
        new Notify({
            status: "success",
            title: "Success!",
            text: `<?php echo $message; ?>`,
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
    </script>
    <?php
}





?>


</body>
</html>
