    <!-- JS hitungan -->
    <script>
        $(document).ready(function() {
            $("#btnSubmit").click(function() {
                var vbegin = $("#vbegin").val();
                var vfinal = $("#vfinal").val();
                var years = $("#years").val();

                var cagr = (Math.pow(vfinal / vbegin, 1 / years) - 1) * 100;
                cagr = Math.round((cagr + Number.EPSILON) * 100) / 100;
                $("#cagrresult").html('CAGR: ' + cagr + '%');
                $("#xtimes").html('Growth : ' + (vfinal / vbegin).toFixed(2) + ' times');

                $("#cagr-years-table").empty();
                var cagrNoRounding = (Math.pow(vfinal / vbegin, 1 / years) - 1) * 100;
                calculateYearwise(vbegin, cagrNoRounding, years, "cagr");

                buildChart();
            });

        });

        function buildChart() {
            resetChartCanvas();
            chartConfig.data = cagrChartData;
            pieconfig.data = piedata;
            generateCanvas(chartConfig, pieconfig);
            clearChartData();
        }

        function generateCanvas(input, input2) {
            var ctx = $('#myChart');
            var myChart = new Chart(ctx, input);

            var ctx2 = $('#pieChart');
            var pieChart = new Chart(ctx2, input2);
        }

        function resetChartCanvas() {
            while (Object.keys(Chart.instances).length >= 1) {
                Chart.instances[Object.keys(Chart.instances)[0]]?.destroy();
            }
            return Promise.resolve('done');
        }

        function clearChartData() {
            //chartConfig.data = {};
            cagrChartData.labels = [];
            cagrChartData.datasets[0].data = [];
            piedata.datasets[0].data = [];
        }


        function calculateYearwise(begin, cagr, years, table, topup) {
            begin = parseInt(begin);
            topup = topup == undefined ? 0 : parseInt(topup);
            var yearBegin = parseInt(begin);
            var finalAmount = 0;
            for (let year = 0; year <= years; year++) {
                var y = year > 0 ? 1 : 0; //per year amount calculation, if needed for nth year, this should be n
                var amount = yearBegin * Math.pow((cagr / 100 + 1), y);
                //amount = Math.round(amount);
                //console.log('yearBegin');
                //console.log(yearBegin);
                //console.log('yearEnd');
                //console.log(amount);
                cagrGenerateRows(year, amount, amount / begin, table);
                //console.log(cagrChartData);
                cagrChartData.labels.push(year);
                cagrChartData.datasets[0].data.push(Math.round(amount));
                piedata.datasets[0].data = [begin, Math.round(amount)];
                //console.log(cagrChartData);
                if (year > 0)
                    yearBegin = amount + topup;

                finalAmount = amount;
            }
            return finalAmount;
        }

        function cagrGenerateRows(year, value, growth, table) {
            $("#" + table + "-years-table").append("<tr><td>" + year + "</td><td><span>" + Math.round(value) + "</span></td><td><span>" + growth.toFixed(2) + "</span></td></tr>");
        }

        function rangeChange(value, type) {
            console.log(value);
            $("#" + type + "-range-value").html(value);
        }
        var chartConfig = {
            type: 'bar',
            data: {},
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        }
        var cagrChartData = {
            labels: [],
            datasets: [{
                label: 'Value',
                data: [],
            }],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        };
        const pieconfig = {
            type: 'pie',
            data: {},
        };

        const piedata = {
            labels: [
                'Initial Value',
                'Final Value'
            ],
            datasets: [{
                label: 'Investment vs Return',
                data: [],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)'
                ],
                hoverOffset: 4
            }]
        };
    </script>
    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- akhir JS Hitungan -->

    <div class="container mt-12">
        <!-- <h2>CAGR CALCULATOR</h2> -->
        <div class="mt-4 p-5 bg-primary text-white rounded">
            <h2>CAGR CALCULATOR</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat..</p>
        </div>

        <br>

        <div class="card">
            <div class="card-header">
                Input Value & Periods
            </div>
            <div class="card-body">
                <h5 class="card-title">Calculate Compound Annual Growth Rate</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

            </div>

            <!-- inputan cagr-->
            <div class="alert alert-light" role="alert">
                <div class="mb-12">
                    <div class="divlabel"><label for="vbegin">Starting Value</label></div>
                    <input type="text" id="vbegin" placeholder="ex. 3160" />
                </div>
                <div class="mb-12">
                    <div class="divlabel"><label for="vfinal">Target Value</label></div>
                    <input type="text" id="vfinal" placeholder="ex. 7500" />
                </div>
                <div class="mb-12">
                    <div class="divlabel"><label for="years">Years/Months</label></div>
                </div>
                <div class="mb-12">

                    <!-- inputan periode-->
                    <p class="range-field">
                        <input type="text" id="years" min="1" max="50" placeholder="ex. 5" onchange="rangeChange(this.value, 'cagr-range-value')" />
                    </p>
                </div>
                <div class="col s12"></div>
                <button type="button" class="btn btn-success" id="btnSubmit">Calculate</button>
            </div>
        </div>
        <!-- akhir inputan cagr-->

        <br>
        <!-- hasil cagr -->
        <div class="card">
            <div class="card-header">
                Growth & Result
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-success">
                            <h3> <span class="flow-text" id="xtimes"></span> </h3>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="alert alert-success">
                            <h3><span class="flow-text" id="cagrresult"></span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- akhir hasil cagr -->
        <br>
        <!-- tabel CAGR -->
        <div class="card">
            <div class="card-header">
                Growth Table
            </div>
            <div class="card-body">
                <div class="col s12">
                    <table class="table table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Year</th>
                                <th scope="col">Value</th>
                                <th scope="col">Growth</th>
                            </tr>
                        </thead>

                        <tbody id="cagr-years-table"></tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- akhir tabel CAGR -->
        <br>
        <!-- Grafik CAGR -->
        <div class="card">
            <div class="card-header">
                Chart
            </div>
            <div class="card-body">
                <div class="alert alert-success">
                    <strong>Bar Chart
                </div>
                <div id="charts" class="col s12">
                    <canvas id="myChart" width="200" height="200"></canvas>
                </div>
                <br>
                <div class="alert alert-success">
                    <strong>Pie Chart
                </div>
                <div id="charts" class="col s6">
                    <canvas id="pieChart" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
        <!-- Akhir Grafik CAGR -->
        <br>