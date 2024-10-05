<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customers Model
 *
 * @method \App\Model\Entity\Customer newEmptyEntity()
 * @method \App\Model\Entity\Customer newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Customer> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Customer get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Customer findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Customer> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Customer|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Customer saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Customer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Customer>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Customer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Customer> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Customer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Customer>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Customer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Customer> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomersTable extends Table
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

        $this->setTable('customers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Contacts', [
            'foreignKey' => 'customer_id',
        ]);
        $this->hasMany('CustomerNotes', [
            'foreignKey' => 'customer_id',
        ]);
        $this->hasMany('MetaCustomers', [
            'foreignKey' => 'customer_id',
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
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 50)
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('address_line_1')
            ->maxLength('address_line_1', 200)
            ->allowEmptyString('address_line_1');

        $validator
            ->scalar('address_line_2')
            ->maxLength('address_line_2', 200)
            ->allowEmptyString('address_line_2');

        $validator
            ->scalar('city')
            ->maxLength('city', 45)
            ->allowEmptyString('city');

        $validator
            ->scalar('province')
            ->maxLength('province', 45)
            ->allowEmptyString('province');

        $validator
            ->scalar('country')
            ->maxLength('country', 45)
            ->allowEmptyString('country');

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 20)
            ->allowEmptyString('postcode');

        $validator
            ->scalar('source')
            ->maxLength('source', 45)
            ->allowEmptyString('source');

        $validator
            ->scalar('contact_type')
            ->maxLength('contact_type', 45)
            ->allowEmptyString('contact_type');

        $validator
            ->scalar('avatar')
            ->allowEmptyString('avatar');

        $validator
            ->date('date_of_birth')
            ->allowEmptyDate('date_of_birth');

        $validator
            ->scalar('status')
            ->maxLength('status', 45)
            ->allowEmptyString('status');

        return $validator;
    }
}
