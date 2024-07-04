<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MetaPostGroups Model
 *
 * @property \App\Model\Table\PostGroupsTable&\Cake\ORM\Association\BelongsTo $PostGroups
 *
 * @method \App\Model\Entity\MetaPostGroup newEmptyEntity()
 * @method \App\Model\Entity\MetaPostGroup newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaPostGroup> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MetaPostGroup get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MetaPostGroup findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MetaPostGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaPostGroup> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MetaPostGroup|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MetaPostGroup saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MetaPostGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaPostGroup>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaPostGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaPostGroup> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaPostGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaPostGroup>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaPostGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaPostGroup> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MetaPostGroupsTable extends Table
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

        $this->setTable('meta_post_groups');
        $this->setDisplayField('meta_key');
        $this->setPrimaryKey('id');

        $this->belongsTo('PostGroups', [
            'foreignKey' => 'post_group_id',
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
            ->integer('post_group_id')
            ->notEmptyString('post_group_id');

        $validator
            ->scalar('meta_key')
            ->maxLength('meta_key', 255)
            ->requirePresence('meta_key', 'create')
            ->notEmptyString('meta_key');

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
        $rules->add($rules->existsIn(['post_group_id'], 'PostGroups'), ['errorField' => 'post_group_id']);

        return $rules;
    }
}
