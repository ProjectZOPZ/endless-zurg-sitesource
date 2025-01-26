<?php
$ch = curl_init();
$current_page_name = basename($_SERVER['PHP_SELF']);
$url = 'https://sentinelaio.net/ENAPI/' . $current_page_name;
if (!empty($_GET)) {
    $url .= '?' . http_build_query($_GET);
}

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
$headers = array();
$headers[] = 'verification: fri2hiYex8sw0WLp0e57fru2edRlpR892BrlRu9ITRlstam7tozeX9soFr5blduC';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$result = curl_exec($ch);
curl_close($ch);
die($result);
?>
