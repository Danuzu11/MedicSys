<?php

class Afiliado {
    public $nombre;
    public $apellido;
    public $fecha;
    public $cedula;

    public function __construct($nombre, $apellido, $fecha, $cedula) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fecha = $fecha;
        $this->cedula = $cedula;
    }
}

// Crear objetos Afiliado
$afiliado1 = new Afiliado("Juan", "Perez", "1990-05-15", "123456789");
$afiliado2 = new Afiliado("Maria", "Gomez", "1985-10-20", "987654321");
$afiliado3 = new Afiliado("Pedro", "Lopez", "1998-03-01", "456789123");

// Crear droplist con los nombres y apellidos de los afiliados
$afiliados = $afiliadosArray;

// Esto es importante, dependiendo del tipo de usuario que sea va cambiar su limite de afiliados
$limite_de_afiliados = 10000000;

if($the_user_rol == 2){
   
    //  por ejemplo deberia ser 3 si fuera un usuario comun
    $limite_de_afiliados = 3;
    
}


$cadena_mensaje_limite = "";

if($limite_de_afiliados <= 3){
    $cadena_mensaje_limite = "/ 3";
  
}

?>
<!DOCTYPE html>
<html lang="en" class="mainView h-full bg-slate-900 flex">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Medicos</title>
<script>


console.log(obj);


    if (document.getElementById('btn-logout')) {
        const btnLogout = document.getElementById('btn-logout');

        // Agregar un evento click al botón
        btnLogout.addEventListener('click', (event) => {

            // Detener el comportamiento normal del botón
            event.preventDefault();

            // Alerta si confirma deslogeo
            swal({
                title: "Deslogeando..",
                text: "¿Estás seguro de que quieres cerrar sesión?",
                icon: "warning",
                dangerMode: true,
                buttons: ["Ok", "Cancel"],
            }).then((logout) => {
                    if (!logout) {
                        swal("Se ah deslogeado exitosamente", {
                            icon: "success",
                        }).then((success) => {
                            // window.location.href = 'users/logout';
                        });
                    } else {
                        swal("No se ah deslogeado");
                    }
                });

        });
    }


</script>

<style>
    /* estilos de las letras */
    .menu-lateral {
        color: white;
        position: relative;
        padding-top: 20px;
        width: 100%;
        max-width: 250px;
        left: 0;
        top: 0;
    }

    .menu-lateral nav {
        padding-top: 30px;
    }

    .menu-lateral li {
        font-size: 14px;
    }

    .menu-lateral nav a {
        display: block;
        text-decoration: none;
        padding: 20px;
    }

    .menu-lateral nav a:hover {
        border-left: 5px solid #c7c7c7;
        background: #1f1f1f;
    }

    .image-and-text {
        display: flex;
        align-items: center;
    }

    .image-and-text img {
        max-width: 70px;
        max-height: 70px;
    }
    /* finde */


    /* estilos de las letras */
    ul {
        color: white;
    }

    h1 {
        font-size: 24px;
        color: white;
    }

    p, label {
        font-size: 12px;
        color: #959ea9;
        font-weight: bold;
        
    }

    h2 {
        font-size: 24px;
        color: white;
        font-weight: bold;
    }

    /* finde */

    /* estilos de las logos */
    .logoBienvenida img {
        width: 800px;
        max-height: 150px;
    }

    .logoBienvenida {
        display: flex;
        align-items: center;
    }

    /* finde */


    /*Clases para la seccion ajustes  dv*/



    .body-width{
        width: 100%;
    }


  

    .img-aling{
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-right: 3px;
    }

    .select_style{
        max-height: 30px;
        border-radius: 0.375rem;
        margin-left: 10px;
        min-width: 300px;

    }
    .container-all{
        margin-left: 30px;
        margin-top: 30px;
        width: 100%;
        margin-right: 30px;
    }
    .container-up{
        padding-left: 20px;
        height: 70px;
        width: 100%;
        display: flex; 
        justify-content: space-between; 
        align-items: center;
        background-color: #020617;
        border-radius: 15px;
    }
    .boton-deco{
        background-color: #EB6060;
        margin-right: 30px;
    }
    .boton-edit{
        background-color: green;
   
    }
    .boton-delete{
        background-color: red;
        margin-left: 30px;
   
    }
    button{
        border-radius: 25px;

        height: 30px;
        font-size: 14px;
        color: white;
        width: 100px;        
    }
    .container-center{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .aling-row{
        display: flex;
        justify-content: center;
        border-radius: 25px;
        padding-top: 20px;
        padding-bottom: 20px;
        margin-left: 30px;
        margin-right: 30px;
        margin-top: 80px;
        padding-right: 60px;
        padding-left: 60px;
        min-width: 500px;
        min-height: 200px;
        width: 80%; 
        background-color: #020617;
        flex-direction: column;
        height: 300px;
    }
    .move-the-button{
        display: flex;
        justify-content: right;  
        flex-direction: row;      
    }
    #datosAfiliado{
        background-color: #020617;
        display: flex;
        align-items: center;
        justify-content: center; /* Agrega esta línea */

    }

    .words-deco{
        font-size: 20px;
    }
    .img-afiliado{
        margin-right: 30px;
        min-width: 100px;
        min-height: 100px;
    }
    .l{
        background-color: #EB6060;
        height: 3px;
        width: 100%;

    }
    .the-title{
        font-weight: 600;
        font-size: 24px;
        color: white;
        width:100%;
        text-align: center;
        padding-bottom: 50px;

    }
    #edit{
        display: none;
    }
    #delete{
        display: none;
    }
    /* finde */

