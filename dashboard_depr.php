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
$listByCountryFrequency = getMostFrequentCountry();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>
<body>
    <script>
        let json_coded_string = <?= $listByCountryFrequency; ?>;
        let tmp_data = Array();
        for(let i=0; i<json_coded_string.length; i++){
            let tmpAr = Array();
            tmpAr[0] = json_coded_string[i].country;
            tmpAr[1] = parseInt(json_coded_string[i].num);
            json_coded_string[i] = tmpAr;
        }
        let id = 0;
        let max = 0;
        for(let i=0; i<json_coded_string.length; i++){
            if(parseInt(json_coded_string[i][1])>=max){
                max = parseInt(json_coded_string[i][1]);
                id = i;
            }
        }
        console.log(json_coded_string[id]);
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows(json_coded_string);

        // Set chart options
        var options = {'title':'Количество запросов из стран',
                       'width':600,
                       'height':500};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
<div id="chart_div"></div>
</body>
</html>