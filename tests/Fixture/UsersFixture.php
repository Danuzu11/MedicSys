<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'user' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'rol' => 'Lorem ipsum dolor sit amet',
                'created' => '2023-09-24 02:17:02',
                'modified' => '2023-09-24 02:17:02',
                'email' => 'Lorem ipsum dolor sit amet',
                'ultima_conexion' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
