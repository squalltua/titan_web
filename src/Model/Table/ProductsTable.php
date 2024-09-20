<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \App\Model\Table\MetaProductsTable&\Cake\ORM\Association\HasMany $MetaProducts
 * @property \App\Model\Table\ProductReviewsTable&\Cake\ORM\Association\HasMany $ProductReviews
 *
 * @method \App\Model\Entity\Product newEmptyEntity()
 * @method \App\Model\Entity\Product newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Product> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Product findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Product> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductsTable extends Table
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

        $this->setTable('products');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Adminusers', [
            'foreignKey' => 'adminuser_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ProductFamilies', [
            'foreignKey' => 'product_families_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Inventories', [
            'foreignKey' => 'product_id',
        ]);
        $this->hasMany('MetaProducts', [
            'foreignKey' => 'product_id',
        ]);
        $this->hasMany('ProductReviews', [
            'foreignKey' => 'product_id',
        ]);
        $this->belongsToMany('Attributes', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'attribute_id',
            'joinTable' => 'products_attributes',
        ]);
        $this->belongsToMany('Taxonomies', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'taxonomy_id',
            'joinTable' => 'products_taxonomies',
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
            ->maxLength('title', 200)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

        $validator
            ->scalar('summary')
            ->allowEmptyString('summary');

        $validator
            ->scalar('content')
            ->allowEmptyString('content');

        $validator
            ->decimal('base_price')
            ->allowEmptyString('base_price');

        $validator
            ->decimal('sell_price')
            ->allowEmptyString('sell_price');

        $validator
            ->decimal('discount_price')
            ->allowEmptyString('discount_price');

        $validator
            ->scalar('sku')
            ->maxLength('sku', 100)
            ->allowEmptyString('sku');

        $validator
            ->scalar('model_name')
            ->maxLength('model_name', 45)
            ->allowEmptyString('model_name');

        $validator
            ->scalar('series_number')
            ->maxLength('series_number', 45)
            ->allowEmptyString('series_number');

        $validator
            ->allowEmptyString('on_sale');

        $validator
            ->scalar('status')
            ->allowEmptyString('status');

        $validator
            ->dateTime('start_at')
            ->allowEmptyDateTime('start_at');

        $validator
            ->dateTime('end_at')
            ->allowEmptyDateTime('end_at');

        $validator
            ->integer('adminuser_id')
            ->notEmptyString('adminuser_id');

        $validator
            ->integer('product_families_id')
            ->notEmptyString('product_families_id');

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
        $rules->add($rules->existsIn(['product_families_id'], 'ProductFamilies'), ['errorField' => 'product_families_id']);

        return $rules;
    }
}
