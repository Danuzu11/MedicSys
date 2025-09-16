<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */

// if (!isset($params['escape']) || $params['escape'] !== false) {
//     $message = h($message);
// }

?>

<script>
        swal({
            title: "<?php echo $swalMessage; ?>",
            icon: "<?php echo $swalType; ?>",
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