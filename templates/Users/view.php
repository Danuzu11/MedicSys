<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>


<div class="card-view-user ">
    <div class="data-inside text-center content-center">

        <img class="imagePerfil rounded-md h-auto rounded-full"
            src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/avatar.png' ?>" alt="ImagenPerfil">

        <h1>
            Perfil Usuario
        </h1>

        <h3>
            <?= h($user->id) ?>
        </h3>
        <h1>________________________________________</h1>
        <div class="user-wrapper">

            <div class="user-item nombre-user">
                <label>Nombre Usuario</label>
                <span>
                    <?= $user->user ?>
                </span>
            </div>

            <div class="user-item password">
                <label>Password</label>
                <span>
                     ********* 
                </span>
            </div>

            <div class="user-item rol">
                <label>Rol</label>
                <span>
                    <?= h($user->rol) ?>
                </span>
            </div>

            <div class="user-item status">
                <label>Status</label>
                <span>
                    <?= h($user->status) ?>
                </span>
            </div>

            <div class="user-item email">
                <label>Email</label>
                <span>
                    <?= h($user->email) ?>
                </span>
            </div>

            <div class="user-item ultima_conexion">
                <label>Ultima conexion</label>
                <span>
                    <?= h($user->ultima_conexion) ?>
                </span>
            </div>

            
        </div>
        <h1>________________________________________</h1>

        <!-- <div class="row Citas">
            <h4>
                <?= __('Citas') ?>
            </h4>
        </div> -->
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

    .card-view-user {
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
    .user-item {
        color: aquamarine;
        font-size: 0.875rem;
        text-align: center;
        margin-top: 2rem;
        font-size: 20px;
    }

    span,
    .citas {
        color: white;
        font-size: 20px;
    }

    .user-wrapper {
        display: flex;
        flex-direction: column;
    }

    .user-item {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .user-item label {
        width: 20%;
        margin-left: 30%;
    }

    .user-item span {
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