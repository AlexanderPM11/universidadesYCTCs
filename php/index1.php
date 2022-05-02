<?php
// "https://docs.google.com/spreadsheets/d/e/2PACX-1vS7VeX15PiZbZvky2BeMhelMusqrZXJb_HNtlLQ8DDXM6BB0oZD99GaX3UHPFL2KLLXHr51-bgyZTvO/pub?gid=0&single=true&output=csv"
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

?>



<?php include("head.php") ?>

<title>Project 1</title>
<?php include("closeHeader.php") ?>

<?php include("cuerpo_Nav.php") ?>
<!-- ------------------------------------------------------------------------------- -->
<div class="bienvenida">
    <div class="contTituloBienvenida">
        <div class="contbienvenidaH1">
            <h1 class="bienvenidaH1" id="inicio">
                Universidades y CTCs en República Dominicana
            </h1>
        </div>

        <p class="info Univer">
            La República Dominicana cuenta con diversas universidades que están
            repartidas en todo el país. Se ofrece la oportunidad de estudiar de
            forma pública o privada, dependiendo la situacion ecónomica de cada
            estudiante, de manera que no hay excusa para seguir ampliando el conocimiento
            una vez se finalice el bachillerato.
        </p>
        <p class="info CTC">
            A nivel de Centro Tecnológico (CTC), en el pais se dispone de una cantidad
            inmensa de centro de este tipo, donde el estudiante de manera gratuita puede
            adquierir conocimientos tecnológico, sin ningún impedimiento en lo relacionado
            a lo monetario. Esta es otra opción por la que puede optar el jovén para diversificar
            sus conocimientos.
        </p>
    </div>
</div>

<!-- listado de las universidades -->
<div class="conteinerUniver">
    <div class="contTitulo">
        <h1 class="contH1Title" id="universidad">Algunas Universidades </h1>
    </div>

    <?php
    $url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vS7VeX15PiZbZvky2BeMhelMusqrZXJb_HNtlLQ8DDXM6BB0oZD99GaX3UHPFL2KLLXHr51-bgyZTvO/pub?gid=0&single=true&output=csv";
    $info1 = readUrl($url);
    foreach ($info1 as $key => $datos) {
    ?>

        <div class="listUniver" title="Click para ampliar" id=<?php print_r($key); ?>>
            <div class="imgCont">
                <img src=<?php print_r($info1[$key]["Foto"]); ?> alt="">
            </div>
            <h1 class="titulo_Univer"> <?php print_r($info1[$key]["Nombre"]); ?></h1>
            <p><b> Siglas: </b><?php print_r($info1[$key]["Siglas"]); ?></p>
            <p><b>Direccion:</b> <?php print_r($info1[$key]["Direccion"]); ?></p>
            <p><b>Telefono:</b> <?php print_r($info1[$key]["Telefono"]); ?></p>
            <p><b>Pagina web:</b> <a target="blan_K" href=<?php print_r($info1[$key]["Page_Web"]); ?>>Web</a></p>
        </div>
    <?php } ?>
</div>

<!-- ------------------------------------------------------------------------------- -->
<!-- listado de las CTCs -->
<div class="conteinerUniver">
    <div class="contTitulo">
        <h1 class="contH1CTCs" id="CTCs">Algunos CTCs </h1>
    </div>

    <?php
    $url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vTQ-dtxTrnSY260MoaeUNYr6Y8-fuU39B776ROGLugI6Nuba5taE4GNMJhBozDucyFYjwgGYQuUoD1T/pub?gid=0&single=true&output=csv";
    $info = readUrl($url);
    foreach ($info as $key => $datos) {
    ?>

        <div class="listUniver1" title="Click para ampliar" id=<?php print_r($key); ?>>
            <div class="imgCont">
                <img src=<?php print_r($info[$key]["Foto"]); ?> alt="">
            </div>
            <h1 class="titulo_Univer"> <?php print_r($info[$key]["Nombre"]); ?></h1>
            <p><b>Direccion:</b> <?php print_r($info[$key]["Direccion"]); ?></p>
            <p><b>Telefono:</b> <?php print_r($info[$key]["Telefono"]); ?></p>
            <p><b>Pagina web:</b> <a target="blan_K" href=<?php print_r($info[$key]["Page_Web"]); ?>>Web</a></p>
        </div>
    <?php } ?>
