<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchaseOrders Model
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 *
 * @method \App\Model\Entity\PurchaseOrder newEmptyEntity()
 * @method \App\Model\Entity\PurchaseOrder newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PurchaseOrder> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PurchaseOrder findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PurchaseOrder> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PurchaseOrder>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PurchaseOrder>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PurchaseOrder>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PurchaseOrder> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PurchaseOrder>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PurchaseOrder>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PurchaseOrder>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PurchaseOrder> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PurchaseOrdersTable extends Table
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

        $this->setTable('purchase_orders');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->scalar('title')
            ->maxLength('title', 200)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('content')
            ->allowEmptyString('content');

        $validator
            ->decimal('amount_total')
            ->requirePresence('amount_total', 'create')
            ->notEmptyString('amount_total');

        $validator
            ->decimal('amount_tax')
            ->requirePresence('amount_tax', 'create')
            ->notEmptyString('amount_tax');

        $validator
            ->decimal('amount_discount')
            ->requirePresence('amount_discount', 'create')
            ->notEmptyString('amount_discount');

        $validator
            ->decimal('amount_net')
            ->requirePresence('amount_net', 'create')
            ->notEmptyString('amount_net');

        $validator
            ->scalar('status')
            ->maxLength('status', 45)
            ->allowEmptyString('status');

        $validator
            ->integer('create_uid')
            ->allowEmptyString('create_uid');

        $validator
            ->integer('modified_uid')
            ->allowEmptyString('modified_uid');

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

    public function getStatuses(): array
    {
        return [
            'draft' => __('Draft'),
            'confirmed' => __('Confirmed'),
            'done' => __('Done'),
            'cancel' => __('Cancel'),
        ];
    }
}
