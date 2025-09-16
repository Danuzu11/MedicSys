<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Medicos Model
 *
 * @method \App\Model\Entity\Medico newEmptyEntity()
 * @method \App\Model\Entity\Medico newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Medico[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Medico get($primaryKey, $options = [])
 * @method \App\Model\Entity\Medico findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Medico patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Medico[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Medico|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Medico saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Medico[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Medico[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Medico[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Medico[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MedicosTable extends Table
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

        $this->setTable('medicos');
        $this->setDisplayField('medico_id');
        $this->setPrimaryKey('medico_id');

        $this->belongsTo('Especialidades', [
            'foreignKey' => 'especialidad_id',
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
            ->scalar('descripcion')
            ->allowEmptyString('descripcion');

        $validator
            ->scalar('horario')
            ->maxLength('horario', 50)
            ->allowEmptyString('horario');

        $validator
            ->scalar('nombre_doctor')
            ->maxLength('nombre_doctor', 255)
            ->allowEmptyString('nombre_doctor');

        $validator
            ->integer('especialidad_id')
            ->allowEmptyString('especialidad_id');

        $validator
            ->scalar('codigo_doc')
            ->maxLength('codigo_doc', 255)
            ->allowEmptyString('codigo_doc');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->allowEmptyString('status');

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
        $rules->add($rules->existsIn('especialidad_id', 'Especialidades'), ['errorField' => 'especialidad_id']);

        return $rules;
    }
}
