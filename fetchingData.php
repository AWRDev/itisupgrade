<?php
require_once('tools\db_process.php');
mysqli_select_db($link, 'alltothebottom_by_awr');
function checkDB(){
    global $link;
    $query = "SHOW DATABASES LIKE 'alltothebottom_by_awr'";
    $results=array();
    $selection = mysqli_query($link, $query);
        if (mysqli_num_rows($selection) > 0) {
            while($row = mysqli_fetch_assoc($selection)) {
                $results[] = $row;
            }
        } else {
            return "No database found"; 
        }
        return json_encode($results);
}

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
    global $link;
    $query = "SELECT 
    CASE
        WHEN HOUR(action_time) IN ('00','01','02','03','04','05') THEN 'Night'
        WHEN HOUR(action_time) IN ('06','07','08','09','10','11') THEN 'Morning'
        WHEN HOUR(action_time) IN ('12','13','14','15','16','17') THEN 'Day'
        WHEN HOUR(action_time) IN ('18','19','20','21','22','23') THEN 'Evening'
    END time_of_day,
    count(*) calls
    FROM `exploring`
    WHERE category='".$category."'
    GROUP BY time_of_day";
    //echo $query;
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
function getUnpaidCartsCount($date_from, $date_to){
    global $link;
    $query = "SELECT count(*) count FROM `cart`  WHERE action_time>='".$date_from." 00:00:00' and action_time<='".$date_to." 23:59:59' and paid=0";
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
if(isset($_POST['getFrequencyByTimeOfDay'])){
    echo getFrequencyByTimeOfDay($_POST['category']);
}
if(isset($_POST['getUnpaidCartsCount'])){
    echo getUnpaidCartsCount($_POST['date_from'], $_POST['date_to']);
}
if(isset($_POST['checkDB'])){
    echo checkDB();
}
//echo getUnpaidCartsCount($_GET['date_from'], $_GET['date_to']);
//echo $_POST;
//echo getCategoriesList();
?>