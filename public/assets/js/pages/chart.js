google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Données transmises depuis Laravel (encodées en JSON)
            var data = google.visualization.arrayToDataTable(json($data));

            var options = {
                title: 'les activité de la journée'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }