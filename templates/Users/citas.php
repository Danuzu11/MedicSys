<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Afiliado $afiliados
 */
?>

<!DOCTYPE html>
<html lang="en" class="mainView h-full bg-slate-900 flex">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!-- <link rel="stylesheet" type="text/css" href="estilos.css">
        <script src="script.js"></script> -->

        <title>citas</title>

    </head>

    <body class="h-full flex">

        <div>
        <div class="menu-desplegable">
            <!-- <select id="especialidad" name="afiliado" class="rounded-md" required> -->
            <select name="afiliado" class="select_style" select id="selectAfiliado" onchange="mostrarDatosAfiliado()">
                <option style="color: green;" value=""> Seleccione a la persona de quien desea ver las citas</option>
                <option value="NULL" id="">Propietario de la cuenta </option>
                <?php foreach ($afiliados as $key => $afiliado): ?>
                    <option value="<?php echo $afiliado->id; ?>" id="<?= $afiliado->id ?>">
                        <?php echo $afiliado->nombre . ' ' . $afiliado->apellido; ?>
                    </option>
                    
                <?php endforeach; ?>

            </select>
        </div>

        <div class="bienvenida-Usuario rounded-3xl mx-4 my-8 shadow-md ">
            
        

        <div class="contenedor">

             <div>
                <h1 style="font-weight: 800;"> Tus citas</h1>
                <p>Aqui tendras un resumen de tus citas agendadas. </br></p>
            </div>

            <div class="citas-container" id='container'> 
                               
            </div> 
            
        </div>
        </div>
            
        </div>        
    </body>

</html>

<script>

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

    function mostrarDatosAfiliado() {

    var selectElement = document.getElementById("selectAfiliado");
    var selectedOption = selectElement.options[selectElement.selectedIndex].value;

    var datosAfiliadoElement = document.getElementById("container");
    if (selectedOption !== "") {

    datosAfiliadoElement.innerHTML = "";
    <?php foreach ($citas as $cita):?>

        var comparar = "<?php echo $cita['idafiliado']?>";

        if (comparar === "") {
        comparar = "NULL";
        }

        if (comparar === selectedOption) {

            <?php $medico = array_filter($medicos, function ($medico) use ($cita) {
            return $medico->medico_id === $cita->idMedico;
            });
            $medico = array_shift($medico);
            ?>
            
        nuevoDiv1 = document.createElement("div");
        nuevoDiv1.classList.add("cita-box");

        nuevoDiv2 = document.createElement("div");
        nuevoDiv2.classList.add("especialidad-nombre");

        nuevoParrafo3 = document.createElement("p");
        nuevoParrafo3.textContent = "Especialidad:  <?php echo $medico['especialidade']->especialidad;?> ";
     
        nuevoParrafo1 = document.createElement("p");
        nuevoParrafo1.textContent = "Medico:  <?php echo $medico['nombre_doctor'];?> ";

        nuevoParrafo4 = document.createElement("p");
        nuevoParrafo4.classList.add("horario");
        nuevoParrafo4.textContent = "Dia:  <?php echo $cita['dia_semana'],' ', $cita['fecha'];?> ";

    
        nuevoDiv2.appendChild(nuevoParrafo1);
        nuevoDiv2.appendChild(nuevoParrafo3);          

        nuevoDiv1.appendChild(nuevoDiv2); 
        nuevoDiv1.appendChild(nuevoParrafo4);  

        datosAfiliadoElement.appendChild(nuevoDiv1);
            
        }
 
    <?php endforeach;?> 
              
}

} 

</script>


<style>
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

.body-width{
    width: 100%;
}
.img-aling{
    display: inline-block;
    width: 20px;
    height: 20px;
    margin-right: 3px;
}

.h-full {
    display: flex;
    flex: 1 1; 
    
}

.menu-lateral {
    
    flex: 1; 
}

.bienvenida-Usuario {
    
    flex: 1; 
    padding: 20px;
}


/* Para mostrar las cajas de cada cita. */

.contenedor {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    /* justify-content: space-around; */
    /* background-color: red; */
    background-color: rgb(2 6 23);
    padding: 10px 30px;
    margin: -20px -10px;
   border-radius: 30px;
}

.contenedor p{
    margin: 10px 0;
}

.contenedor h1{
    margin: 10px 0;
}

.citas-container {
    display: flex;
    flex-wrap: wrap;
    /* justify-content: space-around; */
    /* background-color: aqua; */
    padding-left: 40px

}

.cita-box {
    /* background-color: pink; */
    width: 300px;
    margin-left: -40px;
}

.cita-box .horario {
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 0 0 10px 10px;
    margin-left: -10px;  
    padding: 10px;
    width: 250px;
    margin-bottom: 10px;
}

/* Estilos para la parte superior de los cuadros (nombre y especialidad) */
.cita-box .especialidad-nombre {
    background-color: #3498db; /* Color para nombre y especialidad */
    padding: 50px 10px 20px 10px;
    border-radius: 10px 10px 0 0;
    width: 250px;
    margin-left: -10px;
    margin: 10px -10px -10px -10px;
}

.cita-box .especialidad-nombre p {
    margin-top: 10px ;
    color: white;
}

.horario {
    background-color: white; /* Color para el horario */
    text-align: center;
    padding: 200px;
    border-radius: 0 0 10px 10px;
    color: black;
    margin-top: -100px;
}

/* Estilo para el contenedor del select */
.menu-desplegable {
    margin: 10px 0 0 10px;
    
    background-color: rgb(2 6 23); /* Color de fondo */
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 5px;
}

/* Estilo para el select */
.select_style {
    width: 100%;
    padding: 10px;
    border: 1px solid rgb(2 6 23);
    border-radius: 5px;
    color: #fff; /* Color del texto */
    background-color: rgb(2 6 23); /* Color de fondo */
}

/* Estilo para las opciones del select */
.select_style option {
    background-color: rgb(2 6 23); /* Color de fondo de las opciones */
    color: #fff; /* Color del texto de las opciones */
    font-weight: bold;
}


</style>