</div>
<!-- ------------------------------------------------------------------------------- -->


<!-- Desarrollo del modal -->

<div class="modal fade" id="EjemploModal" tabindex="-1" role="dialog" aria-labelledby="EjemploModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EjemploModalLabel">
                    Detalles
                </h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="img_" src="" class="img" alt="">
                <h1 class="nameUni"></h1>
                <p class="siglasModal"></p>
                <p class="dirrecionModal"></p>
                <p class="teleModal"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cerrar
                </button>
                <a class="btn btn-primary" target="_blank" href="#">
                    ver página web
                </a>
            </div>
        </div>
    </div>
</div>
<!-- ------------------------------------------------------------------------------- -->
<!-- Function para ver modal -->
<script>
    function showModal() {
        $(".modal").modal("show");
    }
    // Escuha de los div CTCs
    var arraInfoFromPhp = <?php echo json_encode($info) ?>;
    const div = document.querySelectorAll(".listUniver1");
    div.forEach(divBtn => {
        divBtn.addEventListener("click", () => {
            let id = divBtn.getAttribute("id")
            const siglas = document.querySelector(".siglasModal");
            siglas.style.display = "none";
            const img_Uni = document.querySelector(".img_");
            img_Uni.setAttribute("src", (arraInfoFromPhp[id]["Foto"]));
            const btn_primary = document.querySelector(".btn-primary");
            btn_primary.setAttribute("href", (arraInfoFromPhp[id]["Page_Web"]));
            const nameUni = document.querySelector(".nameUni");
            nameUni.textContent = (arraInfoFromPhp[id]["Nombre"]);
            const dirrecionModal = document.querySelector(".dirrecionModal");
            dirrecionModal.innerHTML = `<b>` + "Dirección: " + `</b>` + (arraInfoFromPhp[id]["Direccion"]);
            const teleModal = document.querySelector(".teleModal");
            teleModal.innerHTML = `<b>` + " Telefono:" + `</b>` + (arraInfoFromPhp[id]["Telefono"]);
            showModal();
        });
    });
    // Escuha de los div Universidades
    var arraInfoFromPhp1 = <?php echo json_encode($info1) ?>;
    const div1 = document.querySelectorAll(".listUniver");
    div1.forEach(divBtn => {
        divBtn.addEventListener("click", () => {
            let id = divBtn.getAttribute("id")
            const img_Uni = document.querySelector(".img_");
            img_Uni.setAttribute("src", (arraInfoFromPhp1[id]["Foto"]));
            const btn_primary = document.querySelector(".btn-primary");
            btn_primary.setAttribute("href", (arraInfoFromPhp1[id]["Page_Web"]));
            const nameUni = document.querySelector(".nameUni");
            nameUni.textContent = (arraInfoFromPhp1[id]["Nombre"]);
            const siglasModal = document.querySelector(".siglasModal");
            siglasModal.style.display = "block";
            siglasModal.innerHTML = `<b>` + " Siglas:" + `</b>` + (arraInfoFromPhp1[id]["Siglas"]);
            const dirrecionModal = document.querySelector(".dirrecionModal");
            dirrecionModal.innerHTML = `<b>` + "Dirección: " + `</b>` + (arraInfoFromPhp1[id]["Direccion"]);
            const teleModal = document.querySelector(".teleModal");
            teleModal.innerHTML = `<b>` + " Telefono:" + `</b>` + (arraInfoFromPhp1[id]["Telefono"]);
            showModal();
        });
    });
</script>
<!-- ------------------------------------------------------------------------------- -->




<?php include("pieNav.php") ?>