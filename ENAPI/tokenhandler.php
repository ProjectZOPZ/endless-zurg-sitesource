<?php
$allowed_domains = ['http://localhost', 'https://everlastingaio.xyz'];

if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowed_domains)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
    header("Access-Control-Allow-Methods: GET");
}

header('Content-Type: application/json');
error_reporting(0); 
$secretKey = 'vu3ofAchodudaylspl0ru8riW7udr0wribabrote9huMub2uprest5j1nonuchuq';
$authToken = $_GET['token'] ?? '';
$authenticity = $_GET['authenticity'] ?? '';

function decrypt($encryptedData, $key) {
    $cipher = "aes-256-cbc";
    list($encrypted, $iv) = explode('::', base64_decode($encryptedData), 2);
    return openssl_decrypt($encrypted, $cipher, $key, 0, $iv);
}

function ValidateAPIkey($apiKey, $secretKey) {
    $encryptedPart = str_replace("SAIO: t=eyJlbm", "", $apiKey);
    $decryptedString = decrypt($encryptedPart, $secretKey);
    
    if (!$decryptedString) {
        return false;
    }
    
    $timestamp = substr($decryptedString, 32, 10);
    return ($timestamp > time());
}
if (!$authToken || !$authenticity) {
    http_response_code(401);
    echo json_encode([ 
        'success' => false, 
        'message' => 'The API is currently unavailable. If this issue persists, please contact support for assistance.', 
        'zopz' => 'skid', 
        'for_zopz' => [ 
            'message' => 'Dear Zopz, avoid skidding as it doesnt lead to any learning. Consider finding something more constructive to do with your life.'
        ], 
        'response_admin_url_base64' => base64_encode('https://everlastingaio.xyz/control/dash.php?secretView=25435312') 
    ]);
    exit;
}

if (!ValidateAPIkey($authenticity, $secretKey)) {
    http_response_code(401);
    echo json_encode([ 
        'success' => false, 
        'message' => 'The API is currently unavailable. If this issue persists, please contact support for assistance.', 
        'zopz' => 'skid', 
        'for_zopz' => [ 
            'message' => 'Dear Zopz, avoid skidding as it doesnt lead to any learning. Consider finding something more constructive to do with your life.'
        ], 
        'response_admin_url_base64' => base64_encode('https://everlastingaio.xyz/control/dash.php?secretView=25435312') 
    ]);
    exit;
}

$link = mysqli_connect("localhost", "everlasting_rot", "yat&SweT4anO_owraP3+", "everlasting_database");

if ($link === false) {
    http_response_code(503);
    echo json_encode([ 
        'success' => false, 
        'message' => 'Database connection failed. Please try again later.' 
    ]);
    return;
}

header('Content-Type: application/json');

$exp = time();
$tokens = [];
$default_limit = 1;

