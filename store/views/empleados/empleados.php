<?php
include '../../models/conexion.php';
include '../../models/funciones.php';
include '../../controllers/funciones.php';

if (isset($_POST['num'])) {
    $pagina = $_POST['num'];
} else {
    $pagina = 0;
}

if (isset($_POST['num_reg'])) {
    $registros = $_POST['num_reg'];
} else {
    $registros = 5;
}

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
} else {
    $inicio = ($pagina - 1) * $registros;
}

if (isset($_POST['rol_tipo'])) {
    $rol_tipo = $_POST['rol_tipo'];
    $condicion = "tipo='$rol_tipo' ORDER BY usuario ASC LIMIT $inicio,$registros";
    $dataUsuarios = CRUD('empleados', '*', $condicion, '', '', 'SC');
    $query = 'SELECT * FROM empleados WHERE tipo="' . $rol_tipo . '" ORDER BY usuario ASC';
} elseif (isset($_POST['valor'])) {
    $valor = $_POST['valor'];
    $condicion = "usuario LIKE '%$valor%' ORDER BY usuario ASC $inicio,$registros";
    $dataempleados = CRUD('empleados', '*', $condicion, '', '', 'SC');
    $query = 'SELECT * FROM empleados WHERE usuario LIKE "%' . $valor . '%" ORDER BY usuario ASC LIMIT';
} else {
    $rol_tipo = 0;
    $tabla = "empleados LIMIT $inicio,$registros";
    $dataempleados = CRUD($tabla, '*', '', '', '', 'S');
    $query = "SELECT * FROM empleados";
}

$dataRoles = CRUD('roles', '*', '', '', '', 'S');
$num_regisros = CountReg($query);
$paginas = ceil($num_regisros / $registros);
$cont = 0;
?>
<div class="table-responsive-xl">
    <div class="row">
        <div class="col-md-6">
            <a href="" class="btn btn-primary btn-sm" id="ModalInsertEmpleado"><i class="fa-solid fa-user-plus"></i></a>
            <a href="" class="btn btn-warning btn-sm Reloadempleados"><i class="fa-solid fa-repeat"></i></a>
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01"><b>Tipo/Rol</b></label>
                <select class="form-select" id="tipo-rol">
                    <option disabled selected>Seleccione Tipo/Rol</option>
                    <?php foreach ($dataRoles as $result): ?>
                        <option value="<?php echo $result['idrol']; ?>"><?php echo $result['rol']; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <hr>
    <table class="table table-borderless Tableempleados">
        <thead class="centrar">
            <tr>
                <th>Nº</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Tipo/Rol</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody class="centrar">
            <?php foreach ($dataempleados as $result): ?>
                <tr>
                    <td><?php echo $cont += 1; ?></td>
                    <td><?php echo $result['usuario']; ?></td>
                    <td><?php echo ($result['estado'] == 1) ? 'Habilitado' : 'Deshabilitado'; ?></td>
                    <td><?php echo buscavalor('roles', 'rol', 'idrol="' . $result['tipo'] . '"'); ?></td>
                    <td>
                        <?php if ($result['estado'] == 1): ?>
                            <a href="" class="btn btn-sm btn-warning BtnBloqueaUsuario" idusuario="<?php echo $result['idusuario']; ?>" valor="0">
                                <i class="fa-solid fa-user-large-slash"></i>
                            </a>
                        <?php else: ?>
                            <a href="" class="btn btn-sm BtnBloqueaUsuario" idusuario="<?php echo $result['idusuario']; ?>" valor="1" style="background-color: #03376b;color:white;">
                                <i class="fa-solid fa-user-check"></i>
                            </a>
                        <?php endif ?>

                    </td>
                    <td>
                        <a href="" class="btn btn-sm btn-success BtnModalUpdateUsuario" idusuario="<?php echo $result['idusuario']; ?>">
                            <i class="fa-solid fa-user-pen"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php if ($num_regisros > $registros) : ?>
        <?php if ($pagina == 1) : ?>
            <div style="text-align: center;">
                <a href="" class="btn btn-sm btnBloqueado" v-num="<?php echo ($pagina - 1); ?>" num-reg="<?php echo $registros; ?>">
                    <i class="fa-solid fa-circle-left fa-2x"></i>
                </a>

                <a href="" class="btn pagina btn-sm btnPaginadoActivo" v-num="<?php echo ($pagina + 1); ?>" num-reg="<?php echo $registros; ?>">
                    <i class="fa-solid fa-circle-right fa-2x"></i>
                </a>
            </div>
        <?php elseif ($pagina == $paginas) : ?>
            <div style="text-align: center;">
                <a href="" class="btn pagina btn-sm btnPaginadoActivo" v-num="<?php echo ($pagina - 1); ?>" num-reg="<?php echo $registros; ?>">
                    <i class="fa-solid fa-circle-left fa-2x"></i>
                </a>
                <a href="" class="btn btn-sm btnBloqueado" v-num="<?php echo ($pagina + 1); ?>" num-reg="<?php echo $registros; ?>">
                    <i class="fa-solid fa-circle-right fa-2x"></i>
                </a>
            </div>
        <?php else : ?>
            <div style="text-align: center;">
                <a href="" class="btn pagina btn-sm btnPaginadoActivo" v-num="<?php echo ($pagina - 1); ?>" num-reg="<?php echo $registros; ?>">
                    <i class="fa-solid fa-circle-left fa-2x"></i>
                </a>

                <a href="" class="btn pagina btn-sm btnPaginadoActivo" v-num="<?php echo ($pagina + 1); ?>" num-reg="<?php echo $registros; ?>">
                    <i class="fa-solid fa-circle-right fa-2x"></i>
                </a>
            </div>
        <?php endif ?>
    <?php endif ?>
    <div class="alert colorNavbar" style="text-align:center;margin-top:15px;color:white;">
        <?php echo "<b>P&aacute;gina: " . $pagina . ' / ' . $paginas . "</b>"; ?>
    </div>
