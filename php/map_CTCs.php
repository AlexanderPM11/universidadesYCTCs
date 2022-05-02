<?php


function readUrl($url)
{
    $load_File = file_get_contents($url);
    $load_File = explode(PHP_EOL, $load_File); // Separa los elementos por salto de linea..

    $model = $load_File[0];
    $model = explode(",", $model); // Crea un arrays separado por coma..
    $datos = [];
    unset($load_File[0]);

    foreach ($load_File as $fila) {
        $fila = str_getcsv($fila); // Convierte un string con formato CSV a un array.
        $insert = [];
        foreach ($fila as $key => $value) {
            $insert[$model[$key]] = $value;
        }
        array_push($datos, $insert);
    }
    return $datos;
}
$url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vTQ-dtxTrnSY260MoaeUNYr6Y8-fuU39B776ROGLugI6Nuba5taE4GNMJhBozDucyFYjwgGYQuUoD1T/pub?gid=0&single=true&output=csv";
$info = readUrl($url);

?>


<?php include("head.php") ?>


<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/mapa_Uni1.css">
<script src="https://kit.fontawesome.com/3762365bc6.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<title>Mapa CTCs</title>
<?php include("closeHeader.php") ?>

<?php include("cuerpo_Nav.php") ?>

<body>
    <div class="title">
        <h1>Lista de CTCs</h1>
    </div>
    <!-- Funtion para mostrar mapa los CTCs -->
    <div id="map">
        <script>
            var arraInfoFromPhp = <?php echo json_encode($info) ?>;
            var map = L.map('map').setView([18.9100957, -71.5747579], 7.5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            let i = 0;
            arraInfoFromPhp.forEach(uni => {
                var longi = parseFloat(arraInfoFromPhp[i]["Longitud"]);
                var lati = parseFloat(arraInfoFromPhp[i]["Latitud"]);
                console.log(longi)
                L.marker([longi, lati]).addTo(map).bindPopup(`${`<b>`}CTCs:${`<br>`}

                        Nombre: ${ arraInfoFromPhp[i]["Nombre"]+`<br>`}
                        Direccion: ${arraInfoFromPhp[i]["Direccion"]+`<br>`}
                        Telefono: ${arraInfoFromPhp[i]["Telefono"]+`<br>`}                
                        `, title = arraInfoFromPhp[i]["Nombre"])
                i++;

            });
        </script>
        <?php include("pieNav.php") ?>