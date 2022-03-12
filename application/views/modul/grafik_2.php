<div class="box">
  <div id="myProgress">
    <div id="myBar"></div>
  </div>
  <div class="box-header with-border">
    <h3 class="box-title">Grafik Data Perizinan</h3>
  </div>
  <div class="box-body">
    <canvas id="canvas" height="300" width="600"></canvas>
  </div>
</div>
<!--<script src="https://keuangan.keyzie.org/simple_chart/Chart.js"></script>-->
<script src="https://dpmptsp.wonosobokab.go.id/Template/chartjs-old/Chart.min.js"></script>

<script>
function move() {
  var elem = document.getElementById("myBar");   
  var width = 1;
  var id = setInterval(frame, 600);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
    }
  }
}
</script>

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
        },
        {
          fillColor : "rgba(0,255,26,0.5)",
          strokeColor : "rgba(0,255,26,0.8)",
          highlightFill : "rgba(0,255,26,0.75)",
          highlightStroke : "rgba(0,255,26,1)",
          data : dtx2
        },
      ]
    }
    
  var ctx = document.getElementById("canvas").getContext("2d");
  window.myBar = new Chart(ctx).Bar(barChartData, {
    responsive : true
  });
  
}
</script>
  
<script>
var doSth = function () {
  $.ajax({
      type: 'POST',
      async: true,
      data: {
        temp: 'ok'
      },
      dataType: 'text',
      url: 'https://dashboard.wonosobokab.go.id/dashboard/apriz_1/',
      success: function(text) {
        var res1 = text.split("---");
        var lb = res1[0];
        var dt = res1[1];
        var dtx = res1[2];
        testaja(lb, dt, dtx);
      }
    });
};
setInterval(doSth, 20000);
</script>


<script type="text/javascript">
  $(document).ready(function() {
    move();
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        temp: 'ok'
      },
      dataType: 'text',
      url: 'https://dashboard.wonosobokab.go.id/dashboard/apriz_1/',
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