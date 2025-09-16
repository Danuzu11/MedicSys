<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>



<!-- div para que se coloque todo uno debajo del otro -->
<div class="container-main">

    <div class="container-child">

        <h1 class="h1-deco">Configuraciones</h1>

        <p class="bold-deleted">Edita tu perfil y verifica tus afiliados</p>

        <div class="line-white"></div>

        <p class="semi-titulos">Cuenta</p>

        

        <a href="<?= $this->Url->build('/', ['fullBase' => true]) . 'users/editprofile' ?> ">
            <div class="container-opcion link" selector="editar" onmouseover="cambiarColor(this);"
                onmouseout="restaurarColor(this);">
                <img class="img-aling"
                    src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/icons-usuario-con-circulo.png' ?>"
                    alt="Imagen">
                <p class="bold-deleted" id="editar">Editar perfil</p>
                <img class="img-flecha-aling img-aling"
                    src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/icons-flecha-derecha.png' ?>"
                    alt="Imagen">

            </div>
        </a>



        <?= $this->Html->link(
            '<div class="container-opcion link" selector="afiliados" onmouseover="cambiarColor(this);" onmouseout="restaurarColor(this);">' .
            '<img class="img-aling" src="' . $this->Url->build('/', ['fullBase' => true]) . 'img/icons-usuario_1.png" alt="Imagen">' .
            '<p class="bold-deleted" id="afiliados">Afiliados</p>' .
            '<img class="img-flecha-aling img-aling" src="' . $this->Url->build('/', ['fullBase' => true]) . 'img/icons-flecha-derecha.png" alt="Imagen">' .
            '</div>',
            ['controller' => 'Users', 'action' => 'searchAfiliados', $the_user, $the_user_rol],
            ['escape' => false]

        ) ?>

        <!-- 
            <p class="semi-titulos">General</p> -->

        <!-- <a href="<?= $this->Url->build('/', ['fullBase' => true]) . 'users/editprofile' ?>">
                <div class="container-opcion link" selector="terminos" onmouseover="cambiarColor(this);"
                    onmouseout="restaurarColor(this);">

                    <img class="img-aling"
                        src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/icons-terminos.png' ?>"
                        alt="Imagen">

                    <p class="bold-deleted" id="terminos">Terminos de Uso</p>
                    <img class="img-flecha-aling img-aling"
                        src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/icons-flecha-derecha.png' ?>"
                        alt="Imagen">

                </div>
            </a> -->

    </div>



</div>




<script>

    const config = () => {
        function cambiarColor(elemnto) {

            elemnto.style.backgroundColor = '#9c0f44';
            elemnto.style.borderColor = '#9c0f44';

            var color = "white";
            if (elemnto.getAttribute('selector') == "editar") {

                document.getElementById("editar").style.color = color;

            } else if (elemnto.getAttribute('selector') == "afiliados") {

                document.getElementById("afiliados").style.color = color;

            } else {

                document.getElementById("terminos").style.color = color;

            }

        }

        function restaurarColor(elemnto) {

            elemnto.style.backgroundColor = 'transparent';
            elemnto.style.borderColor = '#6f7581';

            var color = "#7d8692";

            if (elemnto.getAttribute('selector') == "editar") {

                document.getElementById("editar").style.color = color;

            } else if (elemnto.getAttribute('selector') == "afiliados") {

                document.getElementById("afiliados").style.color = color;

            } else {

                document.getElementById("terminos").style.color = color;

            }
        }

        return {
            cambiarColor,
            restaurarColor
        };
    };

    const { cambiarColor, restaurarColor } = config();

    document.addEventListener('DOMContentLoaded', () => {
        //   por si acaso
    });


    if (document.getElementById('btn-logout')) {
        const btnLogout = document.getElementById('btn-logout');

        // Agregar un evento click al botón
        btnLogout.addEventListener('click', (event) => {

            // Detener el comportamiento normal del botón
            event.preventDefault();

            // Alerta si confirma deslogeo
            swal({
                title: "Deslogeando..",
                text: "¿Estás seguro de que quieres cerrar sesión?",
                icon: "warning",
                dangerMode: true,
                buttons: ["Ok", "Cancel"],
            }).then((logout) => {
                if (!logout) {
                    swal("Se ah deslogeado exitosamente", {
                        icon: "success",
                    }).then((success) => {
                        // window.location.href = 'users/logout';
                    });
                } else {
                    swal("No se ah deslogeado");
                }
            });

        });
    }
</script>

<style>
    /* estilos de las letras */
    ul {
        color: white;
    }

    h1 {
        font-size: 24px;
        color: white;
    }

    p,
    label {
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




    /*Clases para la seccion ajustes  dv*/

    .container-main {
        margin-top: 3%;
        width: 100%;
        /* arreglar esto en el otro documento*/
        display: flex;
        flex-direction: column;
        align-items: left;
    }

    .container-child {
        margin-left: 40px;
        margin-right: 40px;
        padding-left: 50px;
        padding-top: 50px;
        padding-bottom: 50px;
        border-radius: 15px;
        display: flex;
        flex-direction: column;
        align-items: left;
        background-color: #020617;
    }


    .body-width {
        width: 100%;
    }


    .h1-deco {
        font-size: 26px;
        color: white;
    }

    .line-white {
        width: 90%;
        height: 1px;
        background-color: #6f7581;
        margin-top: 5px;
    }

    .semi-titulos {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .container-opcion {

        border: 1px solid #6f7581;
        border-radius: 5px;
        margin-top: 10px;
        margin-bottom: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 5px;
        width: 90%;
    }

    .bold-deleted {
        font-weight: normal;
        display: inline-block;
    }

    .img-aling {
        display: inline-block;
        width: 20px;
        height: 20px;
    }

    .img-flecha-aling {
        float: right;
        margin-right: 5px;
    }

    /* finde */
</style>