<div class="container">
    <img class="logo" src= "<?= $this->Url->build('/', ['fullBase' => true]) . 'img/image/LogoDoc.png'?>">
    <h1>MedicSys</h1>
</div>

<div class="green-line">
    <div class="titulo word">
        Actualizacion de Navegador Requerida
    </div>
    <div class="word">
        <p>Lamentablemente hemos detectado que estás utilizando una versión antigua de tu navegador. Para disfrutar de todas las 
            funcionalidades de nuestro sitio web, por favor actualiza tu navegador a una versión más reciente.</p>
    </div>
</div>

<div class="container-images">
    <a href="https://www.google.com/intl/es_es/chrome/" class="chrome">
        <div class="light">
            <img class="images" src="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/image/chrome-.png'?>" alt="chrome">
            <div id="descrip" class="word">Chrome</div>
        </div>
    </a>

    <a href="https://www.mozilla.org/es-ES/firefox/new/" >
        <div class="light">
            <img class="images" src= "<?= $this->Url->build('/', ['fullBase' => true]) . 'img/image/mozilla.png'?>" alt="mozilla">
            <div id="descrip" class="word">Mozilla</div>
        </div>
    </a>

    <a href="https://www.opera.com/es" >
        <div class="light">
            <img class="images" src= "<?= $this->Url->build('/', ['fullBase' => true]) . 'img/image/opera.png'?>"  alt="opera">
            <div id="descrip" class="word">Opera</div>
        </div>
    </a>

    <a href="https://www.microsoft.com/es-es/edge/download" id="last-img">
        <div class="light">
            <img class="images" src= "<?= $this->Url->build('/', ['fullBase' => true]) . 'img/image/edge1.png'?>" alt="edge">
            <div id="descrip" class="word">Edge</div>
        </div>
    </a>

</div>


<style>

    .green-line {
        width: 100%;
        min-height: 200px;
        background-color: #134e04;
        padding-top: 60px;
        padding-bottom: 30px;
    }

    h1,
    .word {
        margin-top: 20px;
        color: white;
        font-weight: inherit;
        tab-size: 4;
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }

    .logo {
        display: inline-block;
        margin-right: 15px;
        max-width: 70px;
        max-height: 70px;
        border-radius: 0.375rem;
    }

    .container {
        margin-bottom: 10px;
        margin-top: 10px;
        margin-left: 15px;
        display: flex;
        /* Establecer el contenedor como flex */
        align-items: center;
        /* Centrar verticalmente */
        justify-content: left;
        /* Centrar horizontalmente */
    }

    .container-images {
        /*padding-left: 123px;*/
        flex-wrap: wrap;
        /* Hacer que los elementos pasen a la siguiente línea */
        /*padding-right: 123px;*/
        margin-top: 50px;
        margin-bottom: 50px;
        height: 100%;
        display: flex;
        /* Establecer el contenedor como flex */
        align-items: center;
        /* Centrar verticalmente */
        justify-content: center;
        /* Centrar horizontalmente */
    }

    .titulo {
        text-align: center;
        font-size: 50px;
    }

    .images {
        width: 220px;
        height: 220px;
        padding-top: 10%;


    }

    .light {

        background-color: #0e1634;
        color: white;
        text-align: center;
        line-height: 100px;
        transition: background-color 0.5s;
        border-radius: 10%;
        /* Redondear los bordes al 10% */
    }

    .light:hover {
        background-color: rgba(255, 255, 255, 0.2);
        /* Iluminar el fondo al pasar el cursor */
    }

    #last-img {
        margin-right: 0px;
    }

    #descrip {
        height: 20px;
        font-size: 20px;
        line-height: 0px;
    }

    p {
        text-align: center;
        font-size: 24px;
        padding-left: 50px;
        padding-right: 50px;
    }

    a {
        margin-right: 10%;
        text-decoration: none;
    }
    @media (max-width: 1258px) {
        /* Estilos para pantallas más pequeñas de 1258px */
        .chrome {
            margin-left: 10%;
        } /* Cambia el valor de padding según lo que necesites */
   
    }  
    @media (min-width: 1258px) {
        /* Estilos para pantallas más grandes de 1258px */
        .chrome {
            margin-left: 0px;
        } /* Cambia el valor de padding según lo que necesites */
   
    }          
</style>