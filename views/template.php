
<?php

session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>CDMYPE</title>

  <link rel="icon" href="views/img/plantilla/ico.png">

  <!-- REQUIRED CSS -->

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="views/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <!-- JQUERY UI -->
  <link rel="stylesheet" href="views/plugins/jquery-ui/jquery-ui.min.css">

    <!-- BOOTSTRAP DATEPICKER -->
    <link rel="stylesheet" href="views/plugins/datepicker/css/bootstrap-datepicker.min.css">

    <!-- TOASTR -->
    <link rel="stylesheet" href="views/plugins/toastr/toastr.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


<!--    css personalizados-->
  <link rel="stylesheet" href="views/css/plantilla.css">
  <link rel="stylesheet" href="views/css/compras.css">


  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="views/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables -->
  <script src="views/plugins/datatables/jquery.dataTables.js"></script>
  <script src="views/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <script src="views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.min.js"></script>

  <!-- SweetAlert 2 https://sweetalert2.github.io/-->
  <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>

  <!-- Moment -->
  <script src="views/plugins/moment/moment.min.js"></script>
  <script src="views/plugins/moment/moment-with-locales.min.js"></script>

  <!-- JQUERY UI-->
  <script src="views/plugins/jquery-ui/jquery-ui.min.js"></script>

   <!-- JS RENDER-->
  <script src="views/plugins/js-render/js-render.js"></script>

  <!-- TOASTR-->
  <script src="views/plugins/toastr/toastr.min.js"></script>

  <!-- bootstrap datepicker -->
  <script src="views/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>

</head>

<body class="hold-transition sidebar-mini login-page sidebar-collapse">

<?php

  if ( isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok" ) {

   echo '<div class="wrapper">';

    /*=============================================
    CABEZOTE
    =============================================*/

    include "modules/navbar.php";

    /*=============================================
    MENU
    =============================================*/

    include "modules/menu.php";

    /*=============================================
    CONTENIDO
    =============================================*/

    if ( isset($_GET["ruta"]) ) {

      if ( $_GET["ruta"] == "inicio" ||
         $_GET["ruta"] == "insumos" ||
         $_GET["ruta"] == "proveedores" ||
         $_GET["ruta"] == "compras" ||
         $_GET["ruta"] == "nueva-compra" ||
         $_GET["ruta"] == "salir" ) {

        include "modules/".$_GET["ruta"].".php";

      } else {

        include "modules/404.php";

      }

    } else {

      include "modules/inicio.php";

    }

    /*=============================================
    FOOTER
    =============================================*/

    include "modules/footer.php";


    echo '</div>';

  } else {

    include "modules/login.php";

  }

  ?>

<!--Javascript Personalizado-->
<script src="views/js/insumos.js"></script>
<script src="views/js/proveedores.js"></script>
<script src="views/js/compras.js"></script>
<script src="views/js/dtes.js"></script>

</body>
</html>
