<?php
$Name=$_POST['name'];
$Age=$_POST['age'];
$Phone=$_POST['phone'];
$servername = "localhost";
$username = "id11161569_logger123";
$password1 = "123456";
$con = new mysqli($servername,$username,$password1,"id11161569_login") or die('Unable to Connect');
	$n=10; 
function getName($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 
  
$str=getName($n); 
$sql = "INSERT INTO msc991 (name,age,password,phone) VALUES ('$Name','$Age','$str','$Phone')";
if(mysqli_query($con,$sql))
{
echo "Successfully Uploaded";

//Your authentication key
$authKey = "298916AKBogUzOF1K85da56d38";


//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "102234";

//Your message to send, Add URL encoding here.
$message = urlencode("Dear $Name, your password for login to the app is as follows $str");

//Define route 
$route = "default";
//Prepare you post parameters
$postData = array(
    'authkey' => $authKey,
    'mobiles' => $Phone,
    'message' => $message,
    'sender' => $senderId,
    'route' => $route
);

//API URL
$url="http://api.msg91.com/api/sendhttp.php";

// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));


//Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


//get response
$output = curl_exec($ch);

//Print error if any
if(curl_errno($ch))
{
    echo 'error:' . curl_error($ch);
}

curl_close($ch);

echo $output;
}
else{
echo "Error";
}
$con->close();
?>