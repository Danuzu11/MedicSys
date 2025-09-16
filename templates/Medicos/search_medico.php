<!DOCTYPE html>
<html lang="en" class="mainView h-full bg-slate-900 flex">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Medicos</title>
</head>


<body class="mainView h-full bg-slate-900 flex">

    <!-- Contenido principal -->
    <div class="bienvenida-conteo">
        <!-- Bienvenida Usuario/Admin -->
        <div class="bienvenida-Usuario bg-slate-950 rounded-3xl mx-4 my-8 shadow-md">
            <h1 style="font-weight: 600;"> Hola

            </h1>
        </div>

        <!-- Buscador de especialidades -->
        <div class="bienvenida-Admin bg-slate-950 rounded-3xl mx-4 my-8 shadow-md flex">
            <div>
                <h1 style="font-weight: 600;"> Buscador de especialidades </h1>
                <p class="mt-5 text-justify mr-20">
                    Despliegue la barra y escoga la especialidad del doctor que desee buscar.
                </p>
            </div>
        </div>

        <!-- Menú desplegable y resultados de búsqueda -->
        <div class="menu-desplegable bg-slate-950 rounded-3xl mx-4 my-8 shadow-md flex">
            <select id="especialidad" name="status" class="rounded-md">
                <option style="color: green;" value="nada"> Selecciona una especialidad</option>
                <?php foreach ($especialidadesDescripciones as $key => $especialidad): ?>
                    <option style="color: green;" value="<?php echo $especialidad->id; ?>"
                        id="<?= $especialidad->especialidad ?>">
                        <?php echo $especialidad->especialidad; ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </div>

        <div id="resultado">

        </div>

        <!-- Modal -->

        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="cerrarModal()">❌</span>
                <div id="detalleMedico">

                </div>
            </div>
        </div>

    </div>
</body>


</html>

<?php echo $this->Html->scriptBlock(sprintf('let especialidadesDescripciones = %s;', json_encode($especialidadesDescripciones))); ?>

<?php echo $this->Html->scriptBlock(sprintf('let medicos = %s;', json_encode($medicos))); ?>

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

    function buscar() {
        // Obtiene el valor seleccionado del droplist.
        const especialidadSelect = document.getElementById('especialidad');
        const selectedValue = especialidadSelect.options[especialidadSelect.selectedIndex].value;
        const especialidadDoctor = especialidadSelect.options[especialidadSelect.selectedIndex].id;

        // Busca el id de la especialidad seleccionada.
        const resultado = document.getElementById('resultado');

        // Borra todos los hijos del div.
        resultado.innerHTML = '';

        if (selectedValue === "nada") {

        } else {
            var validate = false;
            for (const medico of medicos) {
                console.log(medico);
                if (medico.especialidad_id == selectedValue) {

                    resultado.innerHTML += `
                        <div >
                        <img src='https://st4.depositphotos.com/1325771/39154/i/450/depositphotos_391545206-stock-photo-happy-male-medical-doctor-portrait.jpg'>
                            <h3> Dr(a). ${medico.nombre_doctor}</h3>
                            <button onclick="mostrarDetalle('${medico.medico_id}','${medico.nombre_doctor}', '${especialidadDoctor}', '${medico.descripcion}')">Ver perfil</button>
                        </div>
                        `;
                        validate = true;
                }
            }
        }
        if(validate == false){
            alert('No hay doctores disponibles. Porfavor, trata mas tarde');
        }
    }

    // Asignar el evento change al select
    document.querySelector("#especialidad").addEventListener("change", buscar);

    function redireccionar(id) 
    {
        window.location.href = "<?= $this->Url->build('/', ['fullBase' => true]) . 'users/agendarcita/' ?>" + id
    }

    function mostrarDetalle(id,nombre, especialidad, descripcion) {
        const modal = document.getElementById('modal');
        const detalleMedico = document.getElementById('detalleMedico');
        detalleMedico.innerHTML = `
        <div class="contenedor">

          <h2> ${nombre}</h2>
          <img src='https://st4.depositphotos.com/1325771/39154/i/450/depositphotos_391545206-stock-photo-happy-male-medical-doctor-portrait.jpg'>
                   ⭐⭐⭐⭐⭐
          <p>Especialidad: ${especialidad}</p>
          <p>Trayectoria: ${descripcion}</p>
          <button onclick="redireccionar(${id})">Agendar</button>
        </div>
    `;
        modal.style.display = 'block';
    }

    function cerrarModal() {
        const modal = document.getElementById('modal');
        modal.style.display = 'none';
    }
