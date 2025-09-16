<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Afiliado $afiliados
 */
?>

<!-- Contenido principal -->
<div class="bienvenida-conteo">

    <!-- Buscador de especialidades -->
    <div class="bienvenida-Admin bg-slate-950 rounded-3xl mx-4 my-8 shadow-md flex">
        <div>
            <h1 style="font-weight: 600;"> Agendar cita </h1>
            <p class="mt-5 text-justify mr-20">
                Despliegue la barra y escoga el afiliado que desee asignar la cita con el doctor y Seleccione el
                <br>
                horario que prefiera, si desea asignar la cita al propietario de la cuenta seleccione la opcion <br>
                "Propietario de la cuenta".
            </p>
        </div>
    </div>

    <form action="<?= $this->Url->build('/', ['fullBase' => true]) . 'Users/agendarcita/' . $id ?>" method="POST">

        <div class="form-group">
            <div class="menu-desplegable bg-slate-950 rounded-3xl mx-4 my-8 shadow-md flex">
                <select id="especialidad" name="afiliado" class="rounded-md" required>
                    <option style="color: green;" value=""> Seleccione a quien quiere asignar la cita</option>
                    <option value="yo"> Propietario de la cuenta </option>
                    <?php foreach ($afiliados as $key => $afiliado): ?>
                        <option value="<?php echo $afiliado->id; ?>" id="<?= $afiliado->id ?>">
                            <?php echo $afiliado->nombre . ' ' . $afiliado->apellido; ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>
        </div>

        <input type="text" name="medicoid" value=<?= $id ?> hidden>

        <div class="form-group">

            <h1 style="color:white;">Descripcion de la razon de la cita</h1>

            <textarea style="width:50%; display:flex; margin: 0 auto;"
                class="form-control rounded shadow-sm text-justify" name="descripcion" rows="5" required></textarea>

        </div>

        <div class="fecha-title">
            <h1 style="font-weight: 600;"> Fechas disponibles </h1>
        </div>

        <div class="form-group">
            <input type="date" name="fecha" id="fecha" onchange="fechaCambiada()" required>
        </div>

        <div class="fechas flex justify-center">
            <?php
            foreach ($horarios as $key => $horario) {
                $bloques = json_decode($horario['hora'], true);
                ?>

                <div class="horarios" hidden>
                    <div class="fecha-title">
                        <h1 style="font-weight: 600; color: black;">
                            <?= $horario['dia_semana'] ?>
                        </h1>
                    </div>
                    <div class="container-interior" id="<?= $horario['dia_semana'] ?>">
                        <?php foreach ($bloques as $key => $bloque) { ?>
                            <label class="ml-1" for="bloque<?= $horario['id'] ?>">
                                <?php echo $bloque['hora_inicio'] . '-' . $bloque['hora_fin']; ?>
                            </label>
                            <?php if ($bloque['status'] === 'false') { ?>
                                <input type="radio" class="mr-2 mt-3" name="bloque" id="<?= $key ?>"
                                    value="<?= $key . '/' . $horario['dia_semana'] ?>" disabled>
                            <?php } else { ?>
                                <input type="radio" class="mr-2 mt-3" name="bloque" id="<?= $key ?>"
                                    value="<?= $key . '/' . $horario['dia_semana'] ?>">
                            <?php } ?>
                            <br>
                        <?php } ?>
                    </div>
                </div>

            <?php } ?>
        </div>

        <!-- <input type="submit" value="Enviar"> -->
        <?= $this->Form->button(__('Agendar'), ['class' => 'btn btn-submit rounded shadow-sm']) ?>
    </form>



</div>

<?php echo $this->Html->scriptBlock(sprintf('let afiliados = %s;', json_encode($afiliados))); ?>
<?php echo $this->Html->scriptBlock(sprintf('let citas = %s;', json_encode($citas))); ?>

<script>

    //Condicionar el receptor de fecha
    console.log(citas);
    var fechaActual = new Date();
    fechaActual.setDate(fechaActual.getDate() + 0.5);
    var fechaMinima = fechaActual.toISOString().split("T")[0];
    document.getElementById("fecha").setAttribute("min", fechaMinima);



    // inputFecha.min = fechaMinima;

    function fechaCambiada() {

        const fecha = document.querySelector('#fecha').value;

        // Obtener el día de la semana de la fecha seleccionada
        const dia = new Date(fecha).getDay();

        const arrayDias = [
            "Lunes",
            "Martes",
            "Miercoles",
            "Jueves",
            "Viernes",
            "Sabado",
            "Domingo",
        ]

        // Iterar sobre los div horarios
        var horarios = document.querySelectorAll('.horarios');

        horarios.forEach((horario) => {
            horario.style.display = 'none';
            // Obtener el día de la semana del div

            var diaHorario = horario.querySelector('.fecha-title h1').textContent;

            // Si el día del div es igual al día seleccionado, activar el div
            const diaArray = arrayDias[dia];
            var diaid = '#' + diaHorario.trim();

            var containerDia = horario.querySelector(diaid);
            // console.log(diaArray);
            // console.log(diaHorario.trim());
            if (diaArray == diaHorario.trim()) {

                horario.style.display = 'block';

                // Desbloquear el radio button
                const radioButtons = horario.querySelectorAll('input[type="radio"][name="bloque"]');
                radioButtons.forEach((radioButton) => {
                    radioButton.disabled = false;
                });

                // Iterar sobre los objetos del array
                if (citas.length !== 0) {
                    citas.forEach((cita) => {
                        // console.log(cita)
                        // Si la fecha del objeto coincide con la fecha seleccionada, bloquear los radio buttons

                        if (cita.fecha == fecha) {

                            // Iterar sobre los radio buttons
                            radioButtons.forEach((radioButton) => {
                                // Bloquear el radio button
                                if (radioButton.id == cita.bloque_hora) {
                                    radioButton.disabled = true;
                                }

                            });
                        }
                    });
                }
            }



        });
    }

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
    textarea {
        width: 100px;
        height: 100px;
        resize: none;
    }

    .form-group {
        display: block;
        margin: 0 auto;
        text-align: center;
    }

    .fecha-title h1 {
        text-align: center;
    }

    /* estilos de boton actualizar */
    .btn-submit {
        border-radius: 25px;
        background-color: #EB6060;
        height: 40px;
        width: 10%;
        font-size: 14px;
        color: white;
        margin-top: 1%;
        display: block;
        margin: 0 auto;
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

    .menu-desplegable select {
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
    }

    .fechas {
        margin-top: 10px;
    }

    /* Estilos para la tarjeta del médico */
    .horarios {
        border: 1px solid #ccc;
        background-color: white;
        color: #f99411;
        margin: 10px;
        font-size: 20px;
        border-width: 2px;
        border-radius: 10px;
        width: 200px;

    }

    .container-interior label {
        float: left;
    }

    .container-interior input {
        float: right;
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
</style>