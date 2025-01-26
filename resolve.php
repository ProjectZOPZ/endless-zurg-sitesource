


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Endless Products offers a range of tools and services including VPNs, Xbox tools, sniffers, stressers, and more. Explore our solutions for enhanced security and performance.">
    <meta property="og:title" content="Endless Products">
    <meta property="og:description" content="Explore our range of tools and services including VPNs, Xbox tools, sniffers, and more.">
    <meta property="og:url" content="https://everlastingaio.xyz/">
    <link rel="stylesheet" href="../notify.css" />    <script src="../detectDevTools_obfus.js"></script>


    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
    <title>Resolver</title>
    <style>
        /* Background Animation */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(270deg, black, indigo);
            background-size: 400% 400%;
            animation: gradientBackground 15s ease infinite;
            color: white;
        }

        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Top Bar */
        .top-bar {
            width: 100%;
            background-color: BlueViolet;
            padding: 15px;
            position: fixed;
            top: 0;
            z-index: 100;
            transition: background-color 0.3s ease;
        }

        /* Home Button */
        .top-bar a {
            color: white;
            font-size: 20px;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
            text-transform: uppercase;
            transition: color 0.3s ease;
        }

        .top-bar a:hover {
            color: black;
        }

        /* Title/Header */
        .header {
            margin-top: 80px;
            text-align: center;
            font-size: 36px;
            text-shadow: 0px 0px 5px white;
        }

        /* Paragraph */
        .paragraph {
            text-align: center;
            font-size: 18px;
            max-width: 800px;
            margin: 20px auto;
            line-height: 1.6;
            color: white; /* Default color */
        }

        /* Notice Text */
        .notice {
            color: BlueViolet;
            font-size: 20px;
            text-align: center;
            margin-top: 20px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { text-shadow: 0 0 5px BlueViolet; }
            50% { text-shadow: 0 0 20px white; }
            100% { text-shadow: 0 0 5px BlueViolet; }
        }

        /* Textbox */
        .textbox {
            display: block;
            margin: 20px auto;
            padding: 10px;
            font-size: 16px;
            width: 60%;
            border: 2px solid BlueViolet;
            background-color: transparent;
            color: white;
            transition: all 0.3s ease;
        }

        .textbox:hover {
            border-color: white;
        }

        /* Button */
        .resolve-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 18px;
            background-color: transparent;
            border: 2px solid BlueViolet;
            color: white;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .resolve-button:hover {
            border-color: white;
        }

        /* Theme/Color Selector */
        .theme-changer {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px;
            background-color: BlueViolet;
            border: 2px solid white;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        /* Text color combobox */
        #textSelector {
            bottom: 60px;
        }
    </style>
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar" id="topBar">
        <a href="index.php">Home</a>
    </div>

    <!-- Title/Header -->
    <div class="header">
        Welcome To Endless Gamertag Resolver
    </div>

    <!-- Explanation Paragraph -->
    <div class="paragraph" id="paragraphText">
        Welcome to the legendary Endless Gamertag Resolver, an option of the tool designed to ensure the Victim you are looking for is in our Database. Making your life easier one option at a time!!!
    </div>

    <!-- Notice Text (Without Box) -->
    <div class="notice" id="noticeText">
        Note not all victims have been captured yet but will be, thanks to Sentinels SpyGlass AI!
    </div>

    <!-- Textbox for Gamertag -->
    <input type="text" class="textbox" id="gamertagInput" placeholder="Enter Gamertag">

    <!-- resolve Player Button -->
    <button  onclick="resolve(document.getElementById('gamertagInput').value)" class="resolve-button" id="banButton">Resolve Gamertag</button>

    <!-- Theme/Color Selectors -->
    <select id="colorSelector" class="theme-changer">
        <option value="default">Default</option>
        <option value="neon">Neon Theme</option>
        <option value="dark">Dark Theme</option>
        <option value="red">Red Theme</option>
        <option value="green">Green Theme</option>
        <option value="cyan">Cyan Theme</option>
        <option value="purple">Purple Theme</option>
        <option value="pink">Pink Theme</option>
    </select>

    <select id="textSelector" class="theme-changer" style="bottom: 60px;">
        <option value="white">White Text</option>
        <option value="black">Black Text</option>
        <option value="blue">Blue Text</option>
        <option value="red">Red Text</option>
        <option value="green">Green Text</option>
        <option value="cyan">Cyan Text</option>
        <option value="yellow">Yellow Text</option>
        <option value="magenta">Magenta Text</option>
    </select>

    <script>
        // Color Theme Changer
        const colorSelector = document.getElementById('colorSelector');
        const body = document.body;
        const topBar = document.getElementById('topBar');
        const gamertagInput = document.getElementById('gamertagInput');
        const banButton = document.getElementById('banButton');
        const themeChangers = document.querySelectorAll('.theme-changer'); // Target both comboboxes
        
        colorSelector.addEventListener('change', function() {
            const selectedTheme = this.value;
            let borderColor;
            let backgroundColor;

            if (selectedTheme === 'neon') {
                body.style.background = 'linear-gradient(270deg, #000000, #9400D3)';
                topBar.style.backgroundColor = '#9400D3';
                borderColor = '#9400D3';
                backgroundColor = '#000';
            } else if (selectedTheme === 'dark') {
                body.style.background = 'linear-gradient(270deg, #1a1a1a, #4B0082)';
                topBar.style.backgroundColor = '#4B0082';
                borderColor = '#4B0082';
                backgroundColor = '#1a1a1a';
            } else if (selectedTheme === 'red') {
                body.style.background = 'linear-gradient(270deg, black, red)';
                topBar.style.backgroundColor = 'red';
                borderColor = 'red';
                backgroundColor = 'black';
            } else if (selectedTheme === 'green') {
                body.style.background = 'linear-gradient(270deg, black, green)';
                topBar.style.backgroundColor = 'green';
                borderColor = 'green';
                backgroundColor = 'black';
            } else if (selectedTheme === 'cyan') {
                body.style.background = 'linear-gradient(270deg, black, cyan)';
                topBar.style.backgroundColor = 'cyan';
                borderColor = 'cyan';
                backgroundColor = 'black';
            } else if (selectedTheme === 'purple') {
                body.style.background = 'linear-gradient(270deg, black, purple)';
                topBar.style.backgroundColor = 'purple';
                borderColor = 'purple';
                backgroundColor = 'black';
            } else if (selectedTheme === 'pink') {
                body.style.background = 'linear-gradient(270deg, black, pink)';
                topBar.style.backgroundColor = 'pink';
                borderColor = 'pink';
                backgroundColor = 'black';
            } else {
                body.style.background = 'linear-gradient(270deg, black, indigo)';
                topBar.style.backgroundColor = 'BlueViolet';
                borderColor = 'BlueViolet';
                backgroundColor = 'black';
            }

            // Update textbox and button borders with theme color
            gamertagInput.style.borderColor = borderColor;
            banButton.style.borderColor = borderColor;

            // Update comboboxes with selected theme colors
            themeChangers.forEach(combo => {
                combo.style.backgroundColor = backgroundColor;
                combo.style.borderColor = borderColor;
                combo.style.color = borderColor; // Optional if you want the combobox text to change as well
            });
        });

        // Text Color Changer
        const textSelector = document.getElementById('textSelector');
        const noticeText = document.getElementById('noticeText');
        const paragraphText = document.getElementById('paragraphText'); // Newly added

        textSelector.addEventListener('change', function() {
            const selectedTextColor = this.value;
            noticeText.style.color = selectedTextColor;
            paragraphText.style.color = selectedTextColor; // Paragraph text update
            gamertagInput.style.color = selectedTextColor;
            banButton.style.color = selectedTextColor;
            topBar.querySelector('a').style.color = selectedTextColor;

            // Update combobox text colors when text color changes
            themeChangers.forEach(combo => {
                combo.style.color = selectedTextColor;
            });
        });






        function resolve(targetGT) {
            let myNotify = new Notify({
                status: "info",
                title: "Resolving...",
                text: "Searching our database, please wait.",
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
            const authenticity = "SAIO: t=eyJlbmNyt4NzRmTWlHQTVZYWszcW9WUkFXMW9NRTRFM1daTEE2ZENKK3NjdUEzT1l6V1YvQWJhdldBcnFLM0V6OUlEZG5Uek1uZm1MTGNOTkhPNWQwcDVsQ2xhcTFyRjBFUnNsR0FReHc1cTJxT009OjrAEVhcAsCNQr8JM6vD7033";
            
            fetch(`../ENAPI/Resolver.php?token=${authToken}&authenticity=${authenticity}&gt=${targetGT}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                if (myNotify) {
                    myNotify.close();
                }
                if (data.success) {
                    if(data.found)
                    {
                        new Notify({
                            status: "success",
                            title: "Found Results!",
                            text: `IP:<br><b>${data.Ipv4}</b>`,
                            effect: 'fade',
                            speed: 300,
                            showIcon: true,
                            showCloseButton: true,
                            autoclose: false,
                            autotimeout: 3000,
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
                            title: "No Results Found!",
                            text: `we couldnt find any results!`,
                            effect: 'fade',
                            speed: 300,
                            showIcon: true,
                            showCloseButton: true,
                            autoclose: true,
                            autotimeout: 3000,
                            gap: 20,
                            distance: 20,
                            type: 'outline',
                            position: 'right top'
                        });
                    }
                } else {
                    new Notify({
                        status: "error",
                        title: "Failed!",
                        text: "Failed to resolve target!",
                        effect: 'fade',
                        speed: 300,
                        showIcon: true,
                        showCloseButton: true,
                        autoclose: true,
                        autotimeout: 3000,
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



    </script>

</body>
</html>
