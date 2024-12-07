<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostsGroups Model
 *
 * @property \App\Model\Table\PostsTable&\Cake\ORM\Association\BelongsTo $Posts
 * @property \App\Model\Table\GroupsTable&\Cake\ORM\Association\BelongsTo $Groups
 *
 * @method \App\Model\Entity\PostsGroup newEmptyEntity()
 * @method \App\Model\Entity\PostsGroup newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PostsGroup> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostsGroup get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PostsGroup findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PostsGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PostsGroup> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostsGroup|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PostsGroup saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PostsGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostsGroup>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PostsGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostsGroup> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PostsGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostsGroup>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PostsGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostsGroup> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PostsGroupsTable extends Table
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

        $this->setTable('posts_groups');
        $this->setDisplayField(['post_id', 'group_id']);
        $this->setPrimaryKey(['post_id', 'group_id']);

        $this->belongsTo('Posts', [
            'foreignKey' => 'post_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER',
        ]);
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
        $rules->add($rules->existsIn(['group_id'], 'Groups'), ['errorField' => 'group_id']);

        return $rules;
    }
}
