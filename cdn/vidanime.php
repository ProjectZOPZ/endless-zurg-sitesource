<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://sentinelaio.net/cdn/vidanime.php?id=2');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'token: SentinelCCfheiowfhowifhow',
    'User-Agent: SentinelClient',
    
]);
$result = curl_exec($ch);
echo $result;
curl_close($ch);
?>
