<script src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    google.charts.load('current', {'packages':['gauge']});
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['Temperatura', 0],
        ['Humedad', 0]
        
        ]);

        var options = {
        width: 400, height: 400,
        redFrom: 90, redTo: 100,
        yellowFrom:75, yellowTo: 90,
        minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('Medidores'));

        chart.draw(data, options);

        setInterval(function() {
            var JSON=$.ajax({
                url:"<?=base_url();?>proyectoapi/Ctrlsensors/ultimo",
                dataType: 'json',
                async: false}).responseText;
            var Respuesta=jQuery.parseJSON(JSON);
            
        data.setValue(0, 1,Respuesta[0].temperature);
        data.setValue(1, 1,Respuesta[0].humidity);
        chart.draw(data, options);
        }, 1300);
    }
</script>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Panel de control</h1>
            <div class="form-row">
                <div class="form-group col-md-4" style="text-align: center;">
					<img src="<?=base_url();?>assets/img/logo.png" width="50%" style="width:45%;display:block;margin:0 auto">
                    <h4>www.homeweather.com</h4>
                </div>
                <?php
                if(isset($img)){
                    echo $img;
                }
                ?>
            </div>
            <div class="form-row" style="justify-content: center;">
                <div id="Medidores" ></div>
            </div> 
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; HomeWeather 2020</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
