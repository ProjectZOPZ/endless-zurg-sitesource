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
    <link rel="stylesheet" href="../notify.css" />    <script src="../html_is_public_already_retard.js"></script>


    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
    <title>Endless Products</title>

    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            overflow-y: auto;
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

        #center-block {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 120px; /* Space for top bar */
            width: 80%;
            max-width: 1200px;
        }

        .input-container {
            width: 90%;
            display: flex;
            justify-content: flex-start;
            margin-bottom: 15px;
        }

        .input-container input {
            width: auto;
            padding: 12px;
            font-size: 16px;
            border: none;
            background-color: #8a2be2;
            color: white;
            border-radius: 5px;
        }

        #center-block {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 120px; 
            width: 100%;
            max-width: 1200px;
        }

        table {
            width: 90%;
            max-width: 1200px; 
            margin: 0 15px; 
            border-collapse: collapse;
            color: #ddd;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid white;
            text-align: left;
        }

        th {
            background-color: rgba(75, 0, 130, 0.8);
            font-size: 18px;
        }

        td {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .hideDiv {
                
            }
        
        @media (max-width: 768px) {
            .hideDiv {
                display:none!important;
            }
        }

        ::-webkit-input-placeholder { 
    color:    #000000;
}
:-moz-placeholder { 
   color:    #000000;
   opacity:  1;
}
::-moz-placeholder { 
   color:    #000000;
   opacity:  1;
}
:-ms-input-placeholder { /
   color:    #000000;
}
::-ms-input-placeholder { 
   color:    #000000;
}

::placeholder {
   color:    #000000;
}


        #btns {
    width: 90%;
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap; 
    background: transparent;
    padding: 15px;
    box-sizing: border-box;
}

#btns button {
    background: mediumpurple;
    border: none;
    padding: 8px;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    font-family: monospace;
    transition: background 0.3s ease;
    flex: 0 1 150px;
    margin: 5px;
    max-width: 100%; 
}

#btns button:hover {
    background: #603fa4;
}

@media (max-width: 768px) {
    #btns {
        flex-direction: column;
        align-items: center;
    }

    #btns button {
        width: 100%;
        margin-bottom: 10px;
        max-width: none; 
        flex: 0 1 40px!important;
    }
}

    </style>
