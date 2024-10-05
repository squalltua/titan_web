<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomerNotes Model
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\CustomerNotesTable&\Cake\ORM\Association\BelongsTo $ParentCustomerNotes
 * @property \App\Model\Table\CustomerNotesTable&\Cake\ORM\Association\HasMany $ChildCustomerNotes
 *
 * @method \App\Model\Entity\CustomerNote newEmptyEntity()
 * @method \App\Model\Entity\CustomerNote newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\CustomerNote> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CustomerNote get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\CustomerNote findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\CustomerNote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\CustomerNote> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CustomerNote|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\CustomerNote saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\CustomerNote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CustomerNote>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CustomerNote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CustomerNote> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CustomerNote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CustomerNote>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CustomerNote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CustomerNote> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomerNotesTable extends Table
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

        $this->setTable('customer_notes');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ParentCustomerNotes', [
            'className' => 'CustomerNotes',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildCustomerNotes', [
            'className' => 'CustomerNotes',
            'foreignKey' => 'parent_id',
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
            ->integer('parent_id')
            ->allowEmptyString('parent_id');

        $validator
            ->scalar('title')
            ->maxLength('title', 200)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('content')
            ->allowEmptyString('content');

        $validator
            ->scalar('type')
            ->maxLength('type', 45)
            ->allowEmptyString('type');

        $validator
            ->allowEmptyString('is_private');

        $validator
            ->scalar('status')
            ->maxLength('status', 45)
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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'), ['errorField' => 'customer_id']);
        $rules->add($rules->existsIn(['parent_id'], 'ParentCustomerNotes'), ['errorField' => 'parent_id']);

        return $rules;
    }
}
