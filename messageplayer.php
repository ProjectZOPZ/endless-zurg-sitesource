


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
    <title>Endless Products</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg, black, indigo);
            background-size: 200% 200%;
            animation: gradient 10s ease infinite;
            color: #ffffff; /* Default text color as neon white */
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

        p {
            color: #ffffff; /* Neon white for paragraph text */
            text-align: center;
            margin: 20px auto;
            width: 80%;
        }

        .pulsing-text {
            text-align: center;
            color: BlueViolet;
            font-weight: bold;
            font-size: 18px;
            animation: pulse 2s infinite;
            margin-top: 20px;
        }

        @keyframes pulse {
            0% { color: BlueViolet; }
            50% { color: white; }
            100% { color: BlueViolet; }
        }

        .input-box {
            width: 50%; /* Adjust width for a centered box */
            margin: 10px auto;
            padding: 10px;
            border: 2px solid BlueViolet;
            border-radius: 5px;
            background-color: transparent;
            color: #ffffff; /* Neon white text in the input box */
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s;
            display: block; /* Center it by block display */
        }

        .input-box:hover {
            border-color: #ffffff; /* Neon white border on hover */
        }

        .message-box {
            height: 100px; /* Thicker message box */
        }

        .button-container {
            text-align: center;
            margin: 20px auto;
        }

        .button {
            background-color: transparent;
            border: 2px solid BlueViolet; /* Starts as BlueViolet */
            color: #ffffff; /* Neon white for button text */
            padding: 10px 20px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
            margin: 10px;
            display: inline-block;
        }

        .button:hover {
            border-color: #ffffff; /* Changes border color to neon white on hover */
            color: #ffffff; /* Keeps button text as neon white */
        }

        .combobox-container {
            position: absolute;
            bottom: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .combobox {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 2px solid BlueViolet;
            color: #ffffff; /* Neon white */
            background-color: transparent;
            transition: border-color 0.3s, color 0.3s;
        }

        .combobox:hover {
            border-color: #ffffff; /* Changes border color to neon white on hover */
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <a href="index.php">Home</a>
    </div>

    <h1>Message Or Spam Player</h1>
    
    <p>Message players even if they’ve blocked you, or take it a step further and spam them with special characters, copy-paste art, and more. Whether it's a simple message or some fun spam, the power is in your hands to communicate effectively, or annoyingly, as needed. Players can't stop you here!</p>

    <div class="pulsing-text">ENTER THE GAMERTAG BELOW</div>

    <!-- Gamertag input -->
    <input id="gtag" class="input-box" type="text" placeholder="Enter a Gamertag...">

    <!-- Message input box (thicker) -->
    <textarea id="mib" class="input-box message-box" placeholder="Enter Message..."></textarea>

    <div class="button-container">
        <button onclick="SendMSG(document.getElementById('gtag').value,document.getElementById('mib').value)"  class="button">Message Player</button>
    </div>

    <div class="combobox-container">
        <select class="combobox" id="themeChanger">
            <option value="">Change Theme Color</option>
            <option value="BlueViolet">BlueViolet</option>
            <option value="Indigo">Indigo</option>
            <option value="Red">Red</option>
            <option value="Green">Green</option>
            <option value="Cyan">Cyan</option>
            <option value="Yellow">Yellow</option>
        </select>

        <select class="combobox" id="textColorChanger">
            <option value="">Change Text Color</option>
            <option value="white">Neon White</option>
            <option value="black">Neon Black</option>
            <option value="BlueViolet">BlueViolet</option>
            <option value="Red">Red</option>
            <option value="Green">Green</option>
            <option value="Cyan">Cyan</option>
            <option value="Yellow">Yellow</option>
        </select>
    </div>

    <script>

        function SendMSG(gt,msg)
        {
            const authToken = localStorage.getItem('authToken');
            const authenticity = "SAIO: t=eyJlbmZE02elgxdS9GQ1VjeHVkWllVV250UExGdFUrVTZ0OHgvZ3RKbWl3RVhKYzkxSy9hZEE3SElYcFdjeHFVNVV1NjVkMDJpMEp1OGJiRlVJY0lPRnljRk0vWkFjbG02eDRTVERFV2dyOHFHME09OjrdJ4ok4yuLoq56NRiVQ5R5";
            let myNotify = new Notify({
                status: "info",
                title: "Message Service",
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
                fetch(`../ENAPI/MessageService.php?token=${authToken}&authenticity=${authenticity}&gt=${encodeURIComponent(gt)}&message=${encodeURIComponent(msg)}`, {
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
                            title: "Message Service",
                            text: "Sent!",
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
                            title: "Message Service",
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





        const themeChanger = document.getElementById('themeChanger');
        const textColorChanger = document.getElementById('textColorChanger');
        const body = document.body;
        const topBar = document.querySelector('.top-bar');
        const allTextElements = document.querySelectorAll('h1, p, .pulsing-text, .button, .input-box, .combobox');

        // Change theme color
        themeChanger.addEventListener('change', function () {
            const selectedTheme = themeChanger.value;
            if (selectedTheme) {
                body.style.background = `linear-gradient(90deg, black, ${selectedTheme})`;
                topBar.style.backgroundColor = selectedTheme;
                document.querySelectorAll('.button, .input-box, .combobox').forEach(element => {
                    element.style.borderColor = selectedTheme;
                });
            }
        });

        // Change text color
        textColorChanger.addEventListener('change', function () {
            const selectedColor = textColorChanger.value;
            if (selectedColor) {
                allTextElements.forEach(element => {
                    element.style.color = selectedColor;
                });
            }
        });
    </script>
</body>
</html>
