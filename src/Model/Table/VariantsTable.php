<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Variants Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\AttributeOptionsTable&\Cake\ORM\Association\BelongsToMany $AttributeOptions
 * @property \App\Model\Table\MediasTable&\Cake\ORM\Association\BelongsToMany $Medias
 *
 * @method \App\Model\Entity\Variant newEmptyEntity()
 * @method \App\Model\Entity\Variant newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Variant> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Variant get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Variant findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Variant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Variant> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Variant|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Variant saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Variant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Variant>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Variant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Variant> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Variant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Variant>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Variant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Variant> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VariantsTable extends Table
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

        $this->setTable('variants');
        $this->setDisplayField('sku');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('AttributeOptions', [
            'foreignKey' => 'variant_id',
            'targetForeignKey' => 'attribute_option_id',
            'joinTable' => 'variants_attribute_options',
        ]);
        $this->belongsToMany('Medias', [
            'foreignKey' => 'variant_id',
            'targetForeignKey' => 'media_id',
            'joinTable' => 'variants_medias',
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
            ->scalar('sku')
            ->maxLength('sku', 100)
            ->requirePresence('sku', 'create')
            ->notEmptyString('sku');

        $validator
            ->decimal('price')
            ->allowEmptyString('price');

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
