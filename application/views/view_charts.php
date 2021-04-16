<script src="https://www.google.com/jsapi"></script>

<script>
    (function(){
        carga_todos();
    })();

    function carga_todos() {
        var url_temp = "<?=base_url();?>proyectoapi/Ctrlsensors/grafica_temperatura";
        $.getJSON(url_temp,{
            format: "json"
        })
            .done(function (data) {
                chart_temp(data, "LineChart");
            }).fail(function (jqxhr, textStatus, error) {
                var err = textStatus + ", " + error;
                console.log("Request Failed: " + err);
            });

        var url_hum = "<?=base_url();?>proyectoapi/Ctrlsensors/grafica_humedad";
        $.getJSON(url_hum,{
            format: "json"
        })
            .done(function (data) {
                chart_hum(data, "LineChart");
            }).fail(function (jqxhr, textStatus, error) {
                var err = textStatus + ", " + error;
                console.log("Request Failed: " + err);
            });

        var url_light = "<?=base_url();?>proyectoapi/Ctrlsensors/grafica_luminosidad";
        $.getJSON(url_light,{
            format: "json"
        })
            .done(function (data) {
                chart_light(data, "LineChart");
            }).fail(function (jqxhr, textStatus, error) {
                var err = textStatus + ", " + error;
                console.log("Request Failed: " + err);
            });
    }

    function chart_temp(data, ChartType) {
        var c = ChartType;
        var d = data;
        google.load("visualization", "1", {packages: ["corechart"], callback: drawVisualization});
        function drawVisualization() {
            var data = new google.visualization.DataTable();
            data.addColumn('string','hour');
            data.addColumn('number','temperature');

            $.each(d, function (i, d) {
                var b = parseFloat(d.temperature);
                var g = d.hour;
                data.addRows([[g, b]]);
            });

            var options = {
                title: "Temperatura del día",
                is3D: true,
                animatio: {
                    duration: 3000,
                    easing: 'out',
                    startup: true
                },
                colorAxis: {colors: ['#54C492', '#cc0000']},
                datalessRegionColor: '#dedede',
                defaultColor: '#dedede'
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_temp'));            
            chart.draw(data, options);
        }
    }

    function chart_hum(data, ChartType) {
        var c = ChartType;
        var d = data;
        google.load("visualization", "1", {packages: ["corechart"], callback: drawVisualization});
        function drawVisualization() {
            var data = new google.visualization.DataTable();
            data.addColumn('string','hour');
            data.addColumn('number','humidity');

            $.each(d, function (i, d) {
                var b = parseFloat(d.humidity);
                var g = d.hour;
                data.addRows([[g, b]]);
            });

            var options = {
                title: "Humedad del día",
                is3D: true,
                animatio: {
                    duration: 3000,
                    easing: 'out',
                    startup: true
                },
                colorAxis: {colors: ['#54C492', '#cc0000']},
                datalessRegionColor: '#dedede',
                defaultColor: '#dedede'
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_hum'));
            chart.draw(data, options);
        }
    }

    function chart_light(data, ChartType) {
        var c = ChartType;
        var d = data;
        google.load("visualization", "1", {packages: ["corechart"], callback: drawVisualization});
        function drawVisualization() {
            var data = new google.visualization.DataTable();
            data.addColumn('string','hour');
            data.addColumn('number','light');

            $.each(d, function (i, d) {
                var b = parseFloat(d.light);
                var g = d.hour;
                data.addRows([[g, b]]);
            });

            var options = {
                title: "Luminosidad del día",
                is3D: true,
                animatio: {
                    duration: 3000,
                    easing: 'out',
                    startup: true
                },
                colorAxis: {colors: ['#54C492', '#cc0000']},
                datalessRegionColor: '#dedede',
                defaultColor: '#dedede'
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_light'));
            chart.draw(data, options);
        }
    }
</script>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Panel de control / Gráficas de datos</h1>
            <div id="chart_temp"></div>
            <div id="chart_hum"></div>
            <div id="chart_light"></div>
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