</script>

<style>
    /* estilos de boton actualizar */
    .btn-submit {
        border-radius: 25px;
        background-color: #EB6060;
        height: 40px;
        width: 10%;
        font-size: 14px;
        color: white;
        margin-top: 1%;
    }

    /* Finde */

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

    p {
        font-size: 12px;
        color: #959ea9;
        font-weight: bold;
        width: 600px;
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


    /* estilos de los divs de bienvenida */
    .bienvenida-conteo div.bienvenida-Usuario {
        width: 1200px;
        height: 100px;
        padding: 30px;
    }

    .bienvenida-conteo div.bienvenida-Admin {
        width: 1200px;
        height: 180px;
        padding: 30px;
    }

    /* finde */

    /**************************/


    /* Estilo para el menú desplegable */
    #especialidad {
        width: 90%;
        padding: 20px;
        border: 2px solid #f99411;
        border-width: 2px;
        border-radius: 10px;
        /* border-radius: 30px; */
        background-color: rgb(2 6 23);
        color: white;

    }

    .menu-desplegable select{
        align-items: center;
        margin-left: 50px;
    }
    /* Estilo para el botón de búsqueda */
    .menu-desplegable button {
        background-color: #007bff;
        color: #fff;
        padding: 10px 35px;
    }

    .menu-desplegable option {
        color: white;
        /* background-color: #007bff; */
    }

    /* Estilo para el resultado de la búsqueda */
    #resultado {
        margin-top: 10px;
        padding: 50px;
        /* background-color: rgb(2 6 23); */
    }

    /* Estilos para la tarjeta del médico */
    #resultado div {
        display: inline-block;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        display: inline-block;
        /* Esto hace que el div se ajuste al contenido */
        /* background-color: #9a1010; */
        background-color: white;
        color: #f99411;
        margin: 10px;
        font-size: 20px;
        width: 20%;
    }



    #resultado div button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px;
        font-size: 15px;
        border-radius: 5px;
    }


    /*Detalles y cierre del medico*/

    .modal {
        display: none;
        width: 100%;
        height: 100%;
        border-radius: 10px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(171, 194, 200, 0.5); 
        justify-content: center;
        align-items: center;
        color: aqua
    }

    .modal-content {
        width: 20%;
        height: 60%;
        display: inline-block;
        overflow-y: scroll;
        background-color: rgb(2 6 23);
        margin-top: 200px;
        margin-left: 800px;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        position: fixed;
        color: aqua
    }

    /* scroll invisible */
    .modal ::-webkit-scrollbar {
        display: none;
    }

    /* Finde */
    .contenedor {
        /* ... Otros estilos ... */
        max-width: 400px;
        /* Establece un ancho máximo para el contenedor */
        overflow: hidden;
        /* Oculta el contenido que desborda el contenedor */
    }

    .contenedor p {
        font-size: 14px;
        margin: 5px 0;
        /* Agrega espacio entre los párrafos y otros elementos */
        overflow-wrap: break-word;
        /* Permite que el texto se corte y continúe en una nueva línea si es necesario */
    }

    .contenedor button {
        background-color: #007bff;
        padding: 10px;
        margin: 0 35%;
        border-radius: 10px;
        color: white;
    }


    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        color: #ececec;
        cursor: pointer;
        margin: 20px;
    }
</style>