</div>
<?php if (isset($_POST['msj'])): ?>
    <script>
        $(document).ready(function() {
            alertify.alert("empleados", "<?php echo $_POST['msj']; ?>");
            return false;
        });
    </script>
<?php endif ?>
<script>
    $(document).ready(function() {
        /* Paginado */
        $(".pagina").click(function() {
            let num, reg, rol_tipo;
            num = $(this).attr("v-num");
            reg = $(this).attr("num-reg");
            rol_tipo = '<?php echo $rol_tipo; ?>';
            if (rol_tipo != 0) {
                $.ajax({
                    url: './views/empleados/empleados.php',
                    type: 'post',
                    data: {
                        num: num,
                        num_reg: reg,
                        rol_tipo: rol_tipo
                    },
                    success: function(response) {
                        $("#DataPanelempleadosRoles").html(response);
                    }
                });
            } else {
                $.ajax({
                    url: './views/empleados/empleados.php',
                    type: 'post',
                    data: {
                        num: num,
                        num_reg: reg
                    },
                    success: function(response) {
                        $("#DataPanelempleadosRoles").html(response);
                    }
                });
            }
            return false;
        });

        /* Buscador Tipo/Rol */
        $("#tipo-rol").on("keyup change", function() {
            let num, reg;
            num = '<?php echo $pagina; ?>';
            reg = '<?php echo $registros; ?>';
            let tipo_rol = $(this).val();
            $.ajax({
                url: './views/empleados/empleados.php',
                type: 'post',
                data: {
                    rol_tipo: tipo_rol,
                    num: num,
                    num_reg: reg
                },
                success: function(response) {
                    $("#DataPanelempleadosRoles").html(response);
                }
            });
        });

        /* Recargar Panel empleados */
        $(".Reloadempleados").click(function() {
            $("#DataPanelempleadosRoles").load('./views/empleados/empleados.php');
            return false;
        });


        /* Modal Insertar Usuario */
        $("#ModalInsertEmpleado").click(function() {
            $("#Modal-IU").modal("show");
            $("#Data-IU").load("./views/empleados/formInsertEmpleados.php");
            // Obtener el elemento por su ID y cambiar el texto
            document.getElementById("titulo-header-IU").innerText = "Registrar Empleado";
            document.getElementById("btn-accion-IU").innerText = "Guardar";
            return false;
        });


        /* Formulario Actualizar Empleado */
        $(".BtnModalUpdateEmpleado").click(function() {
            let idempleado = $(this).attr("idempleado");
            let num, reg;
            num = '<?php echo $pagina; ?>';
            reg = '<?php echo $registros; ?>';
            $("#Modal-IU").modal("show");
            $("#Data-IU").load("./views/empleados/formUpdateempleados.php?idempleado=" + idempleado + "&num=" + num + "&num_reg=" + reg);
            document.getElementById("titulo-header-IU").innerText = "Actualizar Empleado";
            document.getElementById("btn-accion-IU").innerText = "Actualizar";
            return false;
        });


        /* Proceso de Insert ó Update Usuario */
        $("#Acciones-IU").click(function() {
            let accion = $("#accion").val();
            let idempleado = $('[name="idempleado"]').val();
            let emoidempleado = $('[name="emoidempleado"]').val();
            let clave = $('[name="clave"]').val();
            let tipo_rolI = $("#tipo-rol-I").val();
            let tipo_rolU = $("#tipo-rol-U").val();
            let num = $('[name="num"]').val();
            let num_reg = $('[name="num_reg"]').val();

            if (accion == "insert") {
                if (tipo_rolI == null || tipo_rolI === "") {
                    alertify.alert("Registro Empleado", "Favor de seleccionar el tipo ó rol del empleado....");
                } else {
                    $.ajax({
                        url: "./views/empleados/insertEmpleados.php",
                        type: "POST",
                        dataType: "html",
                        data: {
                            tipo: tipo_rolI,
                            usuario: usuario,
                            clave: clave
                        },
                        success: function(result) {
                            $("#Modal-IU").modal("hide");
                            $("#DataPanelempleadosRoles").html(result);
                        }
                    });
                }
            } else {
                $.ajax({
                    url: "./views/empleados/updateEmpleados.php",
                    type: "POST",
                    dataType: "html",
                    data: {
                        idusuario: idusuario,
                        usuario: usuario,
                        clave: clave,
                        tipo: tipo_rolU,
                        num: num,
                        num_reg: num_reg // Corregido: usar num_reg en lugar de reg
                    },
                    success: function(result) {
                        $("#Modal-IU").modal("hide");
                        $("#DataPanelempleadosRoles").html(result);
                    }
                });
            }
            return false;
        });



        /* Bloqueo empleados */
        $(".BtnBloqueaUsuario").click(function() {
            let idusuario = $(this).attr("idusuario");
            let valor = $(this).attr("valor");
            let num, reg;
            num = '<?php echo $pagina; ?>';
            reg = '<?php echo $registros; ?>';
            $.ajax({
                url: './views/empleados/bloqueaUsuario.php',
                type: 'post',
                data: {
                    idusuario: idusuario,
                    valor: valor,
                    num: num,
                    num_reg: reg
                },
                success: function(response) {
                    $("#DataPanelempleadosRoles").html(response);
                }
            });
            return false;
        });
    });
</script>