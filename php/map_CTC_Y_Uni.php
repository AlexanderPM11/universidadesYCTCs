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
$url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vS7VeX15PiZbZvky2BeMhelMusqrZXJb_HNtlLQ8DDXM6BB0oZD99GaX3UHPFL2KLLXHr51-bgyZTvO/pub?gid=0&single=true&output=csv";
$info1 = readUrl($url);
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

<?php include("closeHeader.php") ?>

<?php include("cuerpo_Nav.php") ?>

<body>
    <div class="title">
        <h1>Lista de universidades y CTCs</h1>
    </div>
    <div id="map">
        <script>
            var arraInfoFromPhp = <?php echo json_encode($info) ?>;
            var arraInfoFromPhp1 = <?php echo json_encode($info1) ?>;
            var map = L.map('map').setView([18.9100957, -71.5747579], 7.5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            let i = 0;
            let x = 0;
            var greenIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            arraInfoFromPhp1.forEach(uni => {
                console.log(arraInfoFromPhp1[i]["Longitud"]);
                console.log(arraInfoFromPhp1[i]["Latitud"]);

                L.marker([arraInfoFromPhp1[i]["Longitud"], arraInfoFromPhp1[i]["Latitud"]], {
                        icon: greenIcon
                    })
                    .addTo(map).bindPopup(`${`<b>`}Universidad:${`<br>`}

                        Nombre: ${ arraInfoFromPhp1[i]["Nombre"]+`<br>`}
                        Siglas: ${arraInfoFromPhp1[i]["Siglas"]+`<br>`}
                        Direccion: ${arraInfoFromPhp1[i]["Direccion"]+`<br>`}
                        Telefono: ${arraInfoFromPhp1[i]["Telefono"]+`<br>`}                
                        `, title = arraInfoFromPhp1[i]["Nombre"])
                i++;
            });

            arraInfoFromPhp.forEach(cts => {
                L.marker([arraInfoFromPhp[x]["Longitud"], arraInfoFromPhp[x]["Latitud"]]).addTo(map).bindPopup(`${`<b>`}CTCs:${`<br>`}
                Nombre: ${ arraInfoFromPhp[x]["Nombre"]+`<br>`}
                Direccion: ${arraInfoFromPhp[x]["Direccion"]+`<br>`}
                Telefono: ${arraInfoFromPhp[x]["Telefono"]+`<br>`}                
                `, title = arraInfoFromPhp[x]["Nombre"])
                x++;
                console.log(i)
            });
        </script>
    </div>

    <?php include("pieNav.php") ?>