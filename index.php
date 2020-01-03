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
        $slash_pos = strpos($url, '/', 10);
        $qmark_pos = strpos($url, '?');
        $res_str = substr($url, $slash_pos, $qmark_pos - $slash_pos);
        return $res_str;
    }
    else{
        return 'Scrolling';
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
foreach($LL as $value){
    if(isIpPresent($link, $value->ip)){

    }
    else{
        $details = $client->getDetails($value->ip);
        $country = $details->country_name;
        mysqli_query($link, "INSERT INTO IP_Country (country, ip) VALUES ('".$country."','".$value->ip."')");
    }
}
echo isIpPresent($link,"f");
//var_dump(mysqli_query($link, "SELECT * FROM IP_Country WHERE ip='fgf'"));
//var_dump($LL[20000]);
$country = "sos";
$ip="sample";
//mysqli_query($link, "INSERT INTO IP_Country (country, ip) VALUES ('".$country."','".$ip."')");

?>