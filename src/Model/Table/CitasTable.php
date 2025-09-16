<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Citas Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Cita newEmptyEntity()
 * @method \App\Model\Entity\Cita newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Cita[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cita get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cita findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Cita patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cita[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cita|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cita saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cita[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cita[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cita[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cita[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CitasTable extends Table
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

        $this->setTable('citas');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
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
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('dia_semana')
            ->maxLength('dia_semana', 50)
            ->allowEmptyString('dia_semana');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('fecha')
            ->maxLength('fecha', 50)
            ->allowEmptyString('fecha');

        $validator
            ->integer('idMedico')
            ->requirePresence('idMedico', 'create')
            ->notEmptyString('idMedico');

        $validator
            ->integer('idafiliado')
            ->allowEmptyString('idafiliado');

        $validator
            ->scalar('bloque_hora')
            ->maxLength('bloque_hora', 50)
            ->allowEmptyString('bloque_hora');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->notEmptyString('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
