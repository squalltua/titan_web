<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clientusers Model
 *
 * @property \App\Model\Table\ClientAddressesTable&\Cake\ORM\Association\HasMany $ClientAddresses
 * @property \App\Model\Table\ClientPaymentsTable&\Cake\ORM\Association\HasMany $ClientPayments
 * @property \App\Model\Table\PostCommentsTable&\Cake\ORM\Association\HasMany $PostComments
 *
 * @method \App\Model\Entity\Clientuser newEmptyEntity()
 * @method \App\Model\Entity\Clientuser newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Clientuser> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Clientuser get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Clientuser findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Clientuser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Clientuser> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Clientuser|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Clientuser saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Clientuser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Clientuser>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Clientuser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Clientuser> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Clientuser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Clientuser>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Clientuser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Clientuser> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClientusersTable extends Table
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

        $this->setTable('clientusers');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ClientAddresses', [
            'foreignKey' => 'clientuser_id',
        ]);
        $this->hasMany('ClientPayments', [
            'foreignKey' => 'clientuser_id',
        ]);
        $this->hasMany('PostComments', [
            'foreignKey' => 'clientuser_id',
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
            ->scalar('username')
            ->maxLength('username', 45)
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('full_name')
            ->maxLength('full_name', 200)
            ->requirePresence('full_name', 'create')
            ->notEmptyString('full_name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('phone_number')
            ->maxLength('phone_number', 15)
            ->requirePresence('phone_number', 'create')
            ->notEmptyString('phone_number');

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
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
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);

        return $rules;
    }

    /**
     * get one user from id
     * 
     * @param string $id
     * @return mixed
     */
    public function getUser(string $id)
    {
        return $this->find()
            ->select([
                'Clientusers.id',
                'Clientusers.username',
                'Clientusers.full_name',
                'Clientusers.status',
                'Clientusers.email',
                'Clientusers.created',
                'Clientusers.modified'
            ])
            ->where(['Clientusers.id' => $id])
            ->first();
    }

    public function getAllUsers(?string $keyword): SelectQuery
    {
        if (empty($keyword)) {
            $conditions = [];
        } else {
            $conditions = [
                'or' => [
                    'Clientusers.full_name LIKE' => "%{$keyword}%",
                    'Clientusers.username LIKE' => "%{$keyword}%",
                    'Clientusers.email LIKE' => "%{$keyword}%",
                ]
            ];
        }

        return $this->find()
            ->select([
                'Clientusers.id',
                'Clientusers.username',
                'Clientusers.full_name',
                'Clientusers.status',
                'Clientusers.email',
                'Clientusers.created',
                'Clientusers.modified'
            ])
            ->where($conditions);
    }
}