</head>
<body onload="checkAuth(),CheckSearch()">
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
    
    <div id="center-block">
        <div class="input-container">
            <input onleave="SearchData()" placeholder="Enter a Gamertag: " id="targetBox" type="text">
        </div>
        <div id="btns">
        <code style="line-height: 25px; background: #050009; width: 100%; padding: 15px; font-size: 15px; border-radius: 5px;">
            Gamertag: <span id="data_Gamertag">N/A</span><br>
            <hr style="width: 90%; float: left;"><br>
            Xuid: <span id="data_Xuid">N/A</span><br>
            GamerScore: <span id="data_GamerScore">N/A</span><br>
            Account Tier: <span id="data_AccountTier">N/A</span><br>
            Is Favorite: <span id="data_IsFavorite">N/A</span><br>
            Is Following Caller: <span id="data_IsFollowingCaller">N/A</span><br>
            Is Followed by Caller: <span id="data_IsFollowedByCaller">N/A</span><br>
            Is Identity Shared: <span id="data_IsIdentityShared">N/A</span><br>
            Added Date Time UTC: <span id="data_AddedDateTimeUTC">N/A</span><br>
            Display Name: <span id="data_DisplayName">N/A</span><br>
            Real Name: <span id="data_RealName">N/A</span><br>
            Display Pic: <a style="color: #00bdff;" href="#N/A" target="_blank" id="data_DisplayPic">View</a><br>
            Modern Gamertag: <span id="data_ModernGamertag">N/A</span><br>
            Modern Gamertag Suffix: <span id="data_ModernGamertagSuffix">N/A</span><br>
            Unique Modern Gamertag: <span id="data_UniqueModernGamertag">N/A</span><br>
            Xbox One Rep: <span id="data_XboxOneRep">N/A</span><br>
            Presence State: <span id="data_PresenceState">N/A</span><br>
            Presence Text: <span id="data_PresenceText">N/A</span><br>
            Presence Devices: <span id="data_PresenceDevices">N/A</span><br>
            Is Broadcasting: <span id="data_IsBroadcasting">N/A</span><br>
            Is Cloaked: <span id="data_IsCloaked">N/A</span><br>
            Is Quarantined: <span id="data_IsQuarantined">N/A</span><br>
            Is Xbox 360 Gamerpic: <span id="data_IsXbox360Gamerpic">N/A</span><br>
            Last Seen DateTime UTC: <span id="data_LastSeenDateTimeUTC">N/A</span><br>
            Suggestion: <span id="data_Suggestion">N/A</span><br>
            Recommendation: <span id="data_Recommendation">N/A</span><br>
            Follower: <span id="data_Follower">N/A</span><br>
            Preferred Color: <span id="data_PreferredColor">N/A</span><br>
            Bio: <span id="data_Bio">N/A</span><br>
            Is Verified: <span id="data_IsVerified">N/A</span><br>
            Location: <span id="data_Location">N/A</span><br>
            Blocked: <span id="data_Blocked">N/A</span><br>
            Mute: <span id="data_Mute">N/A</span><br>
            Follower Count: <span id="data_FollowerCount">N/A</span><br>
            Following Count: <span id="data_FollowingCount">N/A</span><br>
            Has Game Pass: <span id="data_HasGamePass">N/A</span><br>
            Color Theme: <span id="data_ColorTheme">N/A</span><br>
            Preferred Platforms: <span id="data_PreferredPlatforms">N/A</span><br>
        </code>

        </div>
    </div>
</body>



