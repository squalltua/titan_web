<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Groups Model
 *
 * @property \App\Model\Table\GroupsTable&\Cake\ORM\Association\BelongsTo $ParentGroups
 * @property \App\Model\Table\GroupsTable&\Cake\ORM\Association\HasMany $ChildGroups
 * @property \App\Model\Table\PostsTable&\Cake\ORM\Association\BelongsToMany $Posts
 *
 * @method \App\Model\Entity\Group newEmptyEntity()
 * @method \App\Model\Entity\Group newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Group> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Group get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Group findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Group patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Group> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Group|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Group saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Group>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Group>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Group>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Group> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Group>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Group>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Group>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Group> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class GroupsTable extends Table
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

        $this->setTable('groups');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('ParentGroups', [
            'className' => 'Groups',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildGroups', [
            'className' => 'Groups',
            'foreignKey' => 'parent_id',
        ]);
        $this->belongsToMany('Posts', [
            'foreignKey' => 'group_id',
            'targetForeignKey' => 'post_id',
            'joinTable' => 'posts_groups',
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
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 200)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

        $validator
            ->integer('parent_id')
            ->allowEmptyString('parent_id');

        $validator
            ->integer('level')
            ->allowEmptyString('level');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentGroups'), ['errorField' => 'parent_id']);

        return $rules;
    }
}
