<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductReviews Model
 *
 * @property \App\Model\Table\ProductReviewsTable&\Cake\ORM\Association\BelongsTo $ParentProductReviews
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\ProductReviewsTable&\Cake\ORM\Association\HasMany $ChildProductReviews
 *
 * @method \App\Model\Entity\ProductReview newEmptyEntity()
 * @method \App\Model\Entity\ProductReview newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductReview> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductReview get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ProductReview findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ProductReview patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductReview> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductReview|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ProductReview saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ProductReview>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductReview>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductReview>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductReview> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductReview>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductReview>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductReview>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductReview> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductReviewsTable extends Table
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

        $this->setTable('product_reviews');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ParentProductReviews', [
            'className' => 'ProductReviews',
            'foreignKey' => 'parent_id',
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('ChildProductReviews', [
            'className' => 'ProductReviews',
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
            ->scalar('title')
            ->maxLength('title', 100)
            ->allowEmptyString('title');

        $validator
            ->scalar('content')
            ->allowEmptyString('content');

        $validator
            ->allowEmptyString('rating');

        $validator
            ->integer('parent_id')
            ->allowEmptyString('parent_id');

        $validator
            ->integer('product_id')
            ->notEmptyString('product_id');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->allowEmptyString('status');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentProductReviews'), ['errorField' => 'parent_id']);
        $rules->add($rules->existsIn(['product_id'], 'Products'), ['errorField' => 'product_id']);

        return $rules;
    }
}
