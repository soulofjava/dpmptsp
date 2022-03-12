<div class="row">
  <div class="col-md-12">
    <div class="box box-danger box-solid">
      <div class="box-header">
        <h3 class="box-title">Grafik Data Realisasi Investasi (Berdasar Permohonan SIUP) Tahun <?php echo date('Y'); ?></h3>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="box box-danger box-solid">
      <div class="box-header">
        <h3 class="box-title">&nbsp;</h3>
      </div>
      <div class="box-body">
        <canvas id="canvas" height="200" width="600"></canvas>
      </div>
      <div class="box-footer">
       
      </div>
    </div>
  </div>
  
  <div class="col-md-6">
    <div class="box box-danger box-solid">
      <div class="box-header">
        <h3 class="box-title">&nbsp;</h3>
      </div>
      <div class="box-body">
        <!-- pie chart canvas element -->
        <canvas id="countries" width="600" height="400"></canvas>
      </div>
      <div class="box-footer">
        
      </div>
    </div>
  </div>
  
</div>


<script src="https://keuangan.keyzie.org/simple_chart/Chart.js"></script>

<script>

function testaja(lb, dt, dtx){
    var lb2 = eval(lb);
    var dt2 = eval(dt);
    var dtx2 = eval(dtx);
    
    var barChartData = {
      labels : lb2,
      datasets : [
        {
          fillColor : "rgba(0,23,255,0.5)",
          strokeColor : "rgba(0,23,255,0.8)",
          highlightFill: "rgba(0,23,255,0.75)",
          highlightStroke: "rgba(0,23,255,1)",
          data : dt2
        }
      ]
    }
    
  var ctx = document.getElementById("canvas").getContext("2d");
  window.myBar = new Chart(ctx).Bar(barChartData, {
    responsive : true
  });
  
  
     //nuevos colores
    myBar.datasets[0].bars[0].fillColor = "#878BB6"; //bar 1
    myBar.datasets[0].bars[1].fillColor = "#4ACAB4"; //bar 2
    myBar.datasets[0].bars[2].fillColor = "#FF8153"; //bar 3
    myBar.datasets[0].bars[3].fillColor = "#FFEA88"; //bar 3
    myBar.update();
    
    
  var pieData = [
		{
			value: dt2[0],
			color:"#878BB6"
		},
		{
			value : dt2[1],
			color : "#4ACAB4"
		},
		{
			value : dt2[2],
			color : "#FF8153"
		},
		{
			value : dt2[3],
			color : "#FFEA88"
		}
	];
  var pieOptions = {
		segmentShowStroke : false,
		animateScale : true,
    responsive: true
	}
	var countries= document.getElementById("countries").getContext("2d");
	new Chart(countries).Pie(pieData, pieOptions);
  
} 
</script>



<script type="text/javascript">
  $(document).ready(function() {
    
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        temp: 'ok'
      },
      dataType: 'text',
      url: 'https://dashboard.wonosobokab.go.id/dashboard/investasi/',
      success: function(text) {
        var res1 = text.split("---");
        var lb = res1[0];
        var dt = res1[1];
        var dtx = res1[2];
        testaja(lb, dt, dtx);
      }
    });
  });
</script>
