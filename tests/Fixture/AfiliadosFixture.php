<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AfiliadosFixture
 */
class AfiliadosFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'nombre' => 'Lorem ipsum dolor ',
                'apellido' => 'Lorem ipsum dolor ',
                'email' => 'Lorem ipsum dolor ',
                'fecha_nacimiento' => '2023-10-20',
                'idUser' => 1,
            ],
        ];
        parent::init();
    }
}
