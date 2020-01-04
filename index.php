<?php
require_once('vendor\autoload.php');
require_once('tools\db_process.php');

use ipinfo\ipinfo\IPinfo;

$access_token = '3f4f1952ed1478';
$client = new IPinfo($access_token);
$ip_address = '8.8.4.4';
$details = $client->getDetails();

/*echo $details->city;
echo $details->lan;
echo $details->loc;*/


class URL_String{
    public $protocol;
    public $domain_name;
    public $category;
    public $goods_name;
    function __construct($URL_String){
        $ex_url = explode('/', $URL_String);
        $this->protocol = $ex_url[0];
        $this->domain_name = $ex_url[2];
        if($ex_url[3]!='') $this->category = $ex_url[3];
        if($ex_url[4]!='') $this->goods_name = $ex_url[4];
        //var_dump($ex_url);
    }
}

class LogLine{
    public $date;
    public $time;
    public $secret;
    public $ip;
    public $url;
    public $type; //There are few types of logs: Just scrolling site, api calls for cart and pay methods
    function __construct($logLine) {
        $this->date = $logLine[0];
        $this->time = $logLine[1];
        $this->secret = $logLine[2];
        $this->ip = $logLine[4];
        $this->url = $logLine[5];
        $this->type = getURLType($this->url);
    }
}

$query_test = "SELECT * FROM IP_Country";
$query = "CREATE TABLE IP_Country (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, country VARCHAR(30) NOT NULL, ip VARCHAR(20) NOT NULL)";
if(mysqli_query($link, $query_test)){
    echo "Table is exist\n";
}
else{
    echo "Could not locate the table\n";
    mysqli_query($link, $query);
}

function getURLType($url){
    if(strpos($url, '?')!==false){
        $slash_pos = strpos($url, '/', 10)+1;
        $qmark_pos = strpos($url, '?');
        $res_str = substr($url, $slash_pos, $qmark_pos - $slash_pos);
        return $res_str;
    }
    else{
        return 'scrolling';
    }
}

function isIpPresent($link, $ip_address){
    if(mysqli_query($link, "SELECT * FROM IP_Country WHERE ip='".$ip_address."'")->num_rows==0){
        //echo "no";
        return false;
    }
    else {
        //echo "kek";
        return true;
    }
}
function getParams($url){
    $paramsArray = array();
    $qmark_pos = strpos($url, '?');
    $res_url = substr($url, $qmark_pos+1);
    $res_url = explode('&', $res_url);
    foreach($res_url as $param_value){
        $temp = explode('=',$param_value);
        $param = $temp[0];
        $value = (int)$temp[1];
        $paramsArray[$param]=$value;
    }
    return $paramsArray;
}
function parseLogLine($line){
    $trimLine = trim(explode('|', $line)[1]);
    return $parsedLogLine = explode(' ', $trimLine);
}
function loadLogsFile(){
    $file = fopen("C:\Users\artki\Desktop\logs2.txt", "r") or die("Unable to open file!");
    return $file;
}
$logsFile = loadLogsFile();
$LL = array();
while(!feof($logsFile)){
    $line = fgets($logsFile);
    $resArray = parseLogLine($line);
    $LL[] = new LogLine($resArray);
    //echo $resArray[4]. "<br>";
    //echo $line."<br>";
}
/*foreach($LL as $value){
    if(isIpPresent($link, $value->ip)){

    }
    else{
        $details = $client->getDetails($value->ip);
        $country = $details->country_name;
        mysqli_query($link, "INSERT INTO IP_Country (country, ip) VALUES ('".$country."','".$value->ip."')");
    }
}*/
//echo isIpPresent($link,"f");

function getCountryNameByIP($ip){
    global $link;
    $selection = mysqli_query($link, "SELECT country FROM IP_Country WHERE ip='".$ip."'");
    if (mysqli_num_rows($selection) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($selection)) {
            return $row['country'];
        }
    } else {
        return false; // Pay attention
    }
}
//var_dump($LL[1]);

//var_dump(mysqli_query($link, "SELECT * FROM IP_Country WHERE ip='fgf'"));
foreach($LL as $value){
    if($value->type=='scrolling'){
        $action_time=$value->date.' '.$value->time;
        $country=getCountryNameByIP($value->ip);
        $url = new URL_String($value->url);
        $sitename = $url->domain_name;
        $category = $url->category;
        $goods_name = $url->goods_name;
        mysqli_query($link, "INSERT INTO exploring (action_time, secret_seq, country, sitename, category, goods_name) VALUES ('".$action_time."', '".$value->secret."', '".$country."', '".$sitename."', '".$category."', '".$goods_name."')");
    }
    else if($value->type=='cart'){
        $action_time=$value->date.' '.$value->time;
        $params = getParams($value->url);
        //var_dump($params);
        //echo '<br>';
        $cart_id = $params['cart_id'];
        $goods_id = $params['goods_id'];
        $amount = $params['amount'];
        $paid = 0;
        mysqli_query($link, "INSERT INTO cart (action_time, cart_id, goods_id, amount, paid) VALUES ('".$action_time."', '".$cart_id."', '".$goods_id."', '".$amount."', '".$paid."')");

    }
    else if($value->type=='pay'){
        $action_time=$value->date.' '.$value->time;
        $params = getParams($value->url);
        //var_dump($params);
        //echo '<br>';
        $user_id = $params['user_id'];
        $cart_id = $params['cart_id'];
        $query = "INSERT INTO payments (action_time, cart_id, user_id) VALUES ('".$action_time."', '".$cart_id."', '".$user_id."')";
        echo $query;
        mysqli_query($link, $query);
    }
}
/*mysqli_query($link, "TRUNCATE TABLE exploring");
mysqli_query($link, "TRUNCATE TABLE cart");
mysqli_query($link, "TRUNCATE TABLE payments");*/
//mysqli_query($link, "INSERT INTO IP_Country (country, ip) VALUES ('".$country."','".$ip."')");

?>