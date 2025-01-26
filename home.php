
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDASH</title>
    <link rel="icon" href="https://i.imghippo.com/files/GPi7602xQ.PNG" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="detectDevTools_obfus.js"></script>
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(45deg, #8a2be2, #1e1e1e, #000);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            color: #f5f5f5;
            line-height: 1.6;
        }

        /* Gradient Animation */
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* Header Styles (Initially Hidden) */
        header {
            background: rgba(60, 40, 70, 0.8);
            display: none; /* Hidden by default */
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            position: sticky;
            top: 0;
            z-index: 1000;
            flex-wrap: wrap;
            transform: translateY(-100%); /* Starts off-screen */
            transition: transform 0.4s ease-in-out; /* Smooth transition */
        }

        header img {
            max-width: 50px;
        }

        nav {
            display: flex;
            gap: 1.5rem;
        }

        nav a {
            color: #f5f5f5;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #8a2be2;
        }

        /* Hamburger Button */
        .toggle-button {
            position: fixed;
            top: 10px;
            left: 10px;
            font-size: 30px;
            color: white;
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px; /* Space between the icon and text */
        }

        .toggle-button:hover {
            color: blueviolet; /* Change to blueviolet when hovered */
        }

        .toggle-button span {
            font-size: 16px;
        }

        /* Button to Toggle Header (Below Header) */
        .toggle-button.active {
            position: fixed;
            top: calc(100% - 50px); /* Moves the button below the header */
            left: 10px;
            transition: top 0.4s ease-in-out;
        }

        /* Welcome Section */
        .welcome-text {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 600;
            margin: 2rem 0;
            background-image: linear-gradient(to right, #8a2be2, #fff, #000);
            -webkit-background-clip: text;
            color: transparent;
            animation: neon-flash 2s infinite;
        }

        @keyframes neon-flash {
            0%, 100% {
                color: #8a2be2;
            }
            50% {
                color: #fff;
            }
        }

        /* Content Section */
        .content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .content section {
            background: rgba(30, 30, 30, 0.8);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(138, 43, 226, 0.5);
            padding: 1.5rem;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .content section:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.5);
        }

        .content h2 {
            margin-top: 0;
            font-weight: 600;
            color: #8a2be2;
        }

        /* Footer Styles */
        footer {
            background: rgba(30, 30, 30, 0.9);
            text-align: center;
            padding: 1rem 0;
            color: #aaa;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Toggle Button -->
    <button class="toggle-button" onclick="toggleHeader()">
        ☰ <span id="buttonText">Login</span>
    </button>

    <header>
        <img src="https://i.imghippo.com/files/GPi7602xQ.PNG" alt="Endless Logo">
        <nav>
            <a href="endlesszombies.php">Endless Bo1 Zombies</a>
            <a href="endlessinvader.php">Endless Invader</a>
            <a href="/">Shitstar-Leaks</a>
            <a href="/">Com-Marketplace</a>
            <a href="/">Home</a>
            <a href="./login/">Login</a>
            <a href="https://www.instagram.com/endlessnochill/">Purchase</a>
        </nav>
    </header>

    <div class="welcome-text">Welcome to Endless</div>

    <div class="content">
        <section>
            <h2>CODM ENDLESS MENU</h2>
            <p>Improve your Call of Duty Mobile gameplay with the CODM Endless Menu, designed to provide enhanced visibility, performance improvements, and additional game customization options for a more enjoyable and streamlined experience.(IPA/APK COMING SOON!)</p>
        </section>
        <section>
            <h2>SHITSTAR-LEAKS</h2>
            <p>a platform coming soon for people to share and see the latest leaks for GTA 5 And RDR 2 Workarounds for the community!</p>
        </section>        
        <section>
            <h2>COM-MARKETPLACE</h2>
            <p>Com-Marketplace: A premium platform like Amazon coming soon to you, offering exclusive tools, apps, VPNs, accounts, network tools, and more—provided by verified sellers for the community!</p>
        </section>
        <section>
            <h2>NETWORK ANALYZER</h2>
            <p>Our sniffer stands out by providing advanced tools for network diagnostics and IP identification, ensuring smooth operation and accurate results.</p>
        </section>
        <section>
            <h2>XBOX UTILITIES</h2>
            <p>Experience seamless gaming with features like stable session management, group access controls, enhanced party interactions, and advanced moderation utilities.</p>
        </section>
        <section>
            <h2>NETWORK CONTROL</h2>
            <p>Our network control tool allows users to optimize their gaming experience by managing network parameters and reducing latency dynamically.</p>
        </section>
    </div>

    <footer>
        &copy; 2024 Endless Products. All Rights Reserved.
    </footer>

    <script>
        function toggleHeader() {
            const header = document.querySelector('header');
            const button = document.querySelector('.toggle-button');
            const buttonText = document.getElementById('buttonText');
            
            // Hide the text "Press Me!" after button is pressed
            buttonText.style.display = 'none';

            // Toggle header visibility
            if (header.style.display === 'none' || header.style.display === '') {
                header.style.display = 'flex'; // Show the header
                header.style.transform = 'translateY(0)'; // Slide down the header
                button.classList.add('active'); // Move button down
            } else {
                header.style.transform = 'translateY(-100%)'; // Slide up the header
                setTimeout(() => {
                    header.style.display = 'none'; // Hide header after transition
                }, 400); // Match with transition time
                button.classList.remove('active'); // Move button back up
            }
        }
    </script>
</body>
</html>
