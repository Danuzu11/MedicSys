<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>


<div class="users">

    <div class="text-center ml-6 mb-3 mt-10">
        <h1>Editar Perfil</h1>
    </div>

    <div class="users-perfil">
        <img class="imagePerfil rounded-md h-auto rounded-full"
            src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/avatar.png' ?>" alt="ImagenPerfil">


        <?= $this->Form->create($user) ?>

        <fieldset class="mb-3">
            <legend>
                <?= __('Edit user') ?>
            </legend>

            <div class="form-group">
                <label>
                    <?= __('Nombre usuario') ?>
                </label>
                <input type="text" class="form-control rounded shadow-sm" name="user"
                    value="<?= $user->user ?>">
            </div>

            <div class="form-group">
                <label>
                    <?= __('Password') ?>
                </label>
                <input type="password" class="form-control rounded shadow-sm" name="password" required="required" id="password"
                    value="<?= $user->password ?>">
            </div>

            <div class="form-group">
                <input type="text" class="form-control rounded shadow-sm" name="rol"
                    value="<?= $user->rol ?>" hidden>
            </div>

            <div class="form-group">
                <label>
                    <?= __('Email') ?>
                </label>
                <input type="email" class="form-control rounded shadow-sm" name="email"
                    value="<?= $user->email ?>">
            </div>

            <div class="form-group">
                <label>
                    <?= __('Estado') ?>
                </label>

                <select name="status" class="form-control2 rounded shadow-sm select-status">
                    <option style="color: green;" value="activo">Activo</option>
                    <option style="color: red;" value="inactivo">Inactivo</option>
                </select>
            </div>

            <div class="form-group">
                <input type="text" class="form-control rounded shadow-sm" name="ultima_conexion"
                    value="<?= $user->ultima_conexion ?>" hidden>
            </div>

            
            <!-- <div class="form-group">
                <label>
                    <?= __('Descripcion') ?>
                </label> <br>
                <textarea class="form-control1 rounded shadow-sm text-justify" name="descripcion" rows="5"
                    cols="40"><?= $user->descripcion ?></textarea>
            </div> -->
        </fieldset>

        <?= $this->Form->button(__('Actualizar'), ['class' => 'btn btn-submit rounded shadow-sm']) ?>
        <?= $this->Form->end() ?>

    </div>
</div>

<script>

    const select = document.querySelector('select');
    const status = "<?= $user->status ?>";
    select.value = status;

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
    .users {
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
    .users {
        margin: 0 auto;
        background-color: rgb(2 6 23);
    }

    .form-group {
        color: white;
        padding: 5px;
    }

    .users .form-control:focus {
        outline: none;
        box-shadow: 0 0 0 5px rgba(0, 0, 255, 0.2);
    }

    .users .form-control {
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

    .users .form-control1 {
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