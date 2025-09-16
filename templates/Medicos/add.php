<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Medico $medico
 */
?>


<div class="medicos">

    <div class="text-center ml-6 mb-3 mt-10">
        <h1>Agregar Medico</h1>
    </div>

    <div class="medicos-perfil">
        <img class="imagePerfil rounded-md h-auto rounded-full"
            src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/avatar.png' ?>" alt="ImagenPerfil">


        <?= $this->Form->create($medico, ['id' => 'miFormulario']) ?>

        <fieldset class="mb-3">
            <legend>
                <?= __('Edit Medico') ?>
            </legend>

            <div class="form-group">
                <label>
                    <?= __('Nombre Medico') ?>
                </label>
                <input type="text" class="form-control rounded shadow-sm" name="nombre_doctor"
                    value="<?= $medico->nombre_doctor ?>" required>
            </div>

            <div class="form-group">
                <label>
                    <?= __('Codigo Medico') ?>
                </label>
                <input type="text" class="form-control rounded shadow-sm" name="codigo_doc"
                    value="<?= $medico->codigo_doc ?>" required>
            </div>

            <div class="form-group">
                <label>
                    <?= __('Especialidad') ?>
                </label>
                <!-- <input type="text" class="form-control rounded shadow-sm" name="especialidad_id"
                    value="<?= $medico->especialidad_id ?>"> -->

                <select id="select-especialidad" name="especialidad_id"
                    class="form-control2 rounded shadow-sm select-status" required>
                    <?php foreach ($especialidadesDescripciones as $key => $especialidades): ?>
                        <option style="color: green;" value="<?php echo $especialidades->id; ?>">
                            <?php echo $especialidades->especialidad; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>

            <div class="form-group">
                <label>
                    <?= __('Horario') ?>
                </label>
                <div class="row form-group">
                    <div class="col-md-4 form-group">
                        <input type="checkbox" id="checkboxDias" value="Lunes" name="dias[]">
                        <label for="lunes">Lunes</label>
                        <input type="checkbox" id="checkboxDias" value="Martes" name="dias[]">
                        <label for="martes">Martes</label>
                        <input type="checkbox" id="checkboxDias" value="Miercoles" name="dias[]">
                        <label for="miercoles">Miércoles</label>
                        <input type="checkbox" id="checkboxDias" value="Jueves" name="dias[]">
                        <label for="jueves">Jueves</label>
                        <br>
                        <input type="checkbox" id="checkboxDias" value="Viernes" name="dias[]">
                        <label for="viernes">Viernes</label>
                        <input type="checkbox" id="checkboxDias" value="Sabado" name="dias[]">
                        <label for="sabado">Sábado</label>
                        <input type="checkbox" id="checkboxDias" value="Domingo" name="dias[]">
                        <label for="domingo">Domingo</label>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="turno">Turno</label>
                        <select name="horario" id="horario" class="form-control2 rounded shadow-sm select-status"
                            required>
                            <option value="diurno">Diurno</option>
                            <option value="nocturno">Nocturno</option>
                            <!-- <option value="full">Full</option> -->
                        </select>
                    </div>
                </div>
                <!-- <input type="button" value="Modificar horario" onclick="window.location.href='/otra-pagina'"
                    class="btn btn-submit rounded shadow-sm"> -->
                <!-- <input type="text" class="form-control rounded shadow-sm" name="horario" value="<?= $medico->horario ?>"
                    hidden> -->
            </div>

            <div class="form-group">
                <label>
                    <?= __('Estado') ?>
                </label>

                <select name="status" id="status" class="form-control2 rounded shadow-sm select-status" required>
                    <option style="color: green;" value="activo">Activo</option>
                    <option style="color: red;" value="inactivo">Inactivo</option>
                </select>
            </div>


            <div class="form-group">
                <label>
                    <?= __('Descripcion') ?>
                </label> <br>
                <textarea class="form-control1 rounded shadow-sm text-justify" name="descripcion" rows="5" required
                    cols="40"><?= $medico->descripcion ?></textarea>
            </div>

        </fieldset>

        <?= $this->Form->button(__('Agregar'), ['class' => 'btn btn-submit rounded shadow-sm']) ?>
        <?= $this->Form->end() ?>

    </div>
</div>

<script>

    const dias = document.querySelectorAll("input[type=checkbox][name='dias[]']");

    // Comprobamos si al menos uno de los checkbox está seleccionado
    //const hayDiaSeleccionado = dias.some(dia => dia.checked);

    // Añadimos un evento de submit al formulario
    const formulario = document.querySelector("#miFormulario");

    formulario.addEventListener("submit", e => {

   // Validar el formulario aquí
        const dias = document.querySelectorAll("input[type=checkbox][name='dias[]']");
        const hayDiaSeleccionado = [...dias].some(dia => dia.checked);

        // Si no hay ningún checkbox seleccionado, cancelamos el envío del formulario
        if (!hayDiaSeleccionado) {
            e.preventDefault();
            alert("Debe seleccionar al menos un día");
        }
    });

    const select = document.getElementById('status');
    const status = "<?= $medico->status ?>";
    select.value = 'Activo';

    if (status === 'inactivo') {
        select.style.color = 'red';
    } else {
        select.style.color = 'green';
    }

    select.addEventListener('change', function () {

        const selectedValue = select.options[select.selectedIndex].value;

        if (selectedValue === 'inactivo') {
            select.style.color = 'red';
        } else {
            select.style.color = 'green';
        }
    });

</script>

<style>
    .fechas {
        margin-top: 10px;
    }

    .container-interior label {
        float: left;
    }

    .container-interior input {
        float: right;
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


    /* scroll invisible */
    ::-webkit-scrollbar {
        display: none;
    }

    /* Finde */


    /* estilos de vista main */
    .medicos {
        overflow: auto;
        width: 30%;
    }

    .mainView {
        background-color: rgb(2 6 23);
    }

    /* Finde */


    /* estilos de icono de perfil */
    .imagePerfil {
        margin-left: 40%;
        width: 120px;
        height: 120px;
    }

    /* Finde */


    /* estilos para los forms-principales */
    .medicos {
        margin: 0 auto;
        background-color: rgb(2 6 23);
    }

    .form-group {
        color: white;
        padding: 5px;
    }

    .medicos .form-control:focus {
        outline: none;
        box-shadow: 0 0 0 5px rgba(0, 0, 255, 0.2);
    }

    .medicos .form-control {
        /* background-color: transparent; */
        background-color: rgb(2 6 23);
        font-weight: 600;
        padding: 20px;
        border: 1px solid grey;
        width: 100%;
        height: 40px;
        margin: 0 auto;
        border-width: 2px;
        border-radius: 20px;
    }

    .medicos .form-control1 {
        background-color: transparent;
        width: 100%;
        border: 2px solid grey;
        padding: 10px;
    }

    /* Finde */


    /* estilos de las letras */
    ul {
        color: white;
    }

    h1 {
        font-size: 24px;
        color: white;
        font-weight: bold;
    }

    p {
        font-size: 12px;
        color: #959ea9;
        font-weight: bold;
    }

    h2 {
        font-size: 24px;
        color: white;
        font-weight: 600;
    }

    label {
        color: white;
        font-weight: 600;
    }

    /* finde */


    /* estilos del select */
    .select-status {
        /* background-color: transparent; */
        background-color: rgb(2 6 23);
        border: 1px solid grey;
        width: 50%;
        height: 40px;
        margin-left: 20%;
        text-align: center;
        border-width: 2px;
        border-radius: 20px;
        font-weight: 600;
    }

    /* finde */
</style>