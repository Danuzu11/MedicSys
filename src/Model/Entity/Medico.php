<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Medico Entity
 *
 * @property int $medico_id
 * @property string|null $descripcion
 * @property string|null $horario
 * @property string|null $nombre_doctor
 * @property int|null $especialidad_id
 * @property string|null $codigo_doc
 * @property string|null $status
 * @property int $idEspecialidad
 */
class Medico extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'descripcion' => true,
        'horario' => true,
        'nombre_doctor' => true,
        'especialidad_id' => true,
        'codigo_doc' => true,
        'status' => true,
        'idEspecialidad' => true,
    ];
}
