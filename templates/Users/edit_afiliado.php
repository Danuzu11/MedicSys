<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\afiliado $afiliado
 */
    // debug($afiliado);
    // die;
?>

<div class="container body-width">

    <h1 class="h1-deco mt-10">Afiliado</h1>

    

    <!-- del formulario en cuestion -->

    <div class="afiliado-perfil">

        <!-- <?= $this->Form->create($afiliado) ?> -->
        <?= $this->Form->create($afiliado, ['url' => ['controller' => 'Users', 'action' => 'editAfiliado/'.$afiliado->id], 'type' => 'post']) ?>


        <fieldset class="mb-3">

            <!-- <legend>
                <?= __('Edit Afiliado') ?>
            </legend> -->

            <div class="form-group">
                
                <div class="row flex mx-4">
                    <label>
                        <?= __('Tipo de documento') ?>
                    </label>
                    <?php
                     $primeraLetraCedula = substr($afiliado->cedula, 0, 1);
                    ?>
                <div class="form-check mx-4">
                    
                    <input class="form-check-input" type="radio" name="tipo" id="tipoV" value="V" required
                    <?= ($primeraLetraCedula === 'V') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="tipoV">
                    V
                    </label>
                </div>

                <div class="form-check mx-4">
                    <input class="form-check-input" type="radio" name="tipo" id="tipoE" value="E" required
                    <?= ($primeraLetraCedula === 'E') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="tipoE">
                    E
                    </label>
                </div>
                <div class="form-check mx-4">
                    <input class="form-check-input" type="radio" name="tipo" id="tipoP" value="P" required
                    <?= ($primeraLetraCedula === 'P') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="tipoP">
                    P
                    </label>
                </div>
                <div class="form-check mx-4">
                    <input class="form-check-input" type="radio" name="tipo" id="tipoNA" value="N/A" required
                    <?= ($primeraLetraCedula === 'N') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="tipoNA">
                     N/A
                    </label>
                </div>


                    <input type="text" class="ml-8 form-control rounded shadow-sm" name="idUser" value="<?= $afiliado->idUser ?>"
                    hidden>
           
                </div>
            </div>

            <div class="form-group">
            <label>
                </label>
                <?php if ($primeraLetraCedula !== 'N') : ?>
                <?= __('Cédula') ?>
                <input type="text" class="ml-10 form-control rounded shadow-sm" name="cedula" value="<?= substr($afiliado->cedula, 2) ?>" pattern="[0-9]*" required>
                <?php endif; ?>
            </div>


            <div class="form-group">
                <label>
                    <?= __('Nombre') ?>
                </label>
                <input type="text" class="ml-8 form-control rounded shadow-sm" name="nombre" value="<?= $afiliado->nombre ?>"
                    required>
            </div>

            <div class="form-group">
                <label>
                    <?= __('Apellido') ?>
                </label>
                <input type="text" class="ml-8 form-control rounded shadow-sm" name="apellido"
                    value="<?= $afiliado->apellido ?>" required>
            </div>

            <div class="form-group">
                <label>
                    <?= __('Email') ?>
                </label>
                <input type="email" class="ml-12 form-control rounded shadow-sm" name="email" value="<?= $afiliado->email ?>" pattern="/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"
                    required>
            </div>

            <div class="form-group">
                <label>
                    <?= __('Fecha de nacimiento') ?>
                </label>
                <input type="date" class="form-control rounded shadow-sm" name="fecha_nacimiento"
                    value="<?= date_format($afiliado->fecha_nacimiento, 'Y-m-d') ?>" required>
            </div>
            <input type="text" class="ml-8 form-control rounded shadow-sm" name="idUser" value="<?= $afiliado->idUser ?>"
                    hidden>
        </fieldset>

        <?= $this->Form->button(__('Guardar cambios'), ['class' => 'btn btn-submit rounded shadow-sm']) ?>
        <?= $this->Form->end()?>
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



</script>

<style>
    input{
        color: black;
    }
    /* estilos de boton actualizar */

    .afiliado-perfil{
        /* background-color: aqua; */
        padding: auto;
        margin: 0 300px 0 200px;
    }

    .h1-deco{
        margin: 100px 300px 0 300px;
    }
    .btn-submit {
        border-radius: 25px;
        background-color: #EB6060;
        height: 40px;
        width: 60%;
        font-size: 14px;
        color: white;
        margin-left:7%;
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
        border-radius: 5px;
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
        font-size: 50px;
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
        /* color: white; */
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