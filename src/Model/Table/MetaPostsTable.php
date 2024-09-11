<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MetaPosts Model
 *
 * @property \App\Model\Table\PostsTable&\Cake\ORM\Association\BelongsTo $Posts
 *
 * @method \App\Model\Entity\MetaPost newEmptyEntity()
 * @method \App\Model\Entity\MetaPost newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaPost> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MetaPost get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MetaPost findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MetaPost patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaPost> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MetaPost|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MetaPost saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MetaPost>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaPost>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaPost>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaPost> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaPost>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaPost>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaPost>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaPost> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MetaPostsTable extends Table
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

        $this->setTable('meta_posts');
        $this->setDisplayField('meta_key');
        $this->setPrimaryKey('id');

        $this->belongsTo('Posts', [
            'foreignKey' => 'post_id',
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
        $rules->add($rules->existsIn(['post_id'], 'Posts'), ['errorField' => 'post_id']);

        return $rules;
    }

    public function saveMetaData(array $metaData, int $postId)
    {
        $data = [];
        foreach ($metaData as $key => $value) {
            $data[] = [
                'post_id' => $postId,
                'meta_key' => $key,
                'meta_value' => $value, 
            ];
        }

        $metaPosts = $this->newEntities($data);
        if ($this->save($metaPosts)) {
            return true;
        }

        return false;
    }
}
