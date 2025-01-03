<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MetaCustomers Model
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 *
 * @method \App\Model\Entity\MetaCustomer newEmptyEntity()
 * @method \App\Model\Entity\MetaCustomer newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaCustomer> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MetaCustomer get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MetaCustomer findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MetaCustomer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaCustomer> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MetaCustomer|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MetaCustomer saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MetaCustomer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaCustomer>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaCustomer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaCustomer> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaCustomer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaCustomer>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaCustomer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaCustomer> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MetaCustomersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('meta_customers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
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
            ->integer('customer_id')
            ->notEmptyString('customer_id');

        $validator
            ->scalar('meta_key')
            ->maxLength('meta_key', 255)
            ->allowEmptyString('meta_key');

        $validator
            ->scalar('meta_value')
            ->allowEmptyString('meta_value');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'), ['errorField' => 'customer_id']);

        return $rules;
    }
}
