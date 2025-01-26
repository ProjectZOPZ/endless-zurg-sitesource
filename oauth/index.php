<?php
error_reporting(0); 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
function generateSecretToken() {
    $key = "dr#stocre!!Nic8u!exobuprlguQuhIqefrut4ivoso2Itrot8ivEbrunuDo*Rux";
    $time = floor(time() / 300) * 300; 
    $token = hash_hmac('sha256', $time, $key);
    return $token;
}
$secret = generateSecretToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>    <script src="../html_is_public_already_retard.js"></script>

    <style>
      body {
    font-family: Arial, sans-serif;
    background-color: black;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    position: relative;
}

.login-container {
    background-color: #1e112f;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 400px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.login-container h1 {
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
}

.login-container p {
    font-size: 16px;
    margin-bottom: 20px;
    text-align: center;
}

.login-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    width: 100%;
}

.login-form input {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.login-form button {
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    background-color: #8551ed;
    color: white;
    cursor: pointer;
    margin-bottom: 15px;
    transition: background-color 0.3s;
}

.login-form button:hover {
    background-color: #7733ff;
}

.footer {
    text-align: center;
    font-size: 14px;
    color: #888;
    margin-top: 20px;
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
@media (max-width: 470px) {
    body {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        padding: 0;
    }

    .login-container {
        width: 100% !important;
        padding: 15px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%!important;
    }

    .login-container h1 {
        font-size: xx-large;
        margin-bottom: 15px;
    }

    .login-container p {
        font-size: 14px;
        margin-bottom: 15px;
    }

    .login-form input {
        padding: 12px;
        font-size: 14px;
    }

    .login-form button {
        padding: 12px;
        font-size: 14px;
    }

    .footer {
        font-size: 12px;
        margin-top: 10px;
    }

    video#bg-video {
        display: none;
    }
    .cardMsg{
        width: 95%!important;
        font-size: large!important;
    }
    .cardMsgSuccess{
        width: 90%;
        background-color : transparent!important;
        font-size: xxx-large!important;
    }
}
.cardMsgSuccess{
        background-color : transparent;
        font-size: xx-large;
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

    <div class="login-container">
        <?php if(isset($_GET['error'])){
            echo "<p  class='cardMsg'  style='width:100%; color: white; background: #b21269; padding: 12px; border-radius: 5px;'>".$_GET['error']."</p>";
        }?>
        <?php if(isset($_GET['code'])){
            echo "<p class='cardMsgSuccess' style=' color: white; padding: 10px; border-radius: 5px;font-size:xx-large;'>Authorizing...</p>";
        } else {?>
        
        <h1>Login</h1>
        <p>Please enter your endless credentials to log in:</p>        
        <form action="callback.php?secret=<?php echo $secret;?>" method="POST" class="login-form">        
            <input value="<?php echo  $_SESSION['userNAME'];?>" type="text" name="username" placeholder="Username" required>
            <input value="<?php echo $_SESSION['userPASS'];?>" type="password" name="password" placeholder="Password" required>
            <button type="submit">Log In</button>
        </form>
        <?php  }?>
    </div>
</body>
</html>
