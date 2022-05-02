<?php
if (isset($_POST["nombre"])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $comentario = $_POST["comentario"];

    // $emailSend = mail(
    //     "alexanderrpolanco11@gmail.com",
    //     $nombre . $apellido,
    //     "Este es mi correo: " . $email . " 
    // \n Este es mi numero telefonico: " . $telefono,
    //     $comentario
    // );

    // if ($emailSend) {
    //     echo "Exitoso";
    // } else {
    //     echo "Something is wrong";
    // }


    $token = "5170670162:AAENw0yNaX2J_9CE2y-mdwtKBEZ-P8C9N5M";
    $id = "1435451153";
    $urlMsg = "https://api.telegram.org/bot{$token}/sendMessage";
    $msg = "\n
         Nombre: $nombre \n
         Apellido: $apellido\n
         Telefono: $telefono\n
         Email: $email\n
         Comentario: $comentario\n
         ";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urlMsg);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$id}&parse_mode=HTML&text=$msg");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);


    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    // $token = '5170670162:AAENw0yNaX2J_9CE2y-mdwtKBEZ-P8C9N5M';

    // $datos = [
    //     'chat_id' => '1435451153',
    //     #'chat_id' => '@el_canal si va dirigido a un canal',
    //     'text' => 'El mensaje con *formato* que el bot va a enviar, los puntos van escapados con barra invertida\. Un enlace a un [sitio](https://www.sitio.com/)\.',
    //     'parse_mode' => 'MarkdownV2' #formato del mensaje
    // ];
    // $ch = curl_init();

    // curl_setopt($ch, CURLOPT_URL, 'https://api.telegram.org/bot' . $token . '/sendMessage');
    // curl_setopt($ch, CURLOPT_HEADER, false);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($ch, CURLOPT_POST, TRUE);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $datos);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // $r_array = json_decode(curl_exec($ch), true);

    // if ($r_array['ok'] == 1) {
    //     echo "Mensaje enviado.";
    // } else {
    //     echo "Mensaje no enviado.";
    //     print_r($r_array);
    // }
    // curl_close($ch);


    // $token = "5170670162:AAENw0yNaX2J_9CE2y-mdwtKBEZ-P8C9N5M";
    // $datos = [
    //     'chat_id' => '1435451153',
    //     #'chat_id' => '@el_canal si va dirigido a un canal',
    //     'text' =>
    //     "\n
    //     Nombre: $nombre \n
    //     Apellido: $apellido\n
    //     Telefono: $telefono\n
    //     Comentario: $comentario\n
    //     "
    // ];
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot" . $token . "/sendMessage");
    // curl_setopt($ch, CURLOPT_HEADER, false);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($ch, CURLOPT_POST, TRUE);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $datos);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $r_array = json_decode(curl_exec($ch), true);

    // // curl_close($ch);
    // // if ($r_array['ok'] == 1) {
    // //     echo "Mensaje enviado.";
    // // } else {
    // //     echo "Mensaje no enviado.";
    // //     print_r($datos);
    // // }
    // print_r($datos);
}

?>


<?php include("head.php") ?>


<link rel="stylesheet" href="../css/formulario.css">
<title>Sugerencia</title>
<?php include("closeHeader.php") ?>

<?php include("cuerpo_Nav.php") ?>
<div class="contFomr">
    <form action="sugerencia.php" method="post" class="formula">
        <input class="input" type="text" placeholder="Nombre" autocomplete="off" name="nombre">
        <input class="input" type="text" placeholder="Apellido" autocomplete="off" name="apellido">
        <input class="input" type="email" placeholder="Email" autocomplete="off" name="email">
        <input class="input" type="text" placeholder="Telefono" autocomplete="off" name="telefono">
        <textarea class="input" name="comentario" placeholder="Comentario" id="" cols="30" rows="5"></textarea>
        <input type="submit" class="btn_Submit" value="Enviar">
    </form>
</div>



<script>
    if (window.history.replaceState) { // verificamos disponibilidad
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<?php include("pieNav.php") ?>