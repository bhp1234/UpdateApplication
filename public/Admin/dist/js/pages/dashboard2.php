
<script type="text/javascript">
<?php require_once __MODEL_PATH.'public_Model.php'; 
$model=new public_Model;
?>
$( document ).ready(function() {

  'use strict';

  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  //-----------------------
  //- MONTHLY SALES CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas);

  var salesChartData = {
    labels: [<?php 
				$month=(new DateTime())->format('m');
				for($i=1;$i<=$month;$i++)
				{
					echo "\"Tháng ".$i."\"";
					if($i!=$month)
					echo ',';
				}
				?>],
    datasets: [
      {
        label: "Doanh thu",
        fillColor: "#EC4078",
        strokeColor: "#EC4078",
        pointColor: "#EC4078",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: [	<?php 
				for($i=1;$i<=$month;$i++)
				{
					echo $model->getCostByMonth($i);
					if($i!=$month)
					echo ',';
				}
				?>]
      }
    ]
  };

  var salesChartOptions = {
  //Boolean - If we should show the scale at all
    showScale: true,
	// Boolean - Whether to animate the chart
    animation: true,
    // Number - Number of animation steps
    animationSteps: 60,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: true,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0.5)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
	//** Required if scaleOverride is true **
	scaleOverride : true,
    //Number - The number of steps in a hard coded scale
    scaleSteps : 10,
    //Number - The value jump in the hard coded scale
    scaleStepWidth : 100,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0,
    //Boolean - Whether to show a dot for each point
    pointDot: true,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 1,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: false,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };

  //Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);
  //---------------------------
  //- END MONTHLY SALES CHART -
  
});
</script>