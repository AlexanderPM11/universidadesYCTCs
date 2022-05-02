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
$url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vRWQSowd-wCXKim0nW2mteJ1KPpnlsFEzr7hw0fgAN38JycoXfmw8ftOdVxlwwqj4d7F2lvqcHYGr2i/pub?gid=0&single=true&output=csv";
$info = readUrl($url);
$url1 = "https://docs.google.com/spreadsheets/d/e/2PACX-1vRNWAo5ZHOLTC2QpjAdfGVAENdB_jF-2OaXvd-20Z7-2TmedIxdwFPB02-Q0Uj4EveielgP9PF-WA2R/pub?gid=0&single=true&output=csv";
$info1 = readUrl($url1);


?>

<?php include("head.php") ?>


<link rel="stylesheet" href="../css/videoF.css">
<title>Sugerencia</title>
<?php include("closeHeader.php") ?>

<?php include("cuerpo_Nav.php") ?>

<body>


    <div class="container">
        <div class="contTitle">
            <h1 class="H1title">Videos sobre Universidades del país</h1>
        </div>
        <?php
        foreach ($info as $key => $video) {
        ?>
            <div class="contVideo">
                <?php print_r($info[$key]["Link"]); ?>
            </div>
        <?php } ?>

        <div class="contTitle">
            <h1 class="H1CTCsTitle H1title">Videos sobre CTCs del país</h1>
        </div>
        <?php
        foreach ($info1 as $key => $video) {
        ?>
            <div class="contVideo">
                <?php echo ($info1[$key]["Link"]); ?>
            </div>
        <?php } ?>
    </div>

    <script>
        var vdeo = <?php echo json_encode($info) ?>;
        console.log(vdeo);
    </script>





    <?php include("pieNav.php") ?>