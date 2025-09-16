<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Medico $medico
 */
?>


<div class="card-view-medico ">
    <div class="data-inside text-center content-center">

        <img class="imagePerfil rounded-md h-auto rounded-full"
            src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/avatar.png' ?>" alt="ImagenPerfil">

        <h1>
            Perfil Medico
        </h1>

        <h3>
            <?= h($medico->medico_id) ?>
        </h3>
        <h1>________________________________________</h1>
        <div class="medico-wrapper">

            <div class="medico-item nombre-medico">
                <label>Nombre Medico</label>
                <span>
                    <?= $medico->nombre_doctor ?>
                </span>
            </div>

            <div class="medico-item codigo-medico">
                <label>Codigo Medico</label>
                <span>
                    <?= h($medico->codigo_doc) ?>
                </span>
            </div>

            <div class="medico-item especialidad">
                <label>Especialidad</label>
                <span>
                    <?= h($especialidad->especialidad)?>
                </span>
            </div>

            <div class="medico-item status">
                <label>Status</label>
                <span>
                    <?= h($medico->status) ?>
                </span>
            </div>

            <div class="medico-item horario">
                <label>Horario</label>
                <span>
                    <?= h($medico->horario) ?>
                </span>
            </div>
        </div>
        <h1>________________________________________</h1>

        <div class="row descripcion">
            <h4>
                <?= __('Descripcion') ?>
            </h4>
            <?= h($medico->descripcion) ?>
        </div>
    </div>
</div>

<style>
    /* estilos de icono de perfil */
    .imagePerfil {
        display: block;
        margin: 0 auto;
        width: 100px;
        height: 100px;
    }

    /* Finde */


    /* estilos de la card principal */
    .mainView {
        background-color: rgb(2 6 23);
    }

    .card-view-medico {
        /* padding: 20px; */
        display: block;
        height: 10%;
        width: 80%;
        border-radius: 5px;
        margin-top: 20px;
    }

    .data-inside {
        border-radius: 25px;
        margin-left: 5%;
    }

    /* Finde */


    /* estilos de la tabla */
    .medico-item {
        color: aquamarine;
        font-size: 0.875rem;
        text-align: center;
        margin-top: 2rem;
        font-size: 20px;
    }

    span,
    .descripcion {
        color: white;
        font-size: 20px;
    }

    .medico-wrapper {
        display: flex;
        flex-direction: column;
    }

    .medico-item {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .medico-item label {
        width: 20%;
        margin-left: 30%;
    }

    .medico-item span {
        width: 20%;
        margin-right: 30%;
    }

    /* Finde */


    /* estilos de las letras */
    h3,
    h4 {
        color: red;
        font-size: 20px;
        font-weight: 600;
    }

    h1 {
        color: white;
        font-size: 24px;
        font-weight: bold;
    }

    p {
        font-size: 12px;
        color: #959ea9;
        font-weight: bold;
    }

    /* Finde */
</style>