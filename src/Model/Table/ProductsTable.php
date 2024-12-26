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
 * @property \App\Model\Table\VariantsTable&\Cake\ORM\Association\HasMany $Variants
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsToMany $Categories
 * @property \App\Model\Table\MediasTable&\Cake\ORM\Association\BelongsToMany $Medias
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

        $this->hasMany('MetaProducts', [
            'foreignKey' => 'product_id',
        ]);
        $this->hasMany('ProductReviews', [
            'foreignKey' => 'product_id',
        ]);
        $this->hasMany('Variants', [
            'foreignKey' => 'product_id',
        ]);
        $this->belongsToMany('Categories', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'products_categories',
        ]);
        $this->belongsToMany('Medias', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'media_id',
            'joinTable' => 'products_medias',
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
            ->requirePresence('summary', 'create')
            ->notEmptyString('summary');

        $validator
            ->scalar('content')
            ->requirePresence('content', 'create')
            ->notEmptyString('content');

        $validator
            ->decimal('supplier_price')
            ->notEmptyString('supplier_price');

        $validator
            ->decimal('sell_price')
            ->notEmptyString('sell_price');

        $validator
            ->decimal('discount_price')
            ->notEmptyString('discount_price');

        $validator
            ->scalar('sku')
            ->maxLength('sku', 100)
            ->allowEmptyString('sku');

        $validator
            ->dateTime('start_at')
            ->allowEmptyDateTime('start_at');

        $validator
            ->dateTime('end_at')
            ->allowEmptyDateTime('end_at');

        $validator
            ->notEmptyString('has_variants');

        $validator
            ->notEmptyString('on_sell');

        $validator
            ->integer('stock_quantity')
            ->allowEmptyString('stock_quantity');

        $validator
            ->scalar('status')
            ->notEmptyString('status');

        return $validator;
    }

    public function getAllProducts()
    {
        $products = $this->find()->contain(['Categories']);

        return $products;
    }

    public function getInformation(string $id)
    {
        // $product = $this->get($id, ['contain' => ['Categories', 'Variants', 'Variants.AttributeOptions', 'Medias']]);
        $product = $this->find()
            ->where(['Products.id' => $id])
            ->contain(['Categories', 'Variants', 'Variants.AttributeOptions'])
            ->contain('Medias', function (SelectQuery $q) {
                return $q->where(['Medias.using_type' => 'feature_image'])  ;
            })
            ->first();

        $product->medias = $product->medias[0];

        return $product;
    }
}