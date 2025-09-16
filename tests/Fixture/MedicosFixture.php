<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MedicosFixture
 */
class MedicosFixture extends TestFixture
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
                'medico_id' => 1,
                'descripcion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'horario' => 'Lorem ipsum dolor sit amet',
                'nombre_doctor' => 'Lorem ipsum dolor sit amet',
                'especialidad_id' => 1,
                'codigo_doc' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor sit amet',
                'idEspecialidad' => 1,
            ],
        ];
        parent::init();
    }
}
