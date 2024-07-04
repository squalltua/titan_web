<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostsPostGroups Model
 *
 * @property \App\Model\Table\PostsTable&\Cake\ORM\Association\BelongsTo $Posts
 * @property \App\Model\Table\PostGroupsTable&\Cake\ORM\Association\BelongsTo $PostGroups
 *
 * @method \App\Model\Entity\PostsPostGroup newEmptyEntity()
 * @method \App\Model\Entity\PostsPostGroup newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PostsPostGroup> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostsPostGroup get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PostsPostGroup findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PostsPostGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PostsPostGroup> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostsPostGroup|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PostsPostGroup saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PostsPostGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostsPostGroup>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PostsPostGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostsPostGroup> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PostsPostGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostsPostGroup>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PostsPostGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostsPostGroup> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PostsPostGroupsTable extends Table
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

        $this->setTable('posts_post_groups');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Posts', [
            'foreignKey' => 'post_id',
            'joinType' => 'INNER',
        ]);
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
            ->integer('post_id')
            ->notEmptyString('post_id');

        $validator
            ->integer('post_group_id')
            ->notEmptyString('post_group_id');

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
        $rules->add($rules->existsIn(['post_id'], 'Posts'), ['errorField' => 'post_id']);
        $rules->add($rules->existsIn(['post_group_id'], 'PostGroups'), ['errorField' => 'post_group_id']);

        return $rules;
    }
}