<script>
    /// HTML isn't private code, so there's no problem with sharing it. Every line of HTML is meant to be seen by users so we have no issue with you sharing the "code", educate yourself before you speak because you sound retarded saying you are leaking HTML XD.   You are harmless, why not go view the html source of a .gov site and claim you hacked the goverment XD




    let typingTimer;                
    let doneTypingInterval = 500;  
    let inputBox = document.getElementById('targetBox');

    inputBox.onkeyup = function() {
        clearTimeout(typingTimer); 
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    };

    inputBox.onkeydown = function() {
        clearTimeout(typingTimer); 
    };

    function doneTyping() {
        SearchData(); 
    }
    function updateUrlParameter(param, value) {
        const url = new URL(window.location);
        const uniqueValue = `${value}`;
        url.searchParams.set(param, uniqueValue);
        window.history.pushState({}, '', url);
    }

    document.getElementById('data_DisplayPic').onclick = function(event) {
        event.preventDefault();
        const imageUrl = this.href || "#N/A"; 
        if (imageUrl !== "#N/A") {
            window.open(imageUrl, 'popupWindow', 'width=300,height=300');
        } else {
            alert('Image not available');
        }
    };

  
    function handleResponse(data) {
        if (data.success) {
            const userData = data.result;

            document.getElementById('data_Gamertag').textContent = userData.Gamertag || "N/A";
            document.getElementById('data_Xuid').textContent = userData.Xuid || "N/A";
            document.getElementById('data_GamerScore').textContent = userData.GamerScore || "N/A";
            document.getElementById('data_AccountTier').textContent = userData["Account Tier"] || "N/A";
            document.getElementById('data_IsFavorite').textContent = userData.IsFavorite ? "Yes" : "No";
            document.getElementById('data_IsFollowingCaller').textContent = userData.IsFollowingCaller ? "Yes" : "No";
            document.getElementById('data_IsFollowedByCaller').textContent = userData.IsFollowedByCaller ? "Yes" : "No";
            document.getElementById('data_IsIdentityShared').textContent = userData.IsIdentityShared ? "Yes" : "No";
            document.getElementById('data_AddedDateTimeUTC').textContent = userData["Added Date Time UTC"] || "N/A";
            document.getElementById('data_DisplayName').textContent = userData.DisplayName || "N/A";
            document.getElementById('data_RealName').textContent = userData.RealName || "N/A";
            document.getElementById('data_DisplayPic').href = userData.DisplayPic || "#N/A";
            document.getElementById('data_ShowUserAsAvatar').textContent = userData.ShowUserAsAvatar || "N/A";
            document.getElementById('data_ModernGamertag').textContent = userData.ModernGamertag || "N/A";
            document.getElementById('data_ModernGamertagSuffix').textContent = userData.ModernGamertagSuffix || "N/A";
            document.getElementById('data_UniqueModernGamertag').textContent = userData.UniqueModernGamertag || "N/A";
            document.getElementById('data_XboxOneRep').textContent = userData.XboxOneRep || "N/A";
            document.getElementById('data_PresenceState').textContent = userData.PresenceState || "N/A";
            document.getElementById('data_PresenceText').textContent = userData.PresenceText || "N/A";
            document.getElementById('data_PresenceDevices').textContent = userData.PresenceDevices || "N/A";
            document.getElementById('data_IsBroadcasting').textContent = userData.IsBroadcasting ? "Yes" : "No";
            document.getElementById('data_IsCloaked').textContent = userData.IsCloaked || "N/A";
            document.getElementById('data_IsQuarantined').textContent = userData.IsQuarantined ? "Yes" : "No";
            document.getElementById('data_IsXbox360Gamerpic').textContent = userData.IsXbox360Gamerpic ? "Yes" : "No";
            document.getElementById('data_LastSeenDateTimeUTC').textContent = userData.LastSeenDateTimeUTC || "N/A";
            document.getElementById('data_Suggestion').textContent = userData.Suggestion || "N/A";
            document.getElementById('data_Recommendation').textContent = userData.Recommendation || "N/A";
            document.getElementById('data_Follower').textContent = userData.Follower || "N/A";
            document.getElementById('data_PreferredColor').textContent = userData.PreferredColor || "N/A";
            document.getElementById('data_Bio').textContent = userData.Bio || "N/A";
            document.getElementById('data_IsVerified').textContent = userData.IsVerified ? "Yes" : "No";
            document.getElementById('data_Location').textContent = userData.Location || "N/A";
            document.getElementById('data_Blocked').textContent = userData.Blocked ? "Yes" : "No";
            document.getElementById('data_Mute').textContent = userData.Mute ? "Yes" : "No";
            document.getElementById('data_FollowerCount').textContent = userData.FollowerCount || "N/A";
            document.getElementById('data_FollowingCount').textContent = userData.FollowingCount || "N/A";
            document.getElementById('data_HasGamePass').textContent = userData.HasGamePass ? "Yes" : "No";
            document.getElementById('data_ColorTheme').textContent = userData.ColorTheme || "N/A";
            document.getElementById('data_PreferredPlatforms').textContent = userData.PreferredPlatforms.length > 0 ? userData.PreferredPlatforms.join(", ") : "N/A";
            updateUrlParameter(`gts`,userData.Gamertag);
        } else {
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
    
    function SearchData(searchyt = document.getElementById('targetBox').value.trim()) {
    let myNotify = null;

        myNotify = new Notify({
            status: "info",
            title: "Grabbing Data!",
            text: "Please wait while we load your search.",
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

    const authToken = localStorage.getItem('authToken');
    const authenticity = "<?php echo $authGen; ?>";

    if (authToken) {
        fetch(`../ENAPI/profileSearch.php?token=${authToken}&authenticity=${authenticity}&searchTerm=${encodeURIComponent(searchyt)}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            handleResponse(data);
            if (myNotify) {
                myNotify.close();
            }
        })
        .catch(() => {
            if (myNotify) {
                myNotify.close();
            }
        });
    }
}
function CheckSearch()
{
    const url = new URL(window.location);
    const search = url.searchParams.get("gts");
    document.getElementById('targetBox').value = search;
    SearchData(search);

}
</script>





</html>
