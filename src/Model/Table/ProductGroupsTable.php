<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductGroups Model
 *
 * @property \App\Model\Table\ProductGroupsTable&\Cake\ORM\Association\BelongsTo $ParentProductGroups
 * @property \App\Model\Table\ProductGroupsTable&\Cake\ORM\Association\HasMany $ChildProductGroups
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsToMany $Products
 *
 * @method \App\Model\Entity\ProductGroup newEmptyEntity()
 * @method \App\Model\Entity\ProductGroup newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductGroup> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductGroup get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ProductGroup findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ProductGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductGroup> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductGroup|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ProductGroup saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ProductGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductGroup>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductGroup> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductGroup>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductGroup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductGroup> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProductGroupsTable extends Table
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

        $this->setTable('product_groups');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ParentProductGroups', [
            'className' => 'ProductGroups',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildProductGroups', [
            'className' => 'ProductGroups',
            'foreignKey' => 'parent_id',
        ]);
        $this->belongsToMany('Products', [
            'foreignKey' => 'product_group_id',
            'targetForeignKey' => 'product_id',
            'joinTable' => 'products_product_groups',
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
            ->integer('parent_id')
            ->allowEmptyString('parent_id');

        $validator
            ->scalar('type')
            ->maxLength('type', 20)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 100)
            ->allowEmptyString('slug');

        $validator
            ->scalar('content')
            ->allowEmptyString('content');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentProductGroups'), ['errorField' => 'parent_id']);

        return $rules;
    }

    public function getCategoriesList()
    {
        return $this->find()->where(['type' => 'categories']);
    }
}
