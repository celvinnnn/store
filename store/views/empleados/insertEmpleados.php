<?php
include '../../models/conexion.php';
include '../../models/funciones.php';
include '../../controllers/funciones.php';

$empleados = $_POST['empleados'];
$clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);
$tipo = $_POST['tipo'];
$estado = 1;
$campos = "empleados,clave,tipo,estado";
$val_cond = "'$empleados','$clave','$tipo','$estado'";
$insert = CRUD("empleadoss", $campos,$val_cond,"empleados", $usuario, "I");
?>
<script>
    $(document).ready(function() {
        let msj;
        <?php if ($insert == 1): ?>
            msj = 'EMpleado registrado';
        <?php elseif ($insert == 3): ?>
            msj = 'EMpleado ya registrado';
        <?php else: ?>
            msj = 'Error, usuario no registrado';
        <?php endif; ?>
       
            $.ajax({
                url: './views/empleados/empleados.php',
                type: 'post',
                data: {
                    msj: msj
                },
                success: function(response) {
                    $("#DataPanelEmpleadosRoles").html(response);
                }
            });
        return false;
    });
</script>