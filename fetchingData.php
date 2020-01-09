<?php
require_once('tools\db_process.php');

function getMinMaxDate(){
    global $link;
    $query = "SELECT min(action_time) min_bound, max(action_time) max_bound FROM exploring";
    $results=array();
    $selection = mysqli_query($link, $query);
        if (mysqli_num_rows($selection) > 0) {
            while($row = mysqli_fetch_assoc($selection)) {
                $results[] = $row;
            }
        } else {
            return false; // Pay attention
        }
        return json_encode($results);
}

function getMostFrequentCountry(){
    global $link;
    $query = "SELECT country, count(*) num FROM exploring GROUP BY country";
    $results=array();
    $selection = mysqli_query($link, $query);
        if (mysqli_num_rows($selection) > 0) {
            while($row = mysqli_fetch_assoc($selection)) {
                $results[] = $row;
            }
        } else {
            return false; // Pay attention
        }
        return json_encode($results);
}
function getMostFrequentCountryByCategory($category){
    global $link;
    $query = "SELECT country, count(*) num FROM exploring WHERE category='".$category."' GROUP BY country";
    $results=array();
    $selection = mysqli_query($link, $query);
        if (mysqli_num_rows($selection) > 0) {
            while($row = mysqli_fetch_assoc($selection)) {
                $results[] = $row;
            }
        } else {
            return false; // Pay attention
        }
        return json_encode($results);
}
function getCategoriesList(){
    global $link;
    $query = "SELECT DISTINCT category FROM exploring";
    $results=array();
    $selection = mysqli_query($link, $query);
        if (mysqli_num_rows($selection) > 0) {
            while($row = mysqli_fetch_assoc($selection)) {
                if($row['category']=='' || strpos($row['category'], 'success_pay')===0){
                    //echo 'sos';
                   // print_r(strpos($row['category'], 'success_pay'));
                }
                else{
                    $results[] = $row;
                }
            }
        } else {
            return false; // Pay attention
        }
        return json_encode($results);
}
function getLoadByHour($date){
    global $link;
    $query = "SELECT action_time, count(*) calls  FROM exploring WHERE action_time LIKE '".$date."%' GROUP BY  action_time";
    $results=array();
    $selection = mysqli_query($link, $query);
        if (mysqli_num_rows($selection) > 0) {
            while($row = mysqli_fetch_assoc($selection)) {
                $results[] = $row;
            }
        } else {
            return false; // Pay attention
        }
        return json_encode($results);
}
function getFrequencyByTimeOfDay($category){

}
if(isset($_POST["getMostFrequentCountry"])){
    echo getMostFrequentCountry();
}
if(isset($_POST["getMostFrequentCountryByCategory"])){
    echo getMostFrequentCountryByCategory($_POST['category']);
}
if(isset($_POST["getCategoriesList"])){
    echo getCategoriesList();
}
if(isset($_POST["getLoadByHour"])){
    echo getLoadByHour($_POST['date']);
}
if(isset($_POST['getMinMaxDate'])){
    echo getMinMaxDate();
}
//echo $_POST;
//echo getCategoriesList();
?>