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
  <title>Responsive Image Manipulator with Cartoon Effects</title>    <script src="../html_is_public_already_retard.js"></script>

  <style>
    /* Basic Layout and Styles */
    body {
      font-family: 'Arial', sans-serif;
      background: linear-gradient(to right, #1e1e1e, blueviolet);
      color: #fff;
      margin: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 0 20px;
      flex-direction: column;
    }

    /* Topbar Styles */
    #topbar {
      width: 100%;
      background-color: rgb(30, 30, 30);
      padding: 20px 0;
      text-align: center;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 10;
    }

    #topbar h1 {
      font-size: 2.5rem;
      font-weight: bold;
      background: linear-gradient(to right, white, blueviolet);
      -webkit-background-clip: text;
      color: transparent;
      margin: 0;
    }

    /* Main Layout */
    #container {
      display: flex;
      gap: 40px;
      max-width: 1200px;
      width: 100%;
      justify-content: space-between;
      align-items: flex-start;
      flex-wrap: wrap;
      margin-top: 100px; /* To avoid overlap with topbar */
    }

    /* Left Section: Image Preview */
    #drop-zone {
      width: 100%;
      max-width: 400px;
      height: 300px;
      border: 2px dashed #8a2be2;
      border-radius: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      color: #fff;
      transition: all 0.3s ease;
      text-align: center;
      background-color: rgba(0, 0, 0, 0.4);
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }

    #drop-zone:hover {
      border-color: white;
      background-color: rgba(0, 0, 0, 0.6);
      box-shadow: 0 0 25px rgba(255, 255, 255, 0.6);
    }

    #image-preview {
      max-width: 100%;
      max-height: 400px;
      display: none;
      margin-top: 20px;
      cursor: crosshair;
      border-radius: 10px;
      transition: transform 0.3s ease;
    }

    #image-preview:hover {
      transform: scale(1.05);
    }

    /* Right Section: Controls */
    .controls {
      flex: 1;
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: space-between;
      max-width: 400px;
    }

    .control-group {
      width: 100%;
    }

    label {
      font-size: 1.1rem;
      font-weight: bold;
      margin-bottom: 8px;
      display: block;
      text-transform: uppercase;
    }

    button, input[type="range"], input[type="checkbox"] {
      padding: 12px;
      border: none;
      border-radius: 12px;
      background: blueviolet;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s, color 0.3s, box-shadow 0.3s;
      width: 100%;
    }

    button:hover, input[type="range"]:hover, input[type="checkbox"]:hover {
      background: white;
      color: blueviolet;
      box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
    }

    input[type="range"] {
      width: 100%;
      margin-top: 10px;
      -webkit-appearance: none;
      background: #1e1e1e; /* Dark background for the track */
      height: 10px;
      border-radius: 5px;
      outline: none;
      transition: all 0.3s ease;
      box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.4);
    }

    /* Customizing slider thumb and track */
    input[type="range"]::-webkit-slider-runnable-track {
      background: #1e1e1e; /* Dark background for the track */
      border-radius: 5px;
      height: 10px;
    }

    input[type="range"]::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      background: blueviolet; /* Thumb color */
      width: 20px;
      height: 20px;
      border-radius: 50%;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    input[type="range"]::-webkit-slider-thumb:hover {
      background: #7a2bb2; /* Darker blueviolet when hovering */
    }

    /* Additional slider styling for Firefox */
    input[type="range"]::-moz-range-track {
      background: #1e1e1e; /* Dark background for the track */
      border-radius: 5px;
      height: 10px;
    }

    input[type="range"]::-moz-range-thumb {
      background: blueviolet; /* Thumb color */
      width: 20px;
      height: 20px;
      border-radius: 50%;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    input[type="range"]::-moz-range-thumb:hover {
      background: #7a2bb2; /* Darker blueviolet when hovering */
    }

    .checkbox-wrapper {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 10px;
    }

  </style>
</head>
<body>

<!-- Topbar Section -->
<div id="topbar">
  <h1>Endless GFX Editor</h1>
</div>

<!-- Main Content Section -->
<div id="container">
  <!-- Left Section: Image Preview -->
  <div>
    <h1>Image Manipulator</h1>
    <div id="drop-zone">Drop an image here or click to select</div>
    <img id="image-preview" src="#" alt="Preview">
  </div>

  <!-- Right Section: Controls -->
  <div class="controls">
    <div class="control-group">
      <label for="opacity">Opacity</label>
      <input type="range" id="opacity" min="0" max="100" value="100" oninput="updatePreview()">
    </div>

    <div class="control-group">
      <label for="brightness">Brightness</label>
      <input type="range" id="brightness" min="50" max="150" value="100" oninput="updatePreview()">
    </div>

    <div class="control-group">
      <label for="contrast">Contrast</label>
      <input type="range" id="contrast" min="50" max="150" value="100" oninput="updatePreview()">
    </div>

    <div class="control-group">
      <label for="grayscale">Grayscale</label>
      <input type="range" id="grayscale" min="0" max="100" value="0" oninput="updatePreview()">
    </div>

    <div class="control-group">
      <label for="saturation">Saturation</label>
      <input type="range" id="saturation" min="0" max="200" value="100" oninput="updatePreview()">
    </div>

    <div class="control-group">
      <label for="hue">Hue Rotation</label>
      <input type="range" id="hue" min="0" max="360" value="0" oninput="updatePreview()">
    </div>

    <div class="control-group">
      <label for="invert">Invert Colors</label>
      <input type="range" id="invert" min="0" max="100" value="0" oninput="updatePreview()">
    </div>

    <div class="control-group checkbox-wrapper">
      <input type="checkbox" id="cartoon-toggle" onclick="updatePreview()">
      <label for="cartoon-toggle">Enable Cartoon Effect</label>
    </div>

    <div class="control-group">
      <button onclick="downloadImage()">Download Image</button>
    </div>
  </div>
</div>

<script>
  const dropZone = document.getElementById("drop-zone");
  const imagePreview = document.getElementById("image-preview");
  let originalImage = null;

  let opacity = 100;
  let brightness = 100;
  let contrast = 100;
  let grayscale = 0;
  let saturation = 100;
  let hue = 0;
  let invert = 0;
  let cartoon = false;

  dropZone.addEventListener("click", () => {
    const input = document.createElement("input");
    input.type = "file";
    input.accept = "image/*";
    input.addEventListener("change", (event) => handleImageUpload(event));
    input.click();
  });

  dropZone.addEventListener("dragover", (event) => {
    event.preventDefault();
    dropZone.style.backgroundColor = "rgba(255, 255, 255, 0.1)";
  });

  dropZone.addEventListener("dragleave", () => {
    dropZone.style.backgroundColor = "rgba(0, 0, 0, 0.4)";
  });

  dropZone.addEventListener("drop", (event) => {
    event.preventDefault();
    handleImageUpload(event);
  });

  function handleImageUpload(event) {
    const file = event.target.files ? event.target.files[0] : event.dataTransfer.files[0];
    if (file && file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = () => {
        originalImage = new Image();
        originalImage.src = reader.result;
        originalImage.onload = () => {
          imagePreview.src = originalImage.src;
          imagePreview.style.display = "block";
          updatePreview();
        };
      };
      reader.readAsDataURL(file);
    }
  }

  function updatePreview() {
    opacity = document.getElementById("opacity").value;
    brightness = document.getElementById("brightness").value;
    contrast = document.getElementById("contrast").value;
    grayscale = document.getElementById("grayscale").value;
    saturation = document.getElementById("saturation").value;
    hue = document.getElementById("hue").value;
    invert = document.getElementById("invert").value;
    cartoon = document.getElementById("cartoon-toggle").checked;

    if (originalImage) {
      const filter = `opacity(${opacity}%) brightness(${brightness}%) contrast(${contrast}%) grayscale(${grayscale}%) saturate(${saturation}%) hue-rotate(${hue}deg) invert(${invert}%) ${cartoon ? 'contrast(150%)' : ''}`;
      imagePreview.style.filter = filter;
    }
  }

  function downloadImage() {
    if (!originalImage) return;

    const canvas = document.createElement("canvas");
    const ctx = canvas.getContext("2d");
    canvas.width = originalImage.width;
    canvas.height = originalImage.height;
    ctx.filter = imagePreview.style.filter;
    ctx.drawImage(originalImage, 0, 0);
    const dataUrl = canvas.toDataURL("image/png");
    const link = document.createElement("a");
    link.href = dataUrl;
    link.download = "image-modified.png";
    link.click();
  }
</script>

</body>
</html>
