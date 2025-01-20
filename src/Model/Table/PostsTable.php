<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\I18n\I18n;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Posts Model
 *
 * @property \App\Model\Table\AdminusersTable&\Cake\ORM\Association\BelongsTo $Adminusers
 * @property \App\Model\Table\MetaPostsTable&\Cake\ORM\Association\HasMany $MetaPosts
 * @property \App\Model\Table\GroupsTable&\Cake\ORM\Association\BelongsToMany $Groups
 *
 * @method \App\Model\Entity\Post newEmptyEntity()
 * @method \App\Model\Entity\Post newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Post> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Post get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Post findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Post patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Post> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Post|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Post saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Post>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Post>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Post>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Post> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Post>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Post>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Post>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Post> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PostsTable extends Table
{
    public array $imageKey = [
        'feature_image',
        'og_tag_image',
    ];

    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('posts');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Translate', [
            'strategyClass' => \Cake\ORM\Behavior\Translate\EavStrategy::class,
            'fields' => ['title', 'slug', 'intro', 'content'],
            'defaultLocale' => 'en',
        ]);

        $this->belongsTo('Adminusers', [
            'foreignKey' => 'adminuser_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('MetaPosts', [
            'foreignKey' => 'post_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->belongsToMany('Groups', [
            'foreignKey' => 'post_id',
            'targetForeignKey' => 'group_id',
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
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

        $validator
            ->scalar('intro')
            ->requirePresence('intro', 'create')
            ->notEmptyString('intro');

        $validator
            ->scalar('content')
            ->requirePresence('content', 'create')
            ->notEmptyString('content');

        $validator
            ->scalar('type')
            ->maxLength('type', 20)
            ->allowEmptyString('type');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->dateTime('publish_date')
            ->allowEmptyDateTime('publish_date');

        $validator
            ->integer('adminuser_id')
            ->notEmptyString('adminuser_id');

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

    /**
     * get all posts for datatable
     *
     * @param array|empty $conditions
     * @return SelectQuery
     */
    public function getAllPosts(array $conditions = []): SelectQuery
    {
        return $this->find('all')
            ->where($conditions)
            ->orderByDesc('created');
    }

    /**
     * NOTE: May not be used
     * @param string $slug
     * @return mixed
     */
    public function getPostWithSlug(string $slug)
    {
        return $this->find()->where(['slug' => $slug])->contain(['MetaPosts'])->first();
    }

    /**
     * get post data (single)
     *
     * @param string $id
     * @param string|null $lang
     * @return mixed
     */
    public function getPostData(string $id, ?string $lang): mixed
    {
        I18n::setLocale($lang);
        $post = $this->find('all')->where(['Posts.id' => $id])->contain(['MetaPosts', 'Groups'])->first();

        return $post;
    }
}
