<?php
include '../../models/conexion.php';
include '../../models/funciones.php';
include '../../controllers/funciones.php';

$idempleado = $_GET['idempleado'];
$num = $_GET['num'];
$num_reg = $_GET['num_reg'];
$condicion = "idempleado='$idempleado'";
$dataEmpleado = CRUD('empleados', '*', $condicion, '', '', 'SC');
foreach ($dataEmpleado as $result){
    $empleado = $result['empleado'];
    $clave = $result['clave'];
    $estado = $result['estado'];
    $tipo = $result['tipo'];
}
$vestado = ($estado == 1)? 'Activo': 'Desactivo';
$vtipo = buscavalor("roles","rol","idrol='$tipo'");
$condicion2 = "idrol !='$tipo'";
$dataRoles = CRUD('roles', '*', $condicion2, '', '', 'SC');
?>
<input type="hidden" id="accion" name="accion" value="udpate">
<input type="hidden" name="idempleado" value="<?php echo $idempleado;?>">
<input type="hidden" name="num" value="<?php echo $num;?>">
<input type="hidden" name="num_reg" value="<?php echo $num_reg;?>">
<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1"><b>Empleado:</b></span>
    <input type="text" class="form-control" name="empleado" value="<?php echo $empleado;?>" required>
</div>
<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1"><b>Clave</b></span>
    <input type="password" class="form-control" name="clave">
</div>
<div class="input-group mb-3">
    <label class="input-group-text" for="inputGroupSelect01"><b>Tipo/Rol</b></label>
    <select class="form-select" id="tipo-rol-U" name="tipo">
        <option value="<?php echo $tipo; ?>" selected><?php echo $vtipo; ?></option>
        <?php foreach ($dataRoles as $result): ?>
            <option value="<?php echo $result['idrol']; ?>"><?php echo $result['rol']; ?></option>
        <?php endforeach ?>
    </select>
</div>