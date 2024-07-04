<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MetaUsers Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\MetaUser newEmptyEntity()
 * @method \App\Model\Entity\MetaUser newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaUser> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MetaUser get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MetaUser findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MetaUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaUser> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MetaUser|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MetaUser saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MetaUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaUser>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaUser> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaUser>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaUser> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MetaUsersTable extends Table
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

        $this->setTable('meta_users');
        $this->setDisplayField('meta_key');
        $this->setPrimaryKey('id');

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
            ->scalar('meta_key')
            ->maxLength('meta_key', 255)
            ->requirePresence('meta_key', 'create')
            ->notEmptyString('meta_key');

        $validator
            ->scalar('meta_value')
            ->requirePresence('meta_value', 'create')
            ->notEmptyString('meta_value');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
