
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endless Invader</title>
    <script src="detectDevTools_obfus.js"></script>

    <style>
        body {
            margin: 0;
            background-color: rgb(20, 20, 20);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            color: white;
            overflow: hidden;
        }

        #game-container {
    position: relative;
    width: 90vw; /* Use 90% of the viewport width */
    height: 50vh; /* Use 70% of the viewport height */
    max-width: 1000px; /* Maximum width to prevent it from getting too large */
    max-height: 800px; /* Maximum height for larger screens */
    background-color: rgb(30, 30, 30);
    border: 5px solid blueviolet;
    overflow: hidden;
    box-shadow: 0 0 20px blueviolet;
    display: flex;
    justify-content: center;
    align-items: center;
        }

        #topbar {
            width: 100%;
            background-color: rgb(30, 30, 30);
            padding: 20px 0;
            text-align: center;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 20px; /* For the 'Back to Home' link */
            padding-right: 20px; /* For the 'Back to Home' link */
        }

        #topbar h1 {
            font-size: 2.5rem;
            font-weight: bold;
            background: linear-gradient(to right, white, blueviolet);
            -webkit-background-clip: text;
            color: transparent;
            margin: 0;
            text-align: center;
            flex-grow: 1;
            transform: translateX(-100px);
        }

        #back-to-home {
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        #back-to-home:hover {
            color: blueviolet;
        }

        canvas {
            display: block;
    width: 100%; /* Full width of the container */
    height: 100%; /* Full height of the container */
    object-fit: cover;
        }

        #restart-message {
    position: absolute;
    top: 60%; /* Position just below the game over text */
    left: 50%;
    transform: translateX(-50%);
    font-size: 20px;
    color: white;
    display: none; /* Hidden by default */
    text-shadow: 0 0 10px blueviolet;
}

        #game-over {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 48px;
            color: white;
            display: none;
            text-shadow: 0 0 10px blueviolet;
        }

        #lives {
            position: absolute;
            bottom: 10px;
            left: 10px;
            font-size: 24px;
        }

        #score {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 24px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div id="topbar">
        <a id="back-to-home" href="index.php">Back To Home</a>
        <h1>Endless Invader</h1>
    </div>

    <div id="game-container">
        <canvas id="gameCanvas"></canvas>
        <div id="lives">💜💜💜</div>
        <div id="game-over">GAME OVER!</div>
        <div id="restart-message">Press R To Restart or Reload Page</div>
        <div id="score">🏆Score: 0</div> <!-- Score Display -->
    </div>

    <script>
        const canvas = document.getElementById("gameCanvas");
        const ctx = canvas.getContext("2d");
        const container = document.getElementById("game-container");
        const gameOverText = document.getElementById("game-over");
        const scoreDisplay = document.getElementById("score"); // Score element
        canvas.width = container.clientWidth;
        canvas.height = container.clientHeight;

        let player = {
            x: canvas.width / 2 - 60,
            y: canvas.height - 120,
            width: 120,
            height: 120,
            image: new Image(),
            bullets: [],
            hitRadius: 40,
        };
        player.image.src = "https://i.imghippo.com/files/jrxK7836zNs.PNG";

        let enemies = [];
        let stars = [];
        let lives = 3;
        let score = 0; // Initial score

        const enemyImages = [
            "https://i.imghippo.com/files/wcHW2195RY.png",
            "https://i.imghippo.com/files/RAI3713h.png",
        ];

        function createStars() {
            for (let i = 0; i < 100; i++) {
                stars.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    size: Math.random() * 2 + 1,
                    speed: Math.random() * 1 + 0.5,
                });
            }
        }

        function drawStars() {
            ctx.fillStyle = "white";
            stars.forEach((star) => {
                ctx.beginPath();
                ctx.arc(star.x, star.y, star.size, 0, Math.PI * 2);
                ctx.fill();
                star.y += star.speed;
                if (star.y > canvas.height) star.y = 0;
            });
        }

        function spawnEnemies() {
            setInterval(() => {
                let img = new Image();
                img.src = enemyImages[Math.floor(Math.random() * enemyImages.length)];
                enemies.push({
                    x: Math.random() * (canvas.width - 100),
                    y: -100,
                    width: 120,
                    height: 120,
                    image: img,
                    speed: Math.random() * 2 + 1,
                });
            }, 1000);
        }

        function drawEnemies() {
            enemies.forEach((enemy, index) => {
                ctx.drawImage(enemy.image, enemy.x, enemy.y, enemy.width, enemy.height);
                enemy.y += enemy.speed;

                let distance = Math.sqrt(
                    Math.pow(player.x + player.width / 2 - (enemy.x + enemy.width / 2), 2) +
                    Math.pow(player.y + player.height / 2 - (enemy.y + enemy.height / 2), 2)
                );

                if (distance < player.hitRadius + Math.min(enemy.width, enemy.height) / 2) {
                    enemies.splice(index, 1);
                    lives--;
                }

                player.bullets.forEach((bullet, bulletIndex) => {
                    if (
                        bullet.x < enemy.x + enemy.width &&
                        bullet.x + bullet.width > enemy.x &&
                        bullet.y < enemy.y + enemy.height &&
                        bullet.y + bullet.height > enemy.y
                    ) {
                        enemies.splice(index, 1);
                        player.bullets.splice(bulletIndex, 1);
                        score++; // Increment score when an enemy is hit
                        scoreDisplay.textContent = `🏆Score: ${score}`; // Update score display
                    }
                });
            });
        }

        function drawPlayer() {
            ctx.drawImage(player.image, player.x, player.y, player.width, player.height);
        }

        function shootBullet() {
            player.bullets.push({
                x: player.x + player.width / 2 - 5,
                y: player.y,
                width: 5,
                height: 15,
                speed: 5,
            });
        }

        function drawBullets() {
            ctx.fillStyle = "blueviolet";
            player.bullets.forEach((bullet, index) => {
                ctx.fillRect(bullet.x, bullet.y, bullet.width, bullet.height);
                bullet.y -= bullet.speed;

                if (bullet.y < 0) player.bullets.splice(index, 1);
            });
        }

        function updateLives() {
            document.getElementById("lives").textContent = "💜".repeat(lives);
            if (lives <= 0) {
                gameOver();
            }
        }

        function gameOver() {
    gameOverText.style.display = "block";
    document.getElementById("restart-message").style.display = "block";  // Show restart message
    cancelAnimationFrame(animationId);
}

