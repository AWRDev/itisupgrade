// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

function drawPieChart(values, chartTitle) {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Country');
  data.addColumn('number', 'Calls');
  data.addRows(values);

  var options = {'title': chartTitle,
                 'width':600,
                 'height':500};

  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

  chart.draw(data, options)
}

function drawLineChart(values, chartTitle, width) {

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Country');
    data.addColumn('number', 'Calls');
    data.addRows(values);
  
    var options = {'title': chartTitle,
                   'width':width,
                   'height':500,
                    'curveType': 'function'};
  
    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
  
    chart.draw(data, options)
}

function drawColumnChart(values, chartTitle, width) {

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Country');
    data.addColumn('number', 'Calls');
    data.addRows(values);
  
    var options = {'title': chartTitle,
                   'width':width,
                   'height':500};
  
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
  
    chart.draw(data, options)}