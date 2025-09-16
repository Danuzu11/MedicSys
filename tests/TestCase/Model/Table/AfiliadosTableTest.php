<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AfiliadosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AfiliadosTable Test Case
 */
class AfiliadosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AfiliadosTable
     */
    protected $Afiliados;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Afiliados',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Afiliados') ? [] : ['className' => AfiliadosTable::class];
        $this->Afiliados = $this->getTableLocator()->get('Afiliados', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Afiliados);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AfiliadosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
