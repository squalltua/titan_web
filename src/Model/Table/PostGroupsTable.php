<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostGroups Model
 *
 * @property \App\Model\Table\PostGroupsTable&\Cake\ORM\Association\BelongsTo $ParentPostGroups
 * @property \App\Model\Table\MetaPostGroupsTable&\Cake\ORM\Association\HasMany $MetaPostGroups
 * @property \App\Model\Table\PostGroupsTable&\Cake\ORM\Association\HasMany $ChildPostGroups
 * @property \App\Model\Table\PostsTable&\Cake\ORM\Association\BelongsToMany $Posts
 *
 * @method \App\Model\Entity\PostGroup newEmptyEntity()
 * @method \App\Model\Entity\PostGroup newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PostGroup> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostGroup get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PostGroup findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PostGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PostGroup> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostGroup|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PostGroup saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PostGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostGroup>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PostGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostGroup> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PostGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostGroup>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PostGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostGroup> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class PostGroupsTable extends Table
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

        $this->setTable('post_groups');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree', [
            'level' => 'level',
        ]);

        $this->belongsTo('ParentPostGroups', [
            'className' => 'PostGroups',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('MetaPostGroups', [
            'foreignKey' => 'post_group_id',
        ]);
        $this->hasMany('ChildPostGroups', [
            'className' => 'PostGroups',
            'foreignKey' => 'parent_id',
        ]);
        $this->belongsToMany('Posts', [
            'foreignKey' => 'post_group_id',
            'targetForeignKey' => 'post_id',
            'joinTable' => 'posts_post_groups',
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
            ->scalar('type')
            ->maxLength('type', 20)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentPostGroups'), ['errorField' => 'parent_id']);

        return $rules;
    }

    /**
     * @return SelectQuery
     */
    public function getCategoriesAll(): SelectQuery
    {
        return $this->find('all')->where(['type' => 'categories']);
    }

    /**
     * @return SelectQuery
     */
    public function getTagsAll(): SelectQuery
    {
        return $this->find('all')->where(['type' => 'tags']);
    }

    /**
     * @return SelectQuery
     */
    public function getCategoriesList(): SelectQuery
    {
        return $this->find('list')->where(['type' => 'categories']);
    }

    /**
     * @return SelectQuery
     */
    public function getTagsList(): SelectQuery
    {
        return $this->find('list')->where(['type' => 'tags']);
    }
}
