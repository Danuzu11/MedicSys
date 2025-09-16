<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="users">

    <div class="text-center ml-6 mb-3 mt-10">
        <h1>Agregar Usuario</h1>
    </div>

    <div class="users-perfil">
        <img class="imagePerfil rounded-md h-auto rounded-full"
            src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/avatar.png' ?>" alt="ImagenPerfil">


        <?= $this->Form->create($user) ?>

        <fieldset class="mb-3">
            <legend>
                <?= __('Agregar Paciente') ?>
            </legend>

            <!-- <div class="form-group">
                <label>
                    <?= __('Nombre usuario') ?>
                </label>
                <input type="text" class="form-control rounded shadow-sm" name="user" value="<?= $user->user ?>">
            </div> -->

            <div class="form-group">
                <label><?= __('Nombre usuario') ?></label>
                <input type="text" class="form-control rounded shadow-sm" name="user" id="userInput" oninput="validateUsername()">
                <div id="usernameWarning" style="color: red; display: none;">El nombre de usuario no puede contener espacios.</div>
            </div>


            <!-- <div class="form-group">
                <label>
                    <?= __('Contraseña') ?>
                </label>
                <input type="password" class="form-control rounded shadow-sm" name="password" required="required"
                    id="password" value="<?= $user->password ?>">
            </div> -->

            <div class="form-group">
                <label><?= __('Contraseña') ?></label>
                <input type="password" class="form-control rounded shadow-sm" name="password" id="passwordInput"  id="password" value="<?= $user->password ?>" required>
                <!-- <div id="passwordStrength" style="color: green;">Fortaleza de contraseña: Débil</div> -->
            </div>

            <div class="form-group">
                <label>
                    <?= __('Rol') ?>
                </label>
                <!-- <input type="text" class="form-control rounded shadow-sm" name="rol" value="<?= $user->rol ?>"> -->

                <select name="rol" class="form-control2 rounded shadow-sm select-status ml-6" required>
                    <option style="color: green;" value="1">Admin</option>
                    <option style="color: blue;" value="2">Paciente</option>
                </select>
            </div>

            <div class="form-group">
                <label>
                    <?= __('Email') ?>
                </label>
                <input type="email" class="form-control rounded shadow-sm" name="email" value="<?= $user->email ?>" required>
            </div>

            <div class="form-group">
                <label>
                    <?= __('Estado') ?>
                </label>

                <select name="status" class="form-control2 rounded shadow-sm select-status" required>
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

        <?= $this->Form->button(__('Agregar'), ['class' => 'btn btn-submit rounded shadow-sm']) ?>
        <?= $this->Form->end() ?>

    </div>
</div>

<script>

    const select = document.querySelector('select');
    const status = "<?= $user->status ?>";
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

    function validateUsername() {
    const userInput = document.getElementById("userInput");
    const usernameWarning = document.getElementById("usernameWarning");
    
    // Expresión regular para verificar espacios en blanco
    const regex = /\s/;
    
    if (regex.test(userInput.value)) {
        usernameWarning.style.display = "block";
    } else {
        usernameWarning.style.display = "none";
    }
}

// function validatePassword() {
//     const passwordInput = document.getElementById("passwordInput");
//     const passwordStrength = document.getElementById("passwordStrength");

//     // Expresión regular para verificar la fortaleza de la contraseña
//     const regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,}$/;
   
//     // ^: Coincide con el inicio de la cadena.
//     // (?=.*[A-Z]): Debe contener al menos una letra mayúscula.
//     // (?=.*[a-z]): Debe contener al menos una letra minúscula.
//     // (?=.*\d): Debe contener al menos un dígito.
//     // (?=.*[@$!%*?&]): Debe contener al menos uno de los caracteres especiales: @, $, !, %, *, ?, o &.
//     // [A-Za-z\d@$!%*?&]{8,}: La contraseña debe estar formada por caracteres alfanuméricos y los caracteres especiales mencionados y tener al menos 8 caracteres de longitud.
//     // $: Coincide con el final de la cadena.


//     if (regex.test(passwordInput.value)) {
//         // La contraseña cumple con los requisitos
//         passwordStrength.textContent = "Fortaleza de contraseña: Fuerte";
//         passwordStrength.style.color = "green";
//     } else {
//         // La contraseña no cumple con los requisitos
//         passwordStrength.textContent = "Fortaleza de contraseña: Débil, la contraseña debe contener al menos: una letra mayuscula, una letra minuscula, un digito, un caracter especial.";
//         passwordStrength.style.color = "red";
//     }
// }


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

    /* estilos de vista main */
    .users {
        overflow: auto;
        width: 30%;
    }

    .mainView {
        background-color: rgb(2 6 23);
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

    /* estilos de icono de perfil */
    .imagePerfil {
        margin-left: 40%;
        width: 120px;
        height: 120px;
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