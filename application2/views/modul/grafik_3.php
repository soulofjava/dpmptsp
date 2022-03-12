<div class="row">
  <div id="myProgress">
    <div id="myBar"></div>
  </div>
  <div class="col-md-4">
    <div class="box box-danger box-solid">
      <div class="box-header">
        <h3 class="box-title">Grafik Data Perizinan PATEN</h3>
      </div>
      <div class="box-body">
        <canvas id="canvas" height="600" width="400"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="box box-danger box-solid">
      <div class="box-header">
        <h3 class="box-title">Data Perizinan IMB PATEN</h3>
      </div>
      <div class="box-body">
        <div id="the_data"></div>
      </div>
      <div class="box-footer">
        &nbsp;
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="box box-danger box-solid">
      <div class="box-header">
        <h3 class="box-title">Data Izin Pemasangan Reklame PATEN</h3>
      </div>
      <div class="box-body">
        <div id="the_data2"></div>
      </div>
      <div class="box-footer">
        &nbsp;
      </div>
    </div>
  </div>
</div>

<script src="https://keuangan.keyzie.org/simple_chart/Chart.js"></script>

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
      url: 'https://dashboard.wonosobokab.go.id/dashboard/apriz_2/',
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
      url: 'https://dashboard.wonosobokab.go.id/dashboard/apriz_2/',
      success: function(text) {
        var res1 = text.split("---");
        var lb = res1[0];
        var dt = res1[1];
        var dtx = res1[2];
        testaja(lb, dt, dtx);
      }
    });
    
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        temp: 'ok'
      },
      dataType: 'html',
      url: 'https://dashboard.wonosobokab.go.id/dashboard/aprizpaten_data/',
      success: function(html) {
        $('#the_data').html(html);
      }
    });
    
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        temp: 'ok'
      },
      dataType: 'html',
      url: 'https://dashboard.wonosobokab.go.id/dashboard/aprizpaten_data2/',
      success: function(html) {
        $('#the_data2').html(html);
      }
    });
    
  });
</script>