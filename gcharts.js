// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
//google.charts.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawPieChart(values, chartTitle) {

  // Create the data table.
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Country');
  data.addColumn('number', 'Calls');
  data.addRows(values);

  // Set chart options
  var options = {'title': chartTitle,
                 'width':600,
                 'height':500};

  // Instantiate and draw our chart, passing in some options.
 // var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

  chart.draw(data, options)}

  function drawLineChart(values, chartTitle) {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Country');
    data.addColumn('number', 'Calls');
    data.addRows(values);
  
    // Set chart options
    var options = {'title': chartTitle,
                   'width':600,
                   'height':500,
                    'curveType': 'function'};
  
    // Instantiate and draw our chart, passing in some options.
   // var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
  
    chart.draw(data, options)}