</style>

</head>



<body class="h-full flex body-width">
    
    <!-- recorrer para crear el droplist -->

    <div class="container-all">
    <div class="the-title">Afiliados</div>
        <div class="container-up">
            <div>
                <label for="afiliado">Seleccionar afiliado:</label>

                <select name="afiliado" class="select_style" select id="selectAfiliado" onchange="mostrarDatosAfiliado()">

                    <option value="" selected>-- Seleccione una opción --</option>
                    <?php
                        foreach ($afiliados as $afiliado) {
                            echo "<option value = '" . $afiliado['nombre'] . " " . $afiliado['apellido']. "'";
                    
                            // Verificar si el afiliado es el valor por defecto
                            if ($afiliado['nombre'] == null && $afiliado['apellido']== null) {
                                echo " selected";
                            }
                    
                            echo ">" . $afiliado['nombre'] . " " . $afiliado['apellido']. "</option>";
                        }
                        
                    ?>
                </select>
            </div>

            <h1>Afiliados  <?php echo count($afiliados)?> <?php echo $cadena_mensaje_limite?></h1>    
            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'afiliados']) ?>" >
                <button class = "boton-deco" >Agregar</button> <!--Boton para enviar a pagina de registro de nuevo afiliado-->
            </a>    
        </div> 

        <div class="container-center">
            <div class="aling-row">
                <div id="datosAfiliado">

                    <img class="img-afiliado" src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/icon-usuario-afiliado.png' ?>">
                    <div id="just-words">

                    </div>
  
                </div>
                <div>
                    <!--El boton editar manda los datos del afiliado que ha selescionado 
                    para que rellene por defecto los campos en la vista de edicion,  -->
                    <div class="move-the-button">
                        <div id="edit"><button class = 'boton-edit' onclick ="editarAfiliado()"  >Editar</button></div>
                            
                        
                        <div id="delete"><button class = 'boton-delete' onclick ="eliminarAfiliado()"  >Eliminar</button></div>
                        
                    </div>
                </div>  
            </div>
        </div>   
    </div>
    
<script>
        function quitarEspacios(cadena) {
            return cadena.replace(" ", "");
        }
        function editarAfiliado() {
            var url = "<?= $this->Url->build(['controller' => 'Users', 'action' => 'editAfiliado',$afiliado['id']]) ?>";
            window.location.href = url;
        }

        function eliminarAfiliado() {
            
            var url = "<?= $this->Url->build(['controller' => 'Users', 'action' => 'eliminar_afiliado',$afiliado['id']]) ?>" ;
            window.location.href = url;
        }            

        function mostrarDatosAfiliado() {

            var selectElement = document.getElementById("selectAfiliado");
            var selectedOption = selectElement.options[selectElement.selectedIndex].value;

            var datosAfiliadoElement = document.getElementById("just-words");
            if (selectedOption !== "") {
                // Obtener nombre y apellido seleccionados
               
                

             
                // Buscar el afiliado correspondiente en el array
                <?php foreach ($afiliados as $afiliado): ?>
                    var comparar = "<?php echo "{$afiliado['nombre']}  {$afiliado['apellido']} " ?>";
                    comparar = comparar.replace(/\s+/g, '')
                    selectedOption = selectedOption.replace(/\s+/g, '')
                    console.log(comparar);
                    console.log(selectedOption);

                    if (comparar == selectedOption) {
                        
                        nuevoParrafo = document.createElement("p");
                        nuevoParrafo.classList.add("words-deco");
                        nuevoParrafo.textContent = "Fecha de Nacimiento: " + "<?php echo $afiliado['fecha_nacimiento']; ?>";
 
                        nuevoParrafo2 = document.createElement("p");
                        nuevoParrafo2.classList.add("words-deco");
                        nuevoParrafo2.textContent = "Cedula: " + "<?php echo $afiliado['cedula']; ?>";                        

                        nuevoParrafo3 = document.createElement("p");
                        nuevoParrafo3.classList.add("words-deco");
                        nuevoParrafo3.textContent = "Email: " + "<?php echo $afiliado['email']; ?>";    

                        datosAfiliadoElement.innerHTML = "<div> <p class='words-deco'>Nombre: <?php echo $afiliado['nombre']; ?>    <span>&nbsp;</span> <?php echo $afiliado['apellido']; ?></p> <div class='l'>";
                        
                        datosAfiliadoElement.appendChild(nuevoParrafo);
                        datosAfiliadoElement.appendChild(nuevoParrafo2);
                        datosAfiliadoElement.appendChild(nuevoParrafo3);

                    }
                <?php endforeach;?> 

                var buttonEdit = document.getElementById("edit");
                var buttonDelete = document.getElementById("delete");

                buttonEdit.style.display = "block";
   
                buttonDelete.style.display = "block";               
            } else {
                var buttonEdit = document.getElementById("edit");
                var buttonDelete = document.getElementById("delete");
                buttonEdit.style.display = "none";
                buttonDelete.style.display = "none";  
                datosAfiliadoElement.innerHTML = "";
            }
        
        } 
</script>
</body>

</html>



