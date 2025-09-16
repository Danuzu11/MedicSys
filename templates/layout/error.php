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

 $user = $_SESSION['Auth'];
 $user = $user['User'];
?>

<!DOCTYPE html>
<html class="h-full bg-slate-900">
<head>
    <?= $this->Html->charset() ?>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
</head>
<body class="h-full bg-slate-900">
    <div id="container">

        <div id="content">
            <?= $this->Flash->render() ?>

            <?= $this->fetch('content') ?>
        </div>

    </div>
</body>
</html>