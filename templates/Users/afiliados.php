<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Afiliado $afiliado
 */
?>

<!-- div para que se coloque todo uno debajo del otro -->
<div class="container body-width">

    <h1 class="h1-deco mt-10">Registro de Afiliados</h1>

    <div class="purple-line"></div>

    <!-- del formulario en cuestion -->

    <div class="afiliado-perfil">

        <?= $this->Form->create($afiliado) ?>

        <fieldset class="mb-3">

            <legend style="display:none">
                <?= __('Edit Afiliado') ?>
            </legend>

            <div class="form-group">
                
                <div class="row flex mx-4">
                    <label>
                        <?= __('Tipo de documento') ?>
                    </label>
                    <div class="form-check mx-4">
                        <input class="form-check-input" type="radio" name="tipo" id="tipoV" value="V" required>
                        <label class="form-check-label" for="tipoV">
                            V
                        </label>
                    </div>
                    <div class="form-check mx-4">
                        <input class="form-check-input" type="radio" name="tipo" id="tipoE" value="E" required>
                        <label class="form-check-label" for="tipoE">
                            E
                        </label>
                    </div>
                    <div class="form-check mx-4">
                        <input class="form-check-input" type="radio" name="tipo" id="tipoP" value="P" required>
                        <label class="form-check-label" for="tipoP">
                            P
                        </label>
                    </div>
                    <div class="form-check mx-4">
                        <input class="form-check-input" type="radio" name="tipo" id="tipoNA" value="N/A" required>
                        <label class="form-check-label" for="tipoNA">
                            N/A
                        </label>
                    </div>
           
                </div>
            </div>

            <div class="form-group">
                <label>
                    <?= __('Cédula') ?>
                </label>
                <input type="text" class="ml-10 form-control rounded shadow-sm" name="cedula" value="<?= $afiliado->cedula ?>" pattern="[0-9]*"
                    required>
            </div>

            <div class="form-group">
                <label>
                    <?= __('Nombre') ?>
                </label>
                <input type="text" class="ml-8 form-control rounded shadow-sm" name="nombre" value="<?= $afiliado->nombre ?>"
                    required>
            </div>

            <div class="form-group">
                <label>
                    <?= __('Apellido') ?>
                </label>
                <input type="text" class="ml-8 form-control rounded shadow-sm" name="apellido"
                    value="<?= $afiliado->apellido ?>" required>
            </div>

            <div class="form-group">
                <label>
                    <?= __('Email') ?>
                </label>
                <input type="email" class="ml-12 form-control rounded shadow-sm" name="email" value="<?= $afiliado->email ?>" pattern="/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"
                    required>
            </div>

            <div class="form-group">
                <label>
                    <?= __('Fecha de nacimiento') ?>
                </label>
                <input type="date" class="form-control rounded shadow-sm" name="fecha_nacimiento"
                    value="<?= $afiliado->fecha_nacimiento ?>" required id="fecha">
            </div>
            <input type="text" class="ml-8 form-control rounded shadow-sm" name="idUser" value="<?= $afiliado->idUser ?>"
                    hidden>
        </fieldset>

        <?= $this->Form->button(__('Agregar'), ['class' => 'btn btn-submit rounded shadow-sm']) ?>
        <?= $this->Form->end()?>
    </div>
</div>


    <script>

        //const datos = '<?php #$doctoresJson ?>';
       // const obj = JSON.parse(datos);

       // console.log(obj);

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

            //Condicionar el receptor de fecha
            var fechaActual = new Date().toISOString().split("T")[0];
            document.getElementById("fecha").setAttribute("max", fechaActual);

            function enviarFormulario() {

                // Obtener los valores del formulario
                const nombre = document.getElementById("nombre").value;
                const cedula = document.getElementById("cedula").value;
                const apellido = document.getElementById("apellido").value;
                const opcion = document.querySelector('input[name="opcion"]:checked').value;
                const genero = document.querySelector('input[name="genero"]:checked').value;
                const fecha = document.getElementById('fecha').value;

                // Hacer algo con los valores (por ejemplo, enviarlos a un servidor)
                console.log(`Nombre: ${nombre}, cedula: ${cedula} , apellido: ${apellido}, Opción: ${opcion}, Fecha: ${fecha} `);

                // Limpiar el formulario
                document.getElementById("nombre").value = "";
                document.getElementById("cedula").value = "";
                document.getElementById("apellido").value = "";
                document.querySelector('input[name="opcion"]:checked').checked = false;
                document.querySelector('input[name="genero"]:checked').checked = false;

            }
        
    </script>

    <style>

        .afiliado-perfil {
            font-size: 1em;
            zoom: 1.5;
        }

        .form-group {
            margin-top: 5%;
            margin-bottom: 5%;
        }

        /* estilos de boton actualizar */
        .btn-submit {
            border-radius: 25px;
            background-color: #EB6060;
            height: 40px;
            width: 60%;
            font-size: 14px;
            color: white;
            margin-left: 20%;
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

        p,
        label {
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


        /*Clases para el formulario dv*/

        .identacion-radio-input {
            display: inline-block;
            margin-right: 10px;
        }

        .form-paciente {
            display: block;
        }

        .container {
            margin-top: 3%;
            width: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .body-width {
            width: 100%;
        }

        .input-deco {
            margin-top: 10px;
            margin-bottom: 10px;
            background-color: #585453;
        }

        h3 {
            display: inline-block;
            color: white;
        }

        .input-radio-deco {
            margin-left: 7px;

        }

        .purple-line {
            background-color: #9c0f44;
            width: 80%;
            height: 4px;
            margin-top: 8px;
            margin-bottom: 10px;
        }

        #button-deco {
            display: block;
            margin: 0 auto;
            background-color: green;
            border: none;
            color: white;
            padding-top: 5px;
            padding-bottom: 5px;
            margin-top: 30px;
            padding-left: 10px;
            padding-right: 10px;
            border-radius: 5px;

        }

        .h1-deco {
            /* font-size: 26px; */
            font-size: 3em;
            color: white;
        }

        .label-deco {
            color: white;
            font-size: 15px;
            display: inline-block;
            font-weight: bold;
        }

        .fieldset-deco {
            margin-top: 3px;
            margin-bottom: 3px;
        }

        /* finde */
    </style>