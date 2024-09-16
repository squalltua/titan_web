<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClientAddresses Model
 *
 * @property \App\Model\Table\ClientusersTable&\Cake\ORM\Association\BelongsTo $Clientusers
 *
 * @method \App\Model\Entity\ClientAddress newEmptyEntity()
 * @method \App\Model\Entity\ClientAddress newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ClientAddress> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClientAddress get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ClientAddress findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ClientAddress patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ClientAddress> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClientAddress|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ClientAddress saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ClientAddress>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ClientAddress>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ClientAddress>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ClientAddress> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ClientAddress>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ClientAddress>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ClientAddress>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ClientAddress> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClientAddressesTable extends Table
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

        $this->setTable('client_addresses');
        $this->setDisplayField('id');
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
            ->scalar('address_line1')
            ->allowEmptyString('address_line1');

        $validator
            ->scalar('address_line2')
            ->allowEmptyString('address_line2');

        $validator
            ->scalar('city')
            ->maxLength('city', 100)
            ->allowEmptyString('city');

        $validator
            ->scalar('province')
            ->maxLength('province', 100)
            ->allowEmptyString('province');

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 10)
            ->allowEmptyString('postcode');

        $validator
            ->scalar('country')
            ->maxLength('country', 100)
            ->allowEmptyString('country');

        $validator
            ->scalar('telephone_number')
            ->maxLength('telephone_number', 15)
            ->allowEmptyString('telephone_number');

        $validator
            ->scalar('mobile_number')
            ->maxLength('mobile_number', 15)
            ->allowEmptyString('mobile_number');

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
