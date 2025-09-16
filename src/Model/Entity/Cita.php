<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cita Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $dia_semana
 * @property string|null $description
 * @property string|null $fecha
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $idMedico
 * @property int|null $idafiliado
 * @property string|null $bloque_hora
 * @property string $status
 *
 * @property \App\Model\Entity\User $user
 */
class Cita extends Entity
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
        'user_id' => true,
        'dia_semana' => true,
        'description' => true,
        'fecha' => true,
        'created' => true,
        'modified' => true,
        'idMedico' => true,
        'idafiliado' => true,
        'bloque_hora' => true,
        'status' => true,
        'user' => true,
    ];
}
