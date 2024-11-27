<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Datasource\ConnectionManager;
use Cake\Database\Connection;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Adminusers Model
 *
 * @property \App\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 * @property \App\Model\Table\MetaAdminusersTable&\Cake\ORM\Association\HasMany $MetaAdminusers
 * @property \App\Model\Table\PostsTable&\Cake\ORM\Association\HasMany $Posts
 *
 * @method \App\Model\Entity\Adminuser newEmptyEntity()
 * @method \App\Model\Entity\Adminuser newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Adminuser> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Adminuser get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Adminuser findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Adminuser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Adminuser> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Adminuser|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Adminuser saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Adminuser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Adminuser>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Adminuser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Adminuser> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Adminuser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Adminuser>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Adminuser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Adminuser> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AdminusersTable extends Table
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

        $this->setTable('adminusers');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('MetaAdminusers', [
            'foreignKey' => 'adminuser_id',
        ]);
        $this->hasMany('Posts', [
            'foreignKey' => 'adminuser_id',
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
            ->scalar('full_name')
            ->maxLength('full_name', 200)
            ->requirePresence('full_name', 'create')
            ->notEmptyString('full_name');

        $validator
            ->scalar('username')
            ->maxLength('username', 200)
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->email('email')
            ->notEmptyString('email');

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->integer('role_id')
            ->notEmptyString('role_id');

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
        $rules->add($rules->existsIn(['role_id'], 'Roles'), ['errorField' => 'role_id']);

        return $rules;
    }

    public function getUser(string $id)
    {
        return $this->find()
        ->select(['AdminUsers.id', 'AdminUsers.username', 'AdminUsers.full_name', 'AdminUsers.role_id', 'AdminUsers.status', 'AdminUsers.email', 'AdminUsers.created', 'AdminUsers.modified'])
        ->where(['AdminUsers.id' => $id])
        ->contain(['Roles'])
        ->first();
    }

    public function alreadyHaveAdmin()
    {
        $userAdmin = $this->find()->where(['username' => 'admin'])->first();
        
        return !is_null($userAdmin);
    }
}
