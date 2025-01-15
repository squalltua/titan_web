<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MetaProducts Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\MetaProduct newEmptyEntity()
 * @method \App\Model\Entity\MetaProduct newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaProduct> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MetaProduct get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MetaProduct findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MetaProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaProduct> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MetaProduct|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MetaProduct saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MetaProduct>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaProduct>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaProduct>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaProduct> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaProduct>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaProduct>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaProduct>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaProduct> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MetaProductsTable extends Table
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

        $this->setTable('meta_products');
        $this->setDisplayField('meta_key');
        $this->setPrimaryKey('id');

        $this->addBehavior('Translate', [
            'strategyClass' => \Cake\ORM\Behavior\Translate\EavStrategy::class,
            'fields' => [
                'meta_key',
                'meta_value',
            ],
        ]);

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
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
            ->integer('product_id')
            ->notEmptyString('product_id');

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
        $rules->add($rules->existsIn(['product_id'], 'Products'), ['errorField' => 'product_id']);

        return $rules;
    }
}
