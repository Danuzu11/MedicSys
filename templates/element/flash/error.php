<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<!-- <div class="message error" onclick="this.classList.add('hidden');"><?= $message ?></div> -->

<script>
        swal({
            title: "<?php echo $message; ?>",
            icon: "error",
            buttons: {
                confirm: {
                    text: "OK",
                    value: true,
                    visible: true,
                    className: "btn btn-danger"
                }
            }
        }).then(function(value) {
            if (value) {
                // Redirigir a la acción de deslogueo
                window.location.href = "<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'logout']); ?>";
            }
        });
        
</script>