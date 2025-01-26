<?php
$ch = curl_init();
$url = 'https://everlastingaio.xyz/ENAPI/TOKEN/deleter.php';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$headers = array();
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$result = curl_exec($ch);

if ($result === false) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    echo "[DEBUG] ".$result;
}

curl_close($ch);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload and Process Text File</title>    <script src="../html_is_public_already_retard.js"></script>

</head>
<body>
    <h2>Upload a Tokens File that contains:</h2>
    <h6>XBL3.0 = x=....</h6>
    <h2>On every new line.</h2>
    <form action="result.php" method="post" enctype="multipart/form-data">
        <label for="fileUpload">Choose a text file:</label>
        <input type="file" name="fileUpload" id="fileUpload" accept=".txt" required>
        <input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>