<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Medico $medico
 */
?>

<div class="mainCard column">

    <div class="bienvenida-conteo flex">

        <div class="bienvenida-Admin bg-slate-950 rounded-3xl mx-4 my-8 shadow-md ">
            <h1 style="font-weight: 600;"> Bienvenido al menu de busquedas de medicos </h1>
            <p class="mt-5">
                !Bienvenido! en este apartado podras visualizar y editar los medicos registrados en la plataforma
            </p>
        </div>

        <div class="conteo-Admin rounded-3xl bg-slate-950 items-center justify-center mb-7 mx-8 my-8 shadow-md">
            <h1 style="font-weight: 600;"> Total Medicos Registrados </h1>
            <p class="mt-1"> Resumen de todos los doctores registrados </p>
            <div class="logoPersonas mt-2">
                <img class="rounded-md h-auto rounded-full" src="img/iconoCardioRojo.png" alt="Imagen">
                <h1 class="mx-5" style="font-weight: normal; font-size: 36px">
                    <?= $cantidadMedicos ?> Ks
                </h1>
            </div>
        </div>

    </div>

    <div class="tabla bg-slate-950 rounded-3xl">
        <table class="table-fixed">

            <div class="col-span-1" style="display: flex; flex-direction: row; justify-content: space-between;">

                <div class="header">
                    <h1 class="mx-5" style="font-weight: 600;">Doctores</h1>
                </div>

                <div class="search my-auto">
                    <?= $this->Form->create(null, ['url' => ['action' => 'index'], 'type' => 'get']) ?>
                    <div class="mx-20" style="display: flex;">

                        <div class="input text mx-5">
                            <?= $this->Form->control('search', ['label' => false, 'class' => 'form-control rounded-md', 'placeholder' => 'Buscar nombre o Codigo']) ?>
                        </div>

                        <div class="input text">
                            <select class="rounded-md" id="select-status" placeholder="Filtrar por status"
                                name="status">
                                <option value="">Busqueda por status</option>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>

                        <div class="input text mx-5">
                            <select name="especialidad" id="select-especialidad" name="especialidad_id" class="rounded-md" >
                                <option value="">Busqueda por especialidad</option>
                                <?php foreach($especialidadesDescripciones as $key => $especialidades):  ?>
                                    <option style="color: green;" value="<?php echo $especialidades->id; ?>"><?php echo $especialidades->especialidad; ?></option>
                                <?php endforeach;  ?>
                            </select>
                        </div>

                        <div class="input submit">
                            <?= $this->Form->button('Buscar', ['class' => 'w-full buttonSearch']) ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>

            </div>

            <thead>
                <tr>
                    <th scope="col">
                        <?= $this->Paginator->sort('Nombre de Doctor') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Especialidad') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Codigo de doctor') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('status') ?>
                    </th>
                    <th scope="col" class="actions">
                        <?= _('Actions') ?>
                    </th>
                </tr>
            </thead>
            
            <?php if($medicos != 'null'){ ?>
                <tbody>
                    <?php foreach ($medicos as $medico): ?>
                        <tr>
                            <td>
                                <?= h($medico->nombre_doctor) ?>
                            </td>

                            <td>
                                <?= h($medico->especialidade->especialidad) ?>
                            </td>
                            <td>
                                <?= h($medico->codigo_doc) ?>
                            </td>

                            <?php if ($medico->status == "activo") { ?>
                                <td style="color: green;">
                                    Activo
                                </td>
                            <?php } else { ?>
                                <td style="color: red;">
                                    Inactivo
                                </td>
                            <?php } ?>

                            <td class="actions">
                                <?= $this->Html->link(__('Ver'), ['action' => 'View', $medico->medico_id]) ?>
                                <?= $this->Html->link(__('Editar'), ['action' => 'Edit', $medico->medico_id], ['class' => 'mx-4']) ?>

                                <button id="btn-delete-doctor" name="<?= $medico->nombre_doctor ?>/<?= $medico->medico_id ?>"
                                    style="color: red;">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php } ?>
        </table>
    </div>
    <?php if($medicos != 'null'){ ?>
    <div class="paginators">

        <ul class="paginationDoctor">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>

    </div>

    <p class="text-paginator">
        <p><?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} registro(s) actuales de {{count}} en total')) ?></p>
    </p>
    <?php } ?>
