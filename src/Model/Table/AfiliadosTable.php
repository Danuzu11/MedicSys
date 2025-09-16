<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Afiliados Model
 *
 * @method \App\Model\Entity\Afiliado newEmptyEntity()
 * @method \App\Model\Entity\Afiliado newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Afiliado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Afiliado get($primaryKey, $options = [])
 * @method \App\Model\Entity\Afiliado findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Afiliado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Afiliado[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Afiliado|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Afiliado saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Afiliado[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Afiliado[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Afiliado[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Afiliado[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AfiliadosTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('afiliados');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 255)
            ->requirePresence('nombre', 'create')
            ->notEmptyString('nombre');
            
        $validator
            ->scalar('cedula')
            ->maxLength('cedula', 255)
            ->requirePresence('cedula', 'create')
            ->notEmptyString('cedula');

        $validator
            ->scalar('apellido')
            ->maxLength('apellido', 255)
            ->requirePresence('apellido', 'create')
            ->notEmptyString('apellido');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->date('fecha_nacimiento')
            ->requirePresence('fecha_nacimiento', 'create')
            ->notEmptyDate('fecha_nacimiento');

        $validator
            ->integer('idUser')
            ->requirePresence('idUser', 'create')
            ->notEmptyString('idUser');

        return $validator;
    }
}