$function = isset($_GET['function']) ? $_GET['function'] : null;
$limit = isset($_GET['limit']) && is_numeric($_GET['limit']) ? intval($_GET['limit']) : $default_limit;
if($limit <= 0){
    $default_limit = 1;
    $limit = 1;
}
if ($function === "getAll") {
    $query = "SELECT `token`, `expires` FROM `tokens` WHERE `expires` > ?";
    if ($limit > 0) {
        $query .= " LIMIT ?";
    }
    $stmt = mysqli_prepare($link, $query);
    if (!$stmt) {
        http_response_code(500);
        echo json_encode([ 
            'success' => false, 
            'message' => 'Internal server error occurred while preparing the request.' 
        ]);
        return;
    }
    if ($limit > 0) {
        mysqli_stmt_bind_param($stmt, "ii", $exp, $limit);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $exp);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        http_response_code(500);
        echo json_encode([ 
            'success' => false, 
            'message' => 'An error occurred while executing the query.' 
        ]);
        return;
    }
    $tokens = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $tokens[] = [
            "token" => $row['token'],
            "expires" => intval($row['expires'])
        ];
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);

    echo json_encode([ 
        'success' => true, 
        "count"=>$limit,
        'tokens' => $tokens 
    ]);
    return;
}else if ($function === "Follow") {
    $_auth_api_token = $_GET['token'];
    if (!$_auth_api_token || empty($_auth_api_token)) {
        http_response_code(401);
        echo json_encode([ 'success' => false, 'message' => 'Invalid Xbox Token', 'zopz' => 'skid', 'for_zopz' => [ 'message' => 'Dear Zopz, avoid skidding as it doesnt lead to any learning. Consider finding something more constructive to do with your life.' ], 'response_admin_url_base64' => base64_encode('https://everlastingaio.xyz/control/dash.php?secretView=25435312') ]);
        exit;
    }
    $user_token = $_auth_api_token;
    if (empty($user_token)) {
        http_response_code(401);
        $response = json_encode(array(
            "success" => false,
            "message" => "No Authorization token was sent to the API. Please make sure you send it as a parameter.",
        ));
        echo $response;
        exit; 
    }
    $leader_xuid = null;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://profile.xboxlive.com/users/me/profile/settings?settings=Gamertag');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
    $headers = array();
    $headers[] = 'Authorization: '.$user_token;
    $headers[] = 'x-xbl-contract-version: 2';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (curl_errno($ch)) {
        $error_message = "Error With API!";
        http_response_code(500);
        $response = json_encode(array(
            "success" => false,
            "message" => $result,
        ));
        die($response);
        return;
    }
    curl_close($ch);
    if ($http_status === 401) {
        http_response_code(401);
        $response = json_encode(array(
            "success" => false,
            "message" => "Xauth is expired or invalid!",
        ));
        echo $response;
        exit;
    }
    if ($http_status !== 200) {
        http_response_code($http_status);
        $response = json_encode(array(
            "success" => false,
            "message" => "API Request Failed with HTTP Status: " . $http_status,
        ));
        die($response);
        return;
    }
    $profileinfo = json_decode($result);
    if (!$profileinfo || !isset($profileinfo->profileUsers) || empty($profileinfo->profileUsers)) {
        http_response_code(500);
        $response = json_encode(array(
            "success" => false,
            "message" => "Failed to retrieve profile information.",
        ));
        die($response);
        return;
    }
    $xuidme = $profileinfo->profileUsers[0]->id;
    if (empty($xuidme)) {
        http_response_code(401);
        $response = json_encode(array(
            "success" => false,
            "message" => "Xauth is expired or invalid!",
        ));
        die($response);
        return;
    }
    
   


    if (empty($xuidme) || empty($user_token)) {
        die(json_encode([
            "success" => false,
            "message" => "Missing required parameters: xuidme or user_token.",
        ]));
    }
    if (empty($xuidme) || empty($user_token)) {
        die(json_encode([
            "success" => false,
            "message" => "Missing required parameters: xuidme or user_token.",
        ]));
    }
    $tar = isset($_GET['target']) ? $_GET['target'] : null;
    if (empty($tar)) {
        die(json_encode([
            "success" => false,
            "message" => "Target parameter is required.",
        ]));
    }
    $ch = curl_init();
    $url = 'https://peoplehub.xboxlive.com/users/xuid(' . $xuidme . ')/people/search/decoration/detail?q=' . urlencode($tar) . '&maxitems=1';
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
    $headers = [
        'Accept: application/json',
        'Accept-Language: en-US, en-GB',
        'Authorization: ' . $user_token,
        'Content-Type: application/json; charset=utf-8',
        'X-Xbl-Contract-Version: 7',
        'User-Agent: XboxGameBarWidgets/2411.1001.6.0',
        'Signature: AAAAAQHbOHYwRKdT/rEjG6Ra2p0N0y8oFnOP2BETjJ8nwjKbr95l33XQawVwW9lGtYA3hpcizE64qWqU0ObyUlUvp10e6hnxOt45qA==',
        'MS-CV: QLbZ5hEFtfPen1/O',
        'Accept-Encoding: gzip, deflate, br',
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (curl_errno($ch)) {
        die(json_encode([
            "success" => false,
            "message" => "cURL error",
        ]));
    }
    curl_close($ch);        
    $data = json_decode($result, true);
    
    function getValue($data, $field, $subfield = null) {
        if ($subfield) {
            return isset($data[$field][$subfield]) && $data[$field][$subfield] !== null ? $data[$field][$subfield] : "N/A";
        }
        return isset($data[$field]) && $data[$field] !== null ? $data[$field] : "N/A";
    }
    
    $userData = isset($data['people'][0]) ? $data['people'][0] : [];
    
    $xuid_to_send = getValue($userData, 'xuid');
    $xuid_to_game = getValue($userData, 'gamertag');
    if (empty($xuid_to_send) || !is_numeric($xuid_to_send)) {
        die(json_encode([
            "success" => false,
            "message" => "Failed to retrieve targets Profile!",
        ]));
    }

    if($tar !== $xuid_to_game){
        die(json_encode([
            "success" => false,
            "message" => "your search needs to match the gamertag exactly!",
        ]));
        return;
    }

    $query = "SELECT `token`, `expires` FROM `tokens` WHERE `expires` > ?";
    if ($limit > 0) {
        $query .= " LIMIT ?";
    }
    $stmt = mysqli_prepare($link, $query);
    if (!$stmt) {
        http_response_code(500);
        echo json_encode([ 
            'success' => false, 
            'message' => 'Internal server error occurred while preparing the request.' 
        ]);
        return;
    }
    if ($limit > 0) {
        mysqli_stmt_bind_param($stmt, "ii", $exp, $limit);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $exp);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        http_response_code(500);
        echo json_encode([ 
            'success' => false, 
            'message' => 'An error occurred while executing the query.' 
        ]);
        return;
    }
    $tokens = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $tokens[] = [
            "token" => $row['token'],
            "expires" => intval($row['expires'])
        ];
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
    
    
    $failed = 0;
    $success = 0;
    $failed_tokens = array();


    foreach ($tokens as $token) {
        $tokenValue = $token['token'];
        $startPos = strpos($tokenValue, 'x=') + 2;
        $endPos = strpos($tokenValue, ';');
        $token_id = "NoIDFound";
    
        if ($startPos !== false && $endPos !== false) {
            $token_id = substr($tokenValue, $startPos, $endPos - $startPos);
        }
    
        if (intval($token['expires']) > time()) {



            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://profile.xboxlive.com/users/me/profile/settings?settings=Gamertag');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
            $headers = array();
            $headers[] = 'Authorization: '.$tokenValue;
            $headers[] = 'x-xbl-contract-version: 2';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            if (!isset($failed_tokens)) {
                $failed_tokens = [];
            }
            $result = curl_exec($ch);            
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
            curl_close($ch);
            if (curl_errno($ch)) {
                $failed += 1;
                $failed_tokens[$token_id] = ['reason' => 'cURL error'];
            } else {
                if ($http_status === 401) {
                    $failed += 1;
                    $failed_tokens[$token_id] = ['reason' => 'Unauthorized, account likely found by microdicks'];
                } elseif ($http_status !== 200) {
                    $failed += 1;
                    $failed_tokens[$token_id] = ['reason' => 'Non-200 status code'];
                } else {
                    $profileinfo = json_decode($result);
                    if (!$profileinfo || !isset($profileinfo->profileUsers) || empty($profileinfo->profileUsers)) {
                        $failed += 1;
                        $failed_tokens[$token_id] = ['reason' => 'Invalid profile data'];
                    } else {
                        $xuid_bot = $profileinfo->profileUsers[0]->id;
                        if (empty($xuid_bot)) {
                            $failed += 1;
                            $failed_tokens[$token_id] = ['reason' => 'Empty XUID'];
                        }
                        else{
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, 'https://social.xboxlive.com/users/xuid('.$xuid_bot.')/people/xuid('.$xuid_to_send.')');
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                            curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
                            $headers = [
                                'Authorization: ' . $tokenValue,
                                'x-xbl-contract-version: 3',
                                'Accept-Encoding: gzip, deflate',
                                'Signature: AAAAAQHbN6DJIf12PvPq8595ukHbSZu/qoOn9Miq1xXUwHk3ogUs7q/aLSaLx68zBtDF7bKzKb0OF5IlwimtIBUmmHIsSflb/u4KKg==',
                                'Accept: application/json',
                                'MS-CV: tjxU+cpZ2BStwyJ9',
                                'User-Agent: XboxGameBarWidgets/2411.1001.5.0',
                                'Accept-Language: en-US, en-GB',
                                'Cache-Control: no-cache',
                                'Content-Length: 0'
                            ];
                    
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    
                            $result = curl_exec($ch);
                            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                            if (curl_errno($ch)) {
                                $failed += 1;
                                $failed_tokens[$token_id] = ['reason' => 'cURL error'];
                            } else {
                                if ($http_status === 401) {
                                    $failed += 1;
                                    $failed_tokens[$token_id] = ['reason' => 'Unauthorized, account likely found by microdicks'];
                                } elseif ($http_status !== 204) {
                                    $failed += 1;
                                    $failed_tokens[$token_id] = ['reason' => 'Failed to send'];
                                } else {
                                    $success += 1;
                                }
                            }                    
                            curl_close($ch);
                        }
                    }
                }
            }
        }
    }
    
    http_response_code(200);
    if (empty($failed_tokens)) {
        $failed_tokens = ["None"];
    }
    
    echo json_encode([
		'success' => true,
		'message' => 'Sent All!      Succeeded: ' . $success . ' | Failed: ' . $failed,
		'successes' => $success,
		'failed' => $failed,
		'f_reasons' => $failed_tokens,
		'targetGT' => $xuid_to_game
	]);
	return;


}
else {
    http_response_code(400);
    echo json_encode([ 
        'success' => false, 
        'message' => 'Invalid function provided. Please check your request parameters.' 
    ]);
    mysqli_close($link);
    return;
}

?>
