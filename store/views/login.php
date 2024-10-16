<div class="contenedor-center">
    <div class="centrar">
        <h5><b>Iniciar Sesión</b></h5>
        <form id="Data-Login">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-solid fa-circle-user"></i>
                </span>
                <input type="text" class="form-control" placeholder="Usuario" required name="user">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-solid fa-key"></i>
                </span>
                <input type="password" class="form-control" placeholder="Contraseña" required name="passw">
            </div>
            <div class="centrar">
                <button class="btn btn-primary"><b>Acceder</b></button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#Data-Login").on("submit", function(e){
            e.preventDefault();
            let formData = new FormData(document.getElementById("Data-Login"));

            formData.append("dato","valor");
            $.ajax({
                url: "./controllers/login.php",
                type: "post",
                dataType: "html",
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            }).done(function(result){
                $("#principal").html(result);
            });
            return false;
        });
    });
</script>