</div>

<?php echo $this->Html->scriptBlock(sprintf('let medicos = %s;', json_encode($medicos))); ?>

<script>
    const botones = document.querySelectorAll("#btn-delete-doctor");

    if (botones) {
        for (const boton of botones) {

            boton.addEventListener('click', (event) => {

                // Detiene el comportamiento normal del botón
                event.preventDefault();

                // Asigno las variables nombre y id y las pico para usarlas
                const nombre_id = boton.name.split("/");
                const nombreDoctor = nombre_id[0];
                const idMedico = nombre_id[1];

                // Alerta si confirma eliminacion
                swal({
                    title: "Eliminando..",
                    text: "¿Estás seguro de que quieres eliminar el doctor " + nombreDoctor + " ?",
                    icon: "warning",
                    dangerMode: true,
                    buttons: ["Ok", "Cancel"],
                }).then((logout) => {
                    if (!logout) {
                        // window.location.href = 'medicos/delete/' + id;

                        var form = document.createElement("form");
                        form.method = "POST";
                        form.action = 'medicos/delete/' + idMedico;

                        var inputNombreDoctor = document.createElement("input");
                        inputNombreDoctor.type = "hidden";
                        inputNombreDoctor.name = "nombre_doctor";
                        inputNombreDoctor.value = nombreDoctor;

                        var inputIdMedico = document.createElement("input");
                        inputIdMedico.type = "hidden";
                        inputIdMedico.name = "medico_id";
                        inputIdMedico.value = idMedico;

                        form.appendChild(inputNombreDoctor);
                        form.appendChild(inputIdMedico);

                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        }
    }

</script>


<style>
    /* estilos de paginador */
    .buttonSearch {
        border-radius: 25px;
        background-color: #EB6060;
        height: 25px;
        width: 100px;
        font-size: 14px;
        color: white;
    }

    /* finde */

    /* estilos de paginador */
    .paginationDoctor li {
        display: inline-block;
        margin-right: 20px;
        color: white;
    }

    .paginators {
        display: flex;
        justify-content: center;
    }

    .text-paginator {
        display: flex;
        justify-content: right;
    }

    /* finde */


    /* estilos de los cuadros */
    .mainCard {
        padding: 20px;
        height: 10%;
        width: 80%;
        border-radius: 5px;
    }

    .tabla {
        max-width: 2000px;
        padding: 20px;
        white-space: nowrap;
    }

    .header {
        margin-bottom: 20px;
    }

    .bienvenida-conteo div.bienvenida-Admin {
        width: 800px;
        height: 180px;
        padding: 30px;
    }

    .bienvenida-conteo div.conteo-Admin {
        width: 800px;
        height: 180px;
        padding: 30px;
    }

    .table-fixed {
        color: white;
    }

    table {
        margin-bottom: 2rem;
        border: none;
        table-layout: fixed;
        width: 100%;
        height: 200%;
    }

    table thead {
        background: none;
    }

    table tr {
        border-bottom: 0.5px solid #81818183;
    }

    table thead tr {
        border-bottom: none;
    }

    table tr th {
        padding: 1rem 0.625rem;
        font-size: 0.875rem;
        text-align: center;
        margin-bottom: 2rem;
        color: #959ea9;
    }

    table tr:nth-of-type(even) {
        background: none;
    }

    th,
    td {
        padding: 10px;
        text-align: center;
    }

    /* Finde */


    /* estilos de las letras */
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

    /* finde */


    /* estilos de las imagenes */
    .logoPersonas img {
        max-width: 70px;
        max-height: 70px;
    }

    .logoPersonas {
        display: flex;
        align-items: center;
    }

    /* finde */


    /* estilos del click para eliminar doctores */
    .btn-delete-doctor {
        color: red;
    }

    /* finde */
</style>