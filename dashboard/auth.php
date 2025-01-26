<?php

$scheme = 'https';

$domainName = $scheme . '://' . $_SERVER['HTTP_HOST'];

$url = "";
$url = $domainName."/dashboard/auth.php";



$XBL_TOKEN = null;


$appid = "3a89b200-2661-43ba-b57e-9e4d8c3bb279";
$appsecret = "QF.8Q~lQuofVnPgFp2qcfIbMGKxWSRDSnDMnRcD.";
$apptenant = "f8cdef31-a31e-4b4a-93e4-5f571e91255a";

if (isset($_GET['code']) && !empty($_GET['code'])) {

    $payload = [
        'grant_type' => 'authorization_code',
        'code' => $_GET['code'],
        'client_id' => $appid,
        'client_secret' => $appsecret,
        'redirect_uri' => $url,
        'scope' => 'Xboxlive.signin Xboxlive.offline_access', // 'default' removed
    ];
    $payload_string = http_build_query($payload);
    $discord_token_url = "https://login.microsoftonline.com/consumers/oauth2/v2.0/token";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $discord_token_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1); // Set back to 2 for improved security
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    $result = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if (strpos($result, "The code has expired") !== false) {
        header("Location: ./auth.php");
    }
    else {
        $result = json_decode($result);
        $access_token = $result->access_token;
		$refresh_token = $result->refresh_token;
        $data = [
            'RelyingParty' => 'http://auth.xboxlive.com',
            'TokenType' => 'JWT',
            'Properties' => [
                'AuthMethod' => 'RPS',
                'SiteName' => 'user.auth.xboxlive.com',
                'RpsTicket' => 'd='.$access_token
            ]
        ];

        $headers = [
            'Content-Type: application/json',
            'x-xbl-contract-version: 0'
        ];

        $ch = curl_init('https://user.auth.xboxlive.com/user/authenticate');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);

        $response = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        $response = json_decode($response);

        $to_auth = $response->Token;



            $data = [
                'RelyingParty' => 'http://xboxlive.com',
                'TokenType' => 'JWT',
                'Properties' => [
                    'UserTokens' => [
                        $to_auth
                    ],
                    'SandboxId' => 'RETAIL'
                ]
            ];            
    
            $headers = [
                'Content-Type: application/json',
                'x-xbl-contract-version: 0'
            ];
    
            $ch = curl_init('https://xsts.auth.xboxlive.com/xsts/authorize');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    
            $response = curl_exec($ch);
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            $responseData = json_decode($response, true);

            $text = "enforcement";
            $substringToCheck = $response;
            
            if ($responseData['Redirect'] === "https://start.ui.xboxlive.com/enforcement") {                
                ?>
                <!DOCTYPE html>
                 <html lang="en">
                 
                 <head>
                     <meta charset="UTF-8">
                     <meta name="viewport" content="width=device-width, initial-scale=1.0">
                     <title>Authorization</title>            
                 </head>
                 <style>
                     body {
                         background-color: #121212; /* Dark grey/black background */
                         color: #E0E0E0; /* Light grey text color */
                         font-family: Arial, sans-serif;
                         display: flex;
                         justify-content: center;
                         align-items: center;
                         height: 100vh;
                         margin: 0;
                     }
                     .container {
                         display: flex;
                         flex-wrap: wrap; /* Allows wrapping of items */
                         justify-content: center;
                         align-items: center;
                         width: 80%;
                         max-width: 1000px;
                     }
                     .box {
                         background-color: #1E1E1E;
                         color: #E0E0E0;
                         border-radius: 10px;
                         padding: 20px;
                         text-align: center;
                         width: 420px;
                         height: 190px;
                         align-content: center;
                         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
                         margin: 10px;
                         cursor: pointer;
                         transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
                     }
         
         
                     .box i {
                         font-size: 68px;
                         color: #dfdbff !important; 
                         margin-bottom: 10px;
                         cursor: pointer;
                     }
                     .box p {
                         margin: 0;
                         font-size: 26px;
                         cursor: pointer;            
                         color: #dfdbff !important; 
                     }
         
                     @media (max-width: 600px) {
                         .box {
                             width: 120px;
                             font-size: 14px;
                         }
                         .box i {
                             font-size: 36px;
                         }
                     }
                 </style>
             </head>
         
             <body>
                 <div class="container">
                     <div class="box">
                     <p>Error!<br>your xbox account is banned.</p><br>
                     </div>        
                 </div>         
             </body>
             </html>
         
         
         
         
                 <?php
                return;       
            }


            $xuiArray = $responseData['DisplayClaims']['xui'][0];
            $userHash = $xuiArray['uhs'];
            $token = $responseData['Token'];
            $expires = $responseData['NotAfter'];
            $isoDate = $expires;
            $dateTime = new DateTime($isoDate);
            $expires = $dateTime->getTimestamp();

            $XBL_TOKEN = "XBL3.0 x=". $userHash.";".$token;
            $token =  $XBL_TOKEN;
            if($token === null || $token === ""){
                ?>
                <!DOCTYPE html>
                 <html lang="en">
                 
                 <head>
                     <meta charset="UTF-8">
                     <meta name="viewport" content="width=device-width, initial-scale=1.0">
                     <title>Authorization</title>            
                 </head>
                 <style>
                     body {
                         background-color: #121212; /* Dark grey/black background */
                         color: #E0E0E0; /* Light grey text color */
                         font-family: Arial, sans-serif;
                         display: flex;
                         justify-content: center;
                         align-items: center;
                         height: 100vh;
                         margin: 0;
                     }
                     .container {
                         display: flex;
                         flex-wrap: wrap; /* Allows wrapping of items */
                         justify-content: center;
                         align-items: center;
                         width: 80%;
                         max-width: 1000px;
                     }
                     .box {
                         background-color: #1E1E1E;
                         color: #E0E0E0;
                         border-radius: 10px;
                         padding: 20px;
                         text-align: center;
                         width: 420px;
                         height: 190px;
                         align-content: center;
                         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
                         margin: 10px;
                         cursor: pointer;
                         transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
                     }
         
         
                     .box i {
                         font-size: 68px;
                         color: #dfdbff !important; 
                         margin-bottom: 10px;
                         cursor: pointer;
                     }
                     .box p {
                         margin: 0;
                         font-size: 26px;
                         cursor: pointer;            
                         color: #dfdbff !important; 
                     }
         
                     @media (max-width: 600px) {
                         .box {
                             width: 120px;
                             font-size: 14px;
                         }
                         .box i {
                             font-size: 36px;
                         }
                     }
                 </style>
             </head>
         
             <body>
                 <div class="container">
                     <div class="box">
                     <p>Error!<br>empty_token error</p><br>
                     </div>        
                 </div>         
             </body>
             </html>
         
         
         
         
                 <?php
                return;       
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://profile.xboxlive.com/users/me/profile/settings?settings=Gamertag');
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');    
            curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
            $headers = array();
            $headers[] = 'Authorization: '.$token;
            $headers[] = 'x-xbl-contract-version: 2';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            $gamename = "";
            if (curl_errno($ch)) {

            }
            curl_close($ch);      
            $profileinfo = json_decode($result);
            $api_xuid = "";
            foreach($profileinfo->profileUsers as $myinfo)
            {
                $api_xuid = $myinfo->id;    
            }


            if($api_xuid === null || $api_xuid === ""){

                ?>
                <!DOCTYPE html>
                 <html lang="en">
                 
                 <head>
                     <meta charset="UTF-8">
                     <meta name="viewport" content="width=device-width, initial-scale=1.0">
                     <title>Authorization</title>            
                 </head>
                 <style>
                     body {
                         background-color: #121212; /* Dark grey/black background */
                         color: #E0E0E0; /* Light grey text color */
                         font-family: Arial, sans-serif;
                         display: flex;
                         justify-content: center;
                         align-items: center;
                         height: 100vh;
                         margin: 0;
                     }
                     .container {
                         display: flex;
                         flex-wrap: wrap; /* Allows wrapping of items */
                         justify-content: center;
                         align-items: center;
                         width: 80%;
                         max-width: 1000px;
                     }
                     .box {
                         background-color: #1E1E1E;
                         color: #E0E0E0;
                         border-radius: 10px;
                         padding: 20px;
                         text-align: center;
                         width: 420px;
                         height: 190px;
                         align-content: center;
                         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
                         margin: 10px;
                         cursor: pointer;
                         transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
                     }
         
         
                     .box i {
                         font-size: 68px;
                         color: #dfdbff !important; 
                         margin-bottom: 10px;
                         cursor: pointer;
                     }
                     .box p {
                         margin: 0;
                         font-size: 26px;
                         cursor: pointer;            
                         color: #dfdbff !important; 
                     }
         
                     @media (max-width: 600px) {
                         .box {
                             width: 120px;
                             font-size: 14px;
                         }
                         .box i {
                             font-size: 36px;
                         }
                     }
                 </style>
             </head>
         
             <body>
                 <div class="container">
                     <div class="box">
                     <p>Error!<br>please try again later.</p><br>
                     </div>        
                 </div>         
             </body>
             </html>
         
         
         
         
                 <?php
                return;


            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://peoplehub.xboxlive.com/users/me/people/xuids('.$api_xuid.')/decoration/detail,preferredColor,presenceDetail');
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');   
            curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
            $headers = array();
            $headers[] = 'Accept-Language: en-US';
            $headers[] = 'Authorization: '.$token;
            $headers[] = 'Content-Type: application/json; text/plain;charset=UTF-8';
            $headers[] = 'x-xbl-contract-version: 4';
            $headers[] = 'Accept-Encoding: gzip, deflate';
            $headers[] = 'Accept: application/json';
            $headers[] = 'Accept-Language: en-US, en-GB';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $result = curl_exec($ch);
            curl_close($ch);
            if (curl_errno($ch)) {

            }
            $profileinfo = json_decode($result);   
            $gametag = null;
            foreach ($profileinfo->people as $myinfo) {
                $gametag = $myinfo->gamertag;
                $user_photo = $myinfo->displayPicRaw;
            }      





            if(empty($api_xuid)){
                ?>
                <!DOCTYPE html>
                 <html lang="en">
                 
                 <head>
                     <meta charset="UTF-8">
                     <meta name="viewport" content="width=device-width, initial-scale=1.0">
                     <title>Authorization</title>            
                 </head>
                 <style>
                     body {
                         background-color: #121212; /* Dark grey/black background */
                         color: #E0E0E0; /* Light grey text color */
                         font-family: Arial, sans-serif;
                         display: flex;
                         justify-content: center;
                         align-items: center;
                         height: 100vh;
                         margin: 0;
                     }
                     .container {
                         display: flex;
                         flex-wrap: wrap; /* Allows wrapping of items */
                         justify-content: center;
                         align-items: center;
                         width: 80%;
                         max-width: 1000px;
                     }
                     .box {
                         background-color: #1E1E1E;
                         color: #E0E0E0;
                         border-radius: 10px;
                         padding: 20px;
                         text-align: center;
                         width: 420px;
                         height: 190px;
                         align-content: center;
                         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
                         margin: 10px;
                         cursor: pointer;
                         transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
                     }
         
         
                     .box i {
                         font-size: 68px;
                         color: #dfdbff !important; 
                         margin-bottom: 10px;
                         cursor: pointer;
                     }
                     .box p {
                         margin: 0;
                         font-size: 26px;
                         cursor: pointer;            
                         color: #dfdbff !important; 
                     }
         
                     @media (max-width: 600px) {
                         .box {
                             width: 120px;
                             font-size: 14px;
                         }
                         .box i {
                             font-size: 36px;
                         }
                     }
                 </style>
             </head>
         
             <body>
                 <div class="container">
                     <div class="box">
                     <p>Error!<br>please try again later.</p><br>
                     </div>        
                 </div>         
             </body>
             </html>
         
         
         
         
                 <?php
                return;
            }
            if(empty($gametag)){
                ?>
                <!DOCTYPE html>
                 <html lang="en">
                 
                 <head>
                     <meta charset="UTF-8">
                     <meta name="viewport" content="width=device-width, initial-scale=1.0">
                     <title>Authorization</title>            
                 </head>
                 <style>
                     body {
                         background-color: #121212; /* Dark grey/black background */
                         color: #E0E0E0; /* Light grey text color */
                         font-family: Arial, sans-serif;
                         display: flex;
                         justify-content: center;
                         align-items: center;
                         height: 100vh;
                         margin: 0;
                     }
                     .container {
                         display: flex;
                         flex-wrap: wrap; /* Allows wrapping of items */
                         justify-content: center;
                         align-items: center;
                         width: 80%;
                         max-width: 1000px;
                     }
                     .box {
                         background-color: #1E1E1E;
                         color: #E0E0E0;
                         border-radius: 10px;
                         padding: 20px;
                         text-align: center;
                         width: 420px;
                         height: 190px;
                         align-content: center;
                         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
                         margin: 10px;
                         cursor: pointer;
                         transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
                     }
         
         
                     .box i {
                         font-size: 68px;
                         color: #dfdbff !important; 
                         margin-bottom: 10px;
                         cursor: pointer;
                     }
                     .box p {
                         margin: 0;
                         font-size: 26px;
                         cursor: pointer;            
                         color: #dfdbff !important; 
                     }
         
                     @media (max-width: 600px) {
                         .box {
                             width: 120px;
                             font-size: 14px;
                         }
                         .box i {
                             font-size: 36px;
                         }
                     }
                 </style>
             </head>
         
             <body>
                 <div class="container">
                     <div class="box">
                     <p>Error!<br>please try again later.</p><br>
                     </div>        
                 </div>         
             </body>
             </html>
         
         
         
         
                 <?php
                return;               
            }if(empty($token)){
                ?>
                <!DOCTYPE html>
                 <html lang="en">
                 
                 <head>
                     <meta charset="UTF-8">
                     <meta name="viewport" content="width=device-width, initial-scale=1.0">
                     <title>Authorization</title>            
                 </head>
                 <style>
                     body {
                         background-color: #121212; /* Dark grey/black background */
                         color: #E0E0E0; /* Light grey text color */
                         font-family: Arial, sans-serif;
                         display: flex;
                         justify-content: center;
                         align-items: center;
                         height: 100vh;
                         margin: 0;
                     }
                     .container {
                         display: flex;
                         flex-wrap: wrap; /* Allows wrapping of items */
                         justify-content: center;
                         align-items: center;
                         width: 80%;
                         max-width: 1000px;
                     }
                     .box {
                         background-color: #1E1E1E;
                         color: #E0E0E0;
                         border-radius: 10px;
                         padding: 20px;
                         text-align: center;
                         width: 420px;
                         height: 190px;
                         align-content: center;
                         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
                         margin: 10px;
                         cursor: pointer;
                         transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
                     }
         
         
                     .box i {
                         font-size: 68px;
                         color: #dfdbff !important; 
                         margin-bottom: 10px;
                         cursor: pointer;
                     }
                     .box p {
                         margin: 0;
                         font-size: 26px;
                         cursor: pointer;            
                         color: #dfdbff !important; 
                     }
         
                     @media (max-width: 600px) {
                         .box {
                             width: 120px;
                             font-size: 14px;
                         }
                         .box i {
                             font-size: 36px;
                         }
                     }
                 </style>
             </head>
         
             <body>
                 <div class="container">
                     <div class="box">
                     <p>Error!<br>please try again later.</p><br>
                     </div>        
                 </div>         
             </body>
             </html>
         
         
         
         
                 <?php
                return;               
            }
            
            $xuid = $api_xuid;


            ?>
            <!DOCTYPE html>
             <html lang="en">
             
             <head>
                 <meta charset="UTF-8">
                 <meta name="viewport" content="width=device-width, initial-scale=1.0">
                 <title>Authorization</title>            
             </head>
             <style>
                 body {
                     background-color: #121212; /* Dark grey/black background */
                     color: #E0E0E0; /* Light grey text color */
                     font-family: Arial, sans-serif;
                     display: flex;
                     justify-content: center;
                     align-items: center;
                     height: 100vh;
                     margin: 0;
                 }
                 .container {
                     display: flex;
                     flex-wrap: wrap; /* Allows wrapping of items */
                     justify-content: center;
                     align-items: center;
                     width: 80%;
                     max-width: 1000px;
                 }
                 .box {
                     background-color: #1E1E1E;
                     color: #E0E0E0;
                     border-radius: 10px;
                     padding: 20px;
                     text-align: center;
                     width: 420px;
                     height: 190px;
                     align-content: center;
                     box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
                     margin: 10px;
                     cursor: pointer;
                     transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
                 }
     
     
                 .box i {
                     font-size: 68px;
                     color: #dfdbff !important; 
                     margin-bottom: 10px;
                     cursor: pointer;
                 }
                 .box p {
                     margin: 0;
                     font-size: 26px;
                     cursor: pointer;            
                     color: #dfdbff !important; 
                 }
     
                 @media (max-width: 600px) {
                     .box {
                         width: 120px;
                         font-size: 14px;
                     }
                     .box i {
                         font-size: 36px;
                     }
                 }
             </style>
         </head>
     
         <body>
             <div class="container">
                 <div class="box">
                 <p>loading...</p><br>
                 </div>        
             </div>         
             <script>
                 localStorage.setItem('authToken', "<?php echo $token;?>");
                 localStorage.setItem('authExpires', "<?php echo $expires;?>");
                 window.location.href = "./xboxhomepage.php";

             </script>
         </body>
         </html>
     
     
     
     
             <?php
            return;         
                
                

                
            
    }
}
else{
    $appid = "3a89b200-2661-43ba-b57e-9e4d8c3bb279";
    $appsecret = "QF.8Q~lQuofVnPgFp2qcfIbMGKxWSRDSnDMnRcD.";
    $apptenant = "f8cdef31-a31e-4b4a-93e4-5f571e91255a";
    $params = array ('client_id' => $appid,
            'redirect_uri'=>$url,
            'scope'=> 'Xboxlive.signin Xboxlive.offline_access',
            'response_type'=>'code',
            'prompt'=>'auto',
            );
    header("Location: https://login.live.com/oauth20_authorize.srf?".http_build_query($params));
}

?>