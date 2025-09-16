<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="mainCard column">

    <div class="bienvenida-conteo flex">

        <div class="bienvenida-Admin bg-slate-950 rounded-3xl mx-4 my-8 shadow-md ">
            <h1 style="font-weight: 600;"> Bienvenido al menu de busquedas de usuarios </h1>
            <p class="mt-5">
                ¡Bienvenido! en este apartado podras visualizar y editar los clientes afiliados a la paltaforma
            </p>
        </div>

        <div class="conteo-Admin rounded-3xl bg-slate-950 items-center justify-center mb-7 mx-8 my-8 shadow-md">
            <h1 style="font-weight: 600;"> Total Usuarios Registrados </h1>
            <p class="mt-1"> Resumen de todos los usuarios registrados </p>
            <div class="logoPersonas mt-2">
                <img class="rounded-md h-auto rounded-full mb-7" src="img/iconoPersonasRojo.png" alt="Imagen">
                <h1 class="mx-5" style="font-weight: normal; font-size: 36px">
                    <?= $cantidadUsers ?> Ks
                </h1>
            </div>
        </div>

    </div>


    <div class="tabla bg-slate-950 rounded-3xl">
        <table class="table-fixed ">

            <div class="col-span-1" style="display: flex; flex-direction: row; justify-content: space-between;">

                <div class="header">
                    <h1 class="mx-5" style="font-weight: 600;">Usuarios</h1>
                </div>

                <div class="search my-auto">
                    <?= $this->Form->create(null, ['url' => ['action' => 'index'], 'type' => 'get']) ?>
                    <!-- <div class="grid grid-cols-3 gap-4"> -->
                        <div class="mx-20" style="display: flex;">
                        <div class="input text mx-10">
                            <?= $this->Form->control('search', ['label' => false, 'class' => 'form-control rounded-md w-80', 'placeholder' => 'Buscar nombre o correo']) ?>
                        </div>

                        <div class="input text ">
                            <select class="rounded-md" id="select-status" placeholder="Filtrar por status"
                                name="status">
                                <option value="">Busqueda por status</option>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>

                        <div class="input submit mx-10">
                            <?= $this->Form->button('Buscar', ['class' => 'w-full buttonSearch']) ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>

            </div>


            <thead>
                <tr>
                    <th scope="col">
                        <?= $this->Paginator->sort('Nombre de usuario') ?>
                    </th>
                    <th scope="col" >
                        <?= $this->Paginator->sort('Email') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Rol') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Ultima conexion') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('Fecha creado') ?>
                    </th>
                    <th scope="col">
                        <?= $this->Paginator->sort('status') ?>
                    </th>
                    <th scope="col" class="actions">
                        <?= __('Actions') ?>
                    </th>
                </tr>
            </thead>
            <?php if($users != 'null'){ ?>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <?php //if ($user->rol == 0){ ?>
                        <tr>
                            <td>
                                <?= h($user->user) ?>
                            </td>

                            <td>
                                <?= h($user->email) ?>
                            </td>

                            <?php if ($user->rol == "1") { ?>
                                <td style="color: green;">
                                    Admin
                                </td>
                            <?php } else { ?>
                                <td style="color: blue;">
                                    Paciente
                                </td>
                            <?php } ?>

                            <td>
                                <?= h($user->ultima_conexion) ?>
                            </td>

                            <td>
                                <?= h($user->created) ?>
                            </td>

                            <?php if ($user->status == "activo") { ?>
                                <td style="color: green;">
                                    Activo
                                </td>
                            <?php } else { ?>
                                <td style="color: red;">
                                    Inactivo
                                </td>
                            <?php } ?>

                            <td class="actions">
                                <?= $this->Html->link(__('Ver'), ['action' => 'view', $user->id]) ?>
                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $user->id], ['class' => 'mx-4']) ?>
                                <?php if($user->id != 1){ ?>
                                    <button id="btn-delete-user" name="<?= $user->user ?>/<?= $user->id ?>"
                                        style="color: red;">Eliminar</button>
                                <?php } ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            <?php } ?>
        </table>
        <?php if($users != 'null'){ ?>
        <div class="paginators">
            <ul class="paginationUsers">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
        </div>

        <p class="text-paginator">
        <p>
            <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} registro(s) actuales de {{count}} en total')) ?>
        </p>
        </p>
        <?php } ?>
    </div>
</div>

<script>
    const botones = document.querySelectorAll("#btn-delete-user");

    if (botones) {
        for (const boton of botones) {

            boton.addEventListener('click', (event) => {

                // Detiene el comportamiento normal del botón
                event.preventDefault();

                // Asigno las variables nombre y id y las pico para usarlas
                const nombre_id = boton.name.split("/");
                const nombreUser = nombre_id[0];
                const idUser = nombre_id[1];

                // Alerta si confirma eliminacion
                swal({
                    title: "Eliminando..",
                    text: "¿Estás seguro de que quieres eliminar el usuario " + nombreUser + " ?",
                    icon: "warning",
                    dangerMode: true,
                    buttons: ["Ok", "Cancel"],
                }).then((logout) => {
                    if (!logout) {
                        // window.location.href = 'medicos/delete/' + id;
                        var form = document.createElement("form");
                        form.method = "POST";
                        form.action = 'users/delete/' + idUser;

                        var inputNombreUser = document.createElement("input");
                        inputNombreUser.type = "hidden";
                        inputNombreUser.name = "nombre_user";
                        inputNombreUser.value = nombreUser;

                        var inputIdUser = document.createElement("input");
                        inputIdUser.type = "hidden";
                        inputIdUser.name = "user_id";
                        inputIdUser.value = idUser;

                        form.appendChild(inputNombreUser);
                        form.appendChild(inputIdUser);

                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        }
    }

</script>

<style>

    /* estilos de boton de busqueda */
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
    .paginationUsers li {
        display: inline-block;
        margin-right: 20px;
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
        font-weight: bold;
    }

    /* finde */

    /* estilos de logos */
    .logoPersonas img {
        max-width: 70px;
        max-height: 70px;
        transform: scale(1.5);
    }

    .logoPersonas {
        display: flex;
    }

    /* finde */

    /* estilos de boton eliminar */
    .btn-delete-doctor {
        color: red;
    }

    /* finde */
</style>