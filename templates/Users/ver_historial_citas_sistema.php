<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 * @var \App\Model\Entity\Afiliado[]|\Cake\Collection\CollectionInterface $afiliados
 */
// debug($afiliados);
// $objeto = array_filter($afiliados, function ($afiliado) { return $afiliado->id === 2; });
// $objeto = array_shift($objeto);
// debug($objeto);
// die;

// debug($medicos);
// debug($medicoEncontrado);
// debug($citas);
// die;
?>
<div class="mainCard column justify-center">

    <div class="header justify-center">
        <h1 class="header mx-5" style="font-weight: 600;">Historial</h1>
    </div>

    <div class="mt-2 mb-2 contain-search" style="display: flex; justify-content: center; align-items: center;">
        <div class="">
            <h1 class="mx-5" style="font-weight: 400;">Correo / Nombre:</h1>
        </div>
        <?= $this->Form->create(null, ['url' => ['action' => 'verHistorialCitasSistema'], 'type' => 'get']) ?>
        <div class="search" style="display: flex; justify-center">
            <?= $this->Form->control('search', ['label' => false, 'class' => 'form-control w-96 rounded-md mx-5 p-2', 'placeholder' => 'Buscar por correo de la cuenta']) ?>
            <?= $this->Form->button('Buscar', ['class' => 'w-full buttonSearch mx-10']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>

    <div class="tabla bg-slate-950 rounded-3xl">
        <div class="contain-list mt-5 justify-content: center;">

            <?php if ($citas != 'null') { ?>
                <?php foreach ($citas as $value): ?>

                    <div class="list-citas p-5" style="color: white;">

                        <div style="display: flex; height: 100%; width: 100%;">

                            <div style="height: 100%;">
                                <img class="img-aling"
                                    src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/image/leafWelcome.jpg' ?>"
                                    alt="Imagen">
                            </div>

                            <div>
                                <div style="display: flex;" class="ml-10 justify-between">
                                    <div>
                                        <?php if ($value->idafiliado == null) { ?>
                                            <h4 style="color: green;"> Dirigido a: </h4>
                                            <h4>Propietario de la cuenta</h4>
                                            <h4 style="color: green;"> Usuario: </h4>
                                            <h4>
                                                <?= $currentUser['user'] ?>
                                            </h4>
                                        <?php } else { ?>
                                            <?php $objeto = array_filter($afiliados, function ($afiliado) use ($value) {
                                                return $afiliado->id === $value->idafiliado;
                                            });
                                            $objeto = array_shift($objeto);
                                            ?>
                                            <h4 style="color: green;"> Dirigido a: </h4>
                                            <h4> Afiliado del Propietario:
                                                <?= $currentUser['user'] ?>
                                            </h4>
                                            <h4 style="color: green;"> Afiliado: </h4>
                                            <h4>
                                                <?= $objeto['nombre'] . ' ' . $objeto['apellido'] ?>
                                            </h4>
                                        <?php } ?>
                                    </div>
                                    <h4> Status:
                                        <?= $value->status ?>
                                    </h4>
                                </div>
                                <h4 style="color: red;">
                                    ___________________________________________________________________________ </h4>

                                <div style="display: flex;" class="ml-10">
                                    <?php $medicoEncontrado = array_filter($medicos, function ($medico) {
                                        return $medico['medico_id'] === 31; });
                                    $medicoEncontrado = array_shift($medicoEncontrado); ?>
                                    <div>
                                        <h4> Especialidad:
                                            <?= $medicoEncontrado['especialidade']['especialidad'] ?>
                                        </h4>
                                        <h4> Especialista:
                                            <?= $medicoEncontrado['nombre_doctor'] ?>
                                        </h4>
                                    </div>
                                    <div class="ml-20">
                                        <h4>
                                            Fecha pautada:
                                            <?= $value->fecha ?>
                                        </h4>
                                    </div>
                                </div>
                                <h4 style="color: red;">
                                    ___________________________________________________________________________ </h4>
                                <div style="display: flex;" class="mx-10">

                                    <button class="mx-6 buttonStatus" style="background-color: green;">
                                        <?= $this->Html->link('Completada', ['controller' => 'Users', 'action' => 'cambiarStatusCitas/', '?' => ['id' => $value->id, 'status' => 'Completada']], ['class' => 'buttonStatus', 'style' => 'background-color: green;']) ?>
                                    </button>
                                    <button class="mx-6 buttonStatus" style="background-color: red;">
                                        <?= $this->Html->link('Cancelar', ['controller' => 'Users', 'action' => 'cambiarStatusCitas/', '?' => ['id' => $value->id, 'status' => 'Cancelada']], ['class' => 'buttonStatus', 'style' => 'background-color: red;']) ?>
                                    </button>
                                    <button class="mx-6 buttonStatus" style="background-color: orange;">
                                        <?= $this->Html->link('Fallida', ['controller' => 'Users', 'action' => 'cambiarStatusCitas/', '?' => ['id' => $value->id, 'status' => 'Fallida']], ['class' => 'buttonStatus', 'style' => 'background-color: orange;']) ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php } ?>
        </div>
    </div>
</div>

<script>



</script>

<style>
    .contain-list {
        margin-left: 30%;
    }

    /* scroll invisible */
    ::-webkit-scrollbar {
        display: none;
    }

    .header {
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 50px;
    }

    .img-aling {
        width: 500px;
        height: 500px;
    }

    /* .contain-search {
        width: 1000px;
    } */

    .search {
        justify-content: center;
        align-items: center;
    }

    .list-citas {
        border-color: red;
        border-style: double;
        border-radius: 25px;
    }


    .form-control {
        height: 40px;
        /* width: 100%; */
    }

    .buttonStatus {
        border-radius: 25px;
        height: 40px;
        width: 100%;
        font-size: 15px;
        color: white;
    }

    /* estilos de boton de busqueda */
    .buttonSearch {
        border-radius: 25px;
        background-color: #EB6060;
        height: 40px;
        width: 100px;
        font-size: 18px;
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
        display: block;
        overflow: scroll;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        max-height: 680px;
        max-width: 2000px;
        padding: 10px;
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