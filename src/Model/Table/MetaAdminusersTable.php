<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MetaAdminusers Model
 *
 * @property \App\Model\Table\AdminusersTable&\Cake\ORM\Association\BelongsTo $Adminusers
 *
 * @method \App\Model\Entity\MetaAdminuser newEmptyEntity()
 * @method \App\Model\Entity\MetaAdminuser newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaAdminuser> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MetaAdminuser get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MetaAdminuser findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MetaAdminuser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaAdminuser> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MetaAdminuser|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MetaAdminuser saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MetaAdminuser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaAdminuser>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaAdminuser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaAdminuser> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaAdminuser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaAdminuser>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaAdminuser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaAdminuser> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MetaAdminusersTable extends Table
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

        $this->setTable('meta_adminusers');
        $this->setDisplayField('meta_key');
        $this->setPrimaryKey('id');

        $this->belongsTo('Adminusers', [
            'foreignKey' => 'adminuser_id',
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
            ->integer('adminuser_id')
            ->notEmptyString('adminuser_id');

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
        $rules->add($rules->existsIn(['adminuser_id'], 'Adminusers'), ['errorField' => 'adminuser_id']);

        return $rules;
    }
}
