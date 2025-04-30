<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Charts in Laravel</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Données transmises depuis Laravel (encodées en JSON)
            var data = google.visualization.arrayToDataTable(@json($data));

            var options = {
                title: 'My Daily Activities'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>

    <h1>Secteur : {{ $secteur->name }}</h1>
<p>Description : {{ $secteur->description }}</p>

<h2>Commerçants</h2>
<ul>
    @foreach ($secteur->marchants as $marchant)
        <li>
            Nom : {{ $marchant->name }} - 
            Numéro d'espace : {{ $marchant->espace->numero_space ?? 'Non attribué' }}
        </li>
    @endforeach
</ul>

</body>
</html>
