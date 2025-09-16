<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Horarios Model
 *
 * @method \App\Model\Entity\Horario newEmptyEntity()
 * @method \App\Model\Entity\Horario newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Horario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Horario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Horario findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Horario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Horario[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Horario|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Horario saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Horario[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Horario[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Horario[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Horario[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HorariosTable extends Table
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

        $this->setTable('horarios');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->integer('medicoid')
            ->requirePresence('medicoid', 'create')
            ->notEmptyString('medicoid');

        $validator
            ->scalar('dia_semana')
            ->maxLength('dia_semana', 255)
            ->requirePresence('dia_semana', 'create')
            ->notEmptyString('dia_semana');

        $validator
            ->scalar('hora')
            ->requirePresence('hora', 'create')
            ->notEmptyString('hora');

        $validator
            ->scalar('estado')
            ->maxLength('estado', 255)
            ->requirePresence('estado', 'create')
            ->notEmptyString('estado');

        return $validator;
    }
}
