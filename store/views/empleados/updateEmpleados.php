<?php
include '../../models/conexion.php';
include '../../models/funciones.php';
include '../../controllers/funciones.php';

$idempleado = $_POST['idempleado'];
$empleado = $_POST['empleado'];
$num = $_POST['num'];
$num_reg = $_POST['num_reg'];
$tipo = $_POST['tipo'];

if (strlen($_POST['clave']) != 0) {
    $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);
    $campos = "empleado='$empleado',clave='$clave',tipo='$tipo'";
} else {
    $campos = "empleado='$empleado',tipo='$tipo'";
}
$val_cond = "idempleado='$idempleado'";
$update = CRUD('empleados', $campos, $val_cond, '', '', 'U');
?>
<script>
    $(document).ready(function() {
        let num = '<?php echo $num; ?>';
        let num_reg = '<?php echo $num_reg; ?>';
        let msj;
        <?php if ($update): ?>
            msj = 'Empleado actualizado';
        <?php else: ?>
            msj = 'Empleado no actualizado';
        <?php endif; ?>

        $.ajax({
                url: './views/empleados/empleados.php',
                type: 'post',
                data: {
                    num: num,
                    num_reg: num_reg,
                    msj: msj
                },
                success: function(response) {
                    $("#DataPanelEmpleadosRoles").html(response);
                }
            });
        return false;
    });
</script>