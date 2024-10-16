<?php 
    include './models/conexion.php';
    $con = new ConexionBD();
    $con->getConexion();
?>
<a class="btn" id="acceso-login" style="background-color: #39774e; color: white; margin-top: 5px; float: right; overflow: auto;">
    <i class="fa-solid fa-right-to-bracket"></i>
</a>

<div class="row">

</div>

<script>
    $(document).ready(function() {
        $("#acceso-login").click(function() {
            $("#principal").load("./views/login.php");
            return false;
        });
    });
</script>