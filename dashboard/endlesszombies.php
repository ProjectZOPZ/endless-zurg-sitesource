<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <script src="../html_is_public_already_retard.js"></script>

    <title>Endless Zombies</title>
    <style>
      
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-image: url('Images/CODEZ3.jpg'); /* Background image */
            background-size: cover;
            background-position: center 58px; /* Move the background down */
            position: relative;
            overflow: hidden;
            height: 100vh; /* Full height */
        }
        .topbar {
            background-color: #8A2BE2; /* BlueViolet color */
            padding: 10px;
            display: flex; /* Flexbox for alignment */
            justify-content: space-between; /* Space between elements */
            align-items: center; /* Center vertically */
            position: relative;
            z-index: 1; /* Ensures the top bar stays above other elements */
        }
        .home-link {
            color: white; /* Default color */
            text-decoration: none;
            font-size: 24px;
            transition: color 0.3s; /* Smooth transition */
        }
        .home-link:hover {
            color: black; /* Color on hover */
        }
        .header {
            color: white;
            font-size: 32px; /* Adjusted size for better fit */
            font-family: 'Arial Black', sans-serif; /* Cool font style */
            margin: 0; /* Remove margin for better alignment */
        }
        .game-box {
            border: 2px solid #8A2BE2; /* BlueViolet neon border */
            padding: 20px; /* Space around the content */
            text-align: center; /* Center content */
            margin: 540px 175px; /* Move down and set left margin */
            width: 300px; /* Set width for the box */
            transition: border-color 0.3s; /* Smooth transition for hover effect */
            border-radius: 5px; /* Rounded corners */
            z-index: 1;
        }
        .game-box:hover {
            border-color: black; /* Black border on hover */
        }
        .play-button {
            display: block;
            margin: 20px auto;
            padding: 8px 16px; /* Smaller padding for a more compact button */
            background-color: #8A2BE2; /* BlueViolet color */
            color: white; /* Text color */
            border: 2px solid white; /* White neon border */
            text-align: center;
            font-size: 16px; /* Font size */
            text-decoration: none;
            border-radius: 5px; /* Rounded corners */
            transition: all 0.3s; /* Smooth transition */
            z-index: 1; /* Keeps the button above the background */
        }
        .play-button:hover {
            border-color: black; /* Black border on hover */
            color: black; /* Text color on hover */
        }
        .mute-button {
            font-size: 36px;
            position: absolute;
            bottom: 15px;
            right: 15px;
            cursor: pointer;
            z-index: 2;
        }
        #game-frame {
            display: none; /* Hidden initially */
            position: absolute;
            top: 58px; /* Just below the top bar */
            left: 0;
            width: 100%;
            height: calc(100vh - 50px); /* Full height minus top bar */
            border: none; /* No border */
            z-index: 2; /* Above other elements */
        }
        /* Full-screen pre-launch overlay */
        .launch-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: black;
            z-index: 9999; /* On top of everything */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .launch-button {
            padding: 20px 40px;
            font-size: 24px;
            background-color: #8A2BE2;
            color: white;
            border: 2px solid white;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .launch-button:hover {
            background-color: black;
            border-color: #8A2BE2;
            color: #8A2BE2;
        }
    </style>
</head>
<body>
    <!-- Pre-launch full screen -->
    <div id="launch-screen" class="launch-screen">
        <button class="launch-button" onclick="launchSite()">Launch Endless Zombies</button>
    </div>

    <div class="topbar">
        <a href="index.php" class="home-link">Home</a>
        <div class="header">Endless Zombies</div>
    </div>

    <div class="game-box">
        <a href="#" class="play-button" onclick="openGame()">Play Endless Zombies</a>
    </div>

    <!-- Mute/Unmute button -->
    <div id="mute-button" class="mute-button" onclick="toggleMute()">🔇</div>

    <iframe id="game-frame" src="" frameborder="0"></iframe>

    <!-- Audio element for background music -->
    <audio id="background-music" src="Images/Green Run.mp3" loop></audio>

    <script>
        var audio = document.getElementById('background-music');
        var muteButton = document.getElementById('mute-button');
        var isMuted = true; // Initially, it's muted

        // Function to toggle mute/unmute
        function toggleMute() {
            if (isMuted) {
                audio.play();
                muteButton.innerHTML = '🔊'; // Change to unmute emoji
                isMuted = false;
            } else {
                audio.pause();
                muteButton.innerHTML = '🔇'; // Change to mute emoji
                isMuted = true;
            }
        }

        // Function to open the game
        function openGame() {
            var frame = document.getElementById('game-frame');
            frame.style.display = 'block'; // Show the iframe
            frame.src = 'https://nzp.gay/'; // Set the iframe source
            
            // Stop the background music when the game starts
            audio.pause();
        }

        // Function to launch the site and play music
        function launchSite() {
            var launchScreen = document.getElementById('launch-screen');
            launchScreen.style.display = 'none'; // Hide the launch screen
            audio.play(); // Start the background music
            isMuted = false;
            muteButton.innerHTML = '🔊'; // Update the mute button to show it's unmuted
        }
    </script>

</body>
</html>
