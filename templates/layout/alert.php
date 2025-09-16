<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>

<!DOCTYPE html>
<html class="h-full bg-slate-900">

<head>
<link rel="icon" href="<?= $this->Url->build('/', ['fullBase' => true]) . 'img/logo-ico.png' ?>" type="image/png">

    <?= $this->Html->charset() ?>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>
        <?= $this->fetch('title') ?>
    </title>
</head>

<body class="h-full bg-slate-900">
    <div id="container">

        <!-- <div id="content">
            <?= $this->Flash->render() ?>

            <?= $this->fetch('content') ?>
        </div> -->

    </div>
</body>

</html>

<?php echo $this->Html->scriptBlock(sprintf('let respuesta = %s;', json_encode($respuesta))); ?>
<?php echo $this->Html->scriptBlock(sprintf('let link = %s;', json_encode($link))); ?>
<?php echo $this->Html->scriptBlock(sprintf('let mensaje = %s;', json_encode($mensaje))); ?>

<script>
    var iconoRespuesta;
    if (respuesta == "Correcto") {
        iconoRespuesta = "success";
    } else if (respuesta == "Error") {
        iconoRespuesta = "error";
    }
    console.log(link);
    swal({
        title: respuesta,
        text: mensaje,
        icon: iconoRespuesta,
        buttons: "Ok",
    }).then((logout) => {

        window.location.href = link;

    });



</script>