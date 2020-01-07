<?php
require_once('tools\db_process.php');
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
//echo $_POST;
//echo getCategoriesList();
?>