// Restart the game when the "R" key is pressed
document.addEventListener("keydown", (e) => {
    if (e.key === "r" || e.key === "R") {
        restartGame();
    }
});

function restartGame() {
    lives = 3;
    enemies = [];
    stars = [];
    player.x = canvas.width / 2 - 60;
    player.y = canvas.height - 120;
    player.bullets = [];
    document.getElementById("restart-message").style.display = "none";  // Hide restart message
    gameOverText.style.display = "none";  // Hide game over message
    createStars();
    spawnEnemies();
    animate();
}


        let animationId;
        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            drawStars();
            drawEnemies();
            drawBullets();
            drawPlayer();
            updateLives();
            animationId = requestAnimationFrame(animate);
        }

        // For mobile: touchstart and touchmove to handle horizontal and vertical movement
document.addEventListener("touchstart", (e) => {
    if (e.touches.length > 0) {
        const touchX = e.touches[0].clientX;
        const touchY = e.touches[0].clientY;
        // Move ship to touch position (horizontal and vertical)
        player.x = touchX - player.width / 2;
        player.y = touchY - player.height / 2;

        // Prevent ship from going off-screen horizontally and vertically
        if (player.x < 0) player.x = 0;
        if (player.x > canvas.width - player.width) player.x = canvas.width - player.width;
        if (player.y < 0) player.y = 0;
        if (player.y > canvas.height - player.height) player.y = canvas.height - player.height;
    }
});

document.addEventListener("touchmove", (e) => {
    if (e.touches.length > 0) {
        const touchX = e.touches[0].clientX;
        const touchY = e.touches[0].clientY;
        // Move ship to touch position (horizontal and vertical)
        player.x = touchX - player.width / 2;
        player.y = touchY - player.height / 2;

        // Prevent ship from going off-screen horizontally and vertically
        if (player.x < 0) player.x = 0;
        if (player.x > canvas.width - player.width) player.x = canvas.width - player.width;
        if (player.y < 0) player.y = 0;
        if (player.y > canvas.height - player.height) player.y = canvas.height - player.height;
    }
});

// For PC: keydown event for ship movement
document.addEventListener("keydown", (e) => {
    if (e.key === "ArrowLeft" && player.x > 0) player.x -= 15;
    if (e.key === "ArrowRight" && player.x < canvas.width - player.width) player.x += 15;
    if (e.key === "ArrowUp" && player.y > 0) player.y -= 15;
    if (e.key === "ArrowDown" && player.y < canvas.height - player.height) player.y += 15;
});

        setInterval(() => {
            shootBullet();
        }, 500);

        createStars();
        spawnEnemies();
        animate();
    </script>
</body>
</html>
