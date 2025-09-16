<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Medico $medico
 */

?>

<div class="medicos">

    <div class="text-center ml-6 mb-3 mt-10">
        <h1>Editar Medico</h1>
    </div>

    <div class="medicos-perfil">
        <img class="imagePerfil rounded-md h-auto rounded-full"
            src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/avatar.png' ?>" alt="ImagenPerfil">


        <?= $this->Form->create($medico) ?>

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
                    
                <select id="select-especialidad" name="especialidad_id" class="form-control2 rounded shadow-sm select-status" required>
                    <?php foreach($especialidadesDescripciones as $key => $especialidades):  ?>
                        <option style="color: green;" value="<?php echo $especialidades->id; ?>"><?php echo $especialidades->especialidad; ?></option>
                    <?php endforeach;  ?>
                </select>
            </div>
            <h1 id="aviso-citas-pendientes" style="color:red; font-size: 14px" hidden> El doctor tiene citas agendadas futuras por ende no podra cambiar sus horarios hasta que no se completen
                o eliminen las citas agendadas
            </h1>
            <div class="form-group">
                <label>
                    <?= __('Horario') ?>
                </label>
                <div class="row form-group">

                    <div class="col-md-4 form-group">
                        <?php foreach ($horarios as $key => $value) { ?>
                        
                            <?php if ($value->estado == $estado) { ?>
                                <input type="checkbox" id="checkboxDias" value="<?= $value->dia_semana?>" name="dias[]" checked>
                                <label for="<?= $value->dia_semana?>"><?= $value->dia_semana?></label>
                            <?php }else{ ?>
                                <input type="checkbox" id="checkboxDias" value="<?= $value->dia_semana?>" name="dias[]">
                                <label for="<?= $value->dia_semana?>"><?= $value->dia_semana?></label>
                            <?php } ?>
                        
                        <?php } ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="turno">Turno</label>
                        <select name="horario" id="horario" class="form-control2 rounded shadow-sm select-status"
                            required>
                            <option value="diurno">Diurno</option>
                            <option value="nocturno">Nocturno</option>
                            <option value="full">Full</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>
                    <?= __('Estado') ?>
                </label>

                <select id="select-status" name="status" class="form-control2 rounded shadow-sm select-status" required>
                    <option style="color: green;" value="activo">Activo</option>
                    <option style="color: red;" value="inactivo">Inactivo</option>
                </select>
            </div>


            <div class="form-group">
                <label>
                    <?= __('Descripcion') ?>
                </label> <br>
                <textarea class="form-control1 rounded shadow-sm text-justify" name="descripcion" rows="5"
                    cols="40" required><?= $medico->descripcion ?></textarea>
            </div>
        </fieldset>

        <?= $this->Form->button(__('Actualizar'), ['class' => 'btn btn-submit rounded shadow-sm']) ?>
        <?= $this->Form->end() ?>

    </div>
</div>

<?php echo $this->Html->scriptBlock(sprintf('let citas = %s;', json_encode($citas))); ?>

<script>

    if (citas.length !== 0) {
        // Obtener todos los checkbox
        const checkboxDias = document.querySelectorAll("input[id='checkboxDias']");
        // Desactivarlos
        for (const checkbox of checkboxDias) {
            checkbox.disabled = true;
        }

        const select = document.getElementById("horario");
        select.disabled = true;

        const citasAlerta = document.getElementById("aviso-citas-pendientes");
        citasAlerta.style.display = 'block';
    }
    



    const selectEspecialidad = document.getElementById('select-especialidad');
    const especialidad = "<?= $medico->especialidad_id ?>";
    selectEspecialidad.value = especialidad;
    selectEspecialidad.style.color = 'green';

    const selectStatus = document.getElementById('select-status');
    const status = "<?= $medico->status ?>";
    selectStatus.value = status;


    const selectHorario = document.getElementById('horario');
    const horario = "<?= $medico->horario ?>";
    selectHorario.value = horario;

    if (status === 'inactivo') {
        selectStatus.style.color = 'red';
    } else {
        selectStatus.style.color = 'green';
    }

    selectStatus.addEventListener('change', function () {

        const selectedValue = selectStatus.options[selectStatus.selectedIndex].value;

        if (selectedValue === 'inactivo') {
            selectStatus.style.color = 'red';
        } else {
            selectStatus.style.color = 'green';
        }
    });

</script>
<style>
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
        /* background-color: transparent; */
        background-color: rgb(2 6 23);
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