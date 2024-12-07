<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostComments Model
 *
 * @property \App\Model\Table\PostsTable&\Cake\ORM\Association\BelongsTo $Posts
 * @property \App\Model\Table\PostCommentsTable&\Cake\ORM\Association\BelongsTo $ParentPostComments
 * @property \App\Model\Table\ClientusersTable&\Cake\ORM\Association\BelongsTo $Clientusers
 * @property \App\Model\Table\PostCommentsTable&\Cake\ORM\Association\HasMany $ChildPostComments
 *
 * @method \App\Model\Entity\PostComment newEmptyEntity()
 * @method \App\Model\Entity\PostComment newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PostComment> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostComment get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PostComment findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PostComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PostComment> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostComment|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PostComment saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PostComment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostComment>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PostComment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostComment> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PostComment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostComment>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PostComment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PostComment> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PostCommentsTable extends Table
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

        $this->setTable('post_comments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Posts', [
            'foreignKey' => 'posts_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ParentPostComments', [
            'className' => 'PostComments',
            'foreignKey' => 'parent_id',
        ]);
        $this->belongsTo('Clientusers', [
            'foreignKey' => 'clientuser_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('ChildPostComments', [
            'className' => 'PostComments',
            'foreignKey' => 'parent_id',
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
            ->integer('posts_id')
            ->notEmptyString('posts_id');

        $validator
            ->integer('parent_id')
            ->allowEmptyString('parent_id');

        $validator
            ->scalar('content')
            ->allowEmptyString('content');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->allowEmptyString('status');

        $validator
            ->integer('clientuser_id')
            ->notEmptyString('clientuser_id');

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
        $rules->add($rules->existsIn(['posts_id'], 'Posts'), ['errorField' => 'posts_id']);
        $rules->add($rules->existsIn(['parent_id'], 'ParentPostComments'), ['errorField' => 'parent_id']);
        $rules->add($rules->existsIn(['clientuser_id'], 'Clientusers'), ['errorField' => 'clientuser_id']);

        return $rules;
    }
}
