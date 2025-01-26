<?php
error_reporting(0); 
include '../includes/keyauth.php';
if (!isset($_POST['username']) || !isset($_POST['password']) && !isset($_GET['code'])) {
    header("Location: ./");
    exit(); 
}

function generateSecretToken() {
    $key = "dr#stocre!!Nic8u!exobuprlguQuhIqefrut4ivoso2Itrot8ivEbrunuDo*Rux"; 
    $time = floor(time() / 300) * 300; 
    return hash_hmac('sha256', $time, $key);
}
$receivedSecret = isset($_GET['secret']) ? $_GET['secret'] : '';
$expectedSecret = generateSecretToken();

if ($receivedSecret === $expectedSecret) {
} else {
    header("Location: ./?error=Oauth Expired, please try again.");
    return;
}


$KeyAuthApp = new KeyAuth\api("Endless Multi Tool","wgB5e4ZSpP");
  $name = "Endless Multi Tool";
  $ownerID = "wgB5e4ZSpP";

if (!isset($_SESSION['sessionid'])) {
	$KeyAuthApp->init();
}
if ($KeyAuthApp->login($_POST['username'], $_POST['password'])) 
{
    
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/encryption.php';

    $filename = $_SERVER['DOCUMENT_ROOT'] . '/includes/encryption.php';
    if (file_exists($filename)) {
    } else {
        header("Location: ./?error=error with server.");
        return;
    }
    $authGen = GenerateAPIkey();
    header("Location: ./?code=".$authGen);
    return;
}
else{
    header("Location: ./?error=Invalid Login Details!");
    exit();
}
?>