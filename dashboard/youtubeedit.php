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
  <title>Endless YouTube Downloader</title>    <script src="../html_is_public_already_retard.js"></script>

  <style>
    /* General Body and Background */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #0f0f0f;
      color: white;
    }

    /* Top Bar Styles */
    .top-bar {
      background-color: #1e1e1e;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
    }

    .top-bar h1 {
      font-size: 24px;
      background: linear-gradient(45deg, white, blueviolet);
      -webkit-background-clip: text;
      color: transparent;
    }

    /* "Back to Home" Button */
    .back-home {
      font-size: 16px;
      color: white;
      text-decoration: none;
      padding: 5px 10px;
      border: 1px solid transparent;
      transition: color 0.3s, border-color 0.3s;
    }

    .back-home:hover {
      color: blueviolet;
      border-color: blueviolet;
    }

    /* Input and Button Styles */
    .input-container {
      margin-top: 50px;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
    }

    .input-container input {
      padding: 12px;
      width: 300px;
      background: #1e1e1e;
      border: 1px solid #444;
      color: white;
    }

    .input-container button {
      padding: 12px 20px;
      background: blueviolet;
      color: white;
      border: none;
      cursor: pointer;
    }

    .input-container button:hover {
      background: #7a4b99;
    }
    
  </style>
</head>
<body>

  <!-- Top Bar -->
  <div class="top-bar">
    <h1>Endless YouTube Downloader</h1>
    <a href="index.php" class="back-home">Back to Home</a>
  </div>

  <!-- Video Download Section -->
  <div class="input-container">
    <input type="text" class="link" placeholder="Enter video URL">
    <button onclick="video()">Download Video</button>
  </div>

  <script>
    // Video download function
    var link = document.querySelector('.link');

    function video() {
      var url = link.value.trim();
      if (url) {
        if (url.indexOf("https://youtu.be/") !== -1) {
          // Modify the URL for YouTube
          var YTurl = url.replace("https://youtu.be/", "https://www.000tube.com/watch?v=");
          window.open(YTurl, '_blank');
        } else {
          // Modify other video URL formats
          var YTurl = url.replace("you", "000");
          window.open(YTurl, '_blank');
        }
      }
    }
  </script>

</body>
</html>
