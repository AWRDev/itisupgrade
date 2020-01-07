<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap attaching -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- JQuery attaching -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- My script -->
    <script src="scripts.js"></script>
    <title>Dashboard</title>
</head>
<body style="overflow: auto">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      //google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart(values) {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows(values);

        // Set chart options
        var options = {'title':'Количество запросов из стран',
                       'width':600,
                       'height':500};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
<div class="container-fluid" style="margin:0; padding: 0;">
  <div class="row" style='height: 75px; background-color: blue;'>
    <div class="col-sm-6" style="margin: 0 0 0 5;color: white; font-size: 3em">
      Все на дно: Статистика
    </div>
    <div class="col-sm">
      
    </div>
    <div class="col-sm">
      
    </div>
  </div>
  <div id='mainArea' class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                  <a href="#" class="nav-link" onclick='getMostFrequentCountry()'>Статистика по странам</a>
              </li>
              <li class="nav-item"><a href="#" class="nav-link" onclick='getMostFrequentCountryByCategory()'>Статистика по странам в категориях</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Статистика по времени суток</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Статистика по часам</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Статистика по совместным категориям</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Статистика по брошенным корзинам</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Статистика по повторным покупкам</a></li>
            </ul>
          </div>
        </nav>
  </div>
</div>
</body>
</html>