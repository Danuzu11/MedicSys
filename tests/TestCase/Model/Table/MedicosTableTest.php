<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MedicosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MedicosTable Test Case
 */
class MedicosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MedicosTable
     */
    protected $Medicos;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Medicos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Medicos') ? [] : ['className' => MedicosTable::class];
        $this->Medicos = $this->getTableLocator()->get('Medicos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Medicos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MedicosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
