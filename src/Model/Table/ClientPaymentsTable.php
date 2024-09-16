<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClientPayments Model
 *
 * @property \App\Model\Table\ClientusersTable&\Cake\ORM\Association\BelongsTo $Clientusers
 *
 * @method \App\Model\Entity\ClientPayment newEmptyEntity()
 * @method \App\Model\Entity\ClientPayment newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ClientPayment> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClientPayment get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ClientPayment findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ClientPayment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ClientPayment> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClientPayment|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ClientPayment saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ClientPayment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ClientPayment>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ClientPayment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ClientPayment> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ClientPayment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ClientPayment>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ClientPayment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ClientPayment> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClientPaymentsTable extends Table
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

        $this->setTable('client_payments');
        $this->setDisplayField('payment_type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Clientusers', [
            'foreignKey' => 'clientuser_id',
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
            ->integer('clientuser_id')
            ->notEmptyString('clientuser_id');

        $validator
            ->scalar('payment_type')
            ->maxLength('payment_type', 45)
            ->requirePresence('payment_type', 'create')
            ->notEmptyString('payment_type');

        $validator
            ->scalar('provider')
            ->maxLength('provider', 200)
            ->requirePresence('provider', 'create')
            ->notEmptyString('provider');

        $validator
            ->scalar('account_number')
            ->maxLength('account_number', 100)
            ->requirePresence('account_number', 'create')
            ->notEmptyString('account_number');

        $validator
            ->date('expire_date')
            ->requirePresence('expire_date', 'create')
            ->notEmptyDate('expire_date');

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
        $rules->add($rules->existsIn(['clientuser_id'], 'Clientusers'), ['errorField' => 'clientuser_id']);

        return $rules;
    }
}
