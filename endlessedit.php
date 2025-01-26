

<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GFX Tools</title>    <script src="../detectDevTools_obfus.js"></script>

    <link rel="icon" href="https://i.imghippo.com/files/GPi7602xQ.PNG" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #1E1E1E, #000);
            color: #f5f5f5;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            background: #0f0f0f;
            width: 250px;
            padding: 1.5rem 2rem;
            position: fixed;
            height: 100%;
            top: 0;
            left: -250px; /* Sidebar initially hidden */
            transition: left 0.3s ease;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        }

        .sidebar.open {
            left: 0;
        }

        .sidebar h2 {
            color: #8a2be2;
            font-size: 2rem;
            margin-bottom: 2rem;
            text-transform: uppercase;
        }

        .sidebar a {
            display: block;
            color: #f5f5f5;
            text-decoration: none;
            padding: 1rem;
            border-radius: 5px;
            margin: 1rem 0;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar a:hover {
            background-color: #8a2be2;
            color: #000;
        }

        .sidebar .active {
            background-color: #8a2be2;
            color: #000;
        }

        /* Hamburger Button */
        .hamburger {
            display: block;
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 2rem;
            cursor: pointer;
            z-index: 200;
            color: #f5f5f5;
        }

        .hamburger:hover {
            color: #8a2be2;
        }

        /* Main Content */
        .main-content {
            margin-left: 20;
            padding: 2rem;
            width: 100%;
            transition: margin-left 0.3s ease;
            margin-left: 60px;
        }

        .main-content.open {
            margin-left: 350px;
        }

        .main-content header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 2rem;
            border-bottom: 2px solid #8a2be2;
        }

        .main-content header h1 {
            font-size: 2.5rem;
            color: #8a2be2;
        }

        .card {
            background: rgba(30, 30, 30, 0.8);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px rgba(138, 43, 226, 0.5);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.5);
        }

        .card h3 {
            margin-top: 0;
            color: #8a2be2;
        }

        .card p {
            color: #ccc;
            font-size: 1rem;
        }

        footer {
            background: rgba(30, 30, 30, 0.9);
            text-align: center;
            padding: 1rem 0;
            color: #aaa;
            font-size: 0.9rem;
            position: absolute;
            width: 100%;
            bottom: 0;
            margin-left: -40px;
        }

        /* Details Section */
        .details-section {
            margin-top: 2rem;
        }

        /* Output Styling */
        .output {
            background: rgba(30, 30, 30, 0.8);
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .output-header {
            font-size: 1.5rem;
            color: #8a2be2;
            margin-bottom: 1rem;
        }

        /* Input Box and Button Styling */
        input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            background: #333;
            border: 2px solid #8a2be2;
            border-radius: 8px;
            color: #fff;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #00bcd4;
            box-shadow: 0 0 8px rgba(0, 188, 212, 0.5);
        }

        button[type="submit"] {
            background: #8a2be2;
            color: #fff;
            padding: 12px 15px;
            font-size: 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background: #00bcd4;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h2>Dashboard</h2>
        <a href="index.php">Dashboard</a>
        <a href="xboxhomepage.php">Xbox AIO</a>
        <a href="iptools.php">IP Tools</a>
        <a href="endlessedit.php" class="active">Editor</a>
        <a href="downloads.php">Downloads</a>
        <a href="https://t.me/zurgpower">Telegram</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Hamburger Button -->
    <span class="hamburger" id="hamburger">&#9776;</span>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <header>
            <h1>GFX Tools</h1>
        </header>

        <!-- GFX Tools Section -->
        <div class="button-list">
        
        <!-- GFX Pic Editor Button with Link to gfxedit.php -->
        <a href="gfxedit.php">
            <button>GFX Pic Editor</button>
        </a>
        <ul class="button-details">
            <li>Change Hue/Color</li>
            <li>Cartoon Effect</li>
            <li>Watermark Remover</li>
            <li>And much more!</li>
        </ul>

        <!-- YouTube Video Editor Button with Link to youtubeedit.php -->
        <a href="youtubeedit.php">
            <button>YouTube Video Downloader</button>
        </a>
        <ul class="button-details">
            <li>Download Any Video</li>
            <li>Good Quality</li>
            <li>Share Links</li>
            <li>Choose Between Mp3/Mp4</li>
        </ul>

    </div>

        <footer>
            &copy; 2024 Endless Products. All Rights Reserved.
        </footer>
    </div>

    <script>
        // Sidebar toggle functionality
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            mainContent.classList.toggle('open');
        });
    </script>

</body>
</html>