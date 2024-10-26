<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Taxonomies Model
 *
 * @property \App\Model\Table\TaxonomiesTable&\Cake\ORM\Association\BelongsTo $ParentTaxonomies
 * @property \App\Model\Table\TaxonomiesTable&\Cake\ORM\Association\HasMany $ChildTaxonomies
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsToMany $Products
 *
 * @method \App\Model\Entity\Taxonomy newEmptyEntity()
 * @method \App\Model\Entity\Taxonomy newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Taxonomy> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Taxonomy get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Taxonomy findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Taxonomy patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Taxonomy> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Taxonomy|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Taxonomy saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Taxonomy>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Taxonomy>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Taxonomy>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Taxonomy> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Taxonomy>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Taxonomy>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Taxonomy>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Taxonomy> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class TaxonomiesTable extends Table
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

        $this->setTable('taxonomies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree', [
            'level' => 'level',
        ]);

        $this->belongsTo('ParentTaxonomies', [
            'className' => 'Taxonomies',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildTaxonomies', [
            'className' => 'Taxonomies',
            'foreignKey' => 'parent_id',
        ]);
        $this->belongsToMany('Products', [
            'foreignKey' => 'taxonomy_id',
            'targetForeignKey' => 'product_id',
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 150)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

        $validator
            ->scalar('type')
            ->maxLength('type', 45)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->integer('parent_id')
            ->allowEmptyString('parent_id');

        $validator
            ->integer('level')
            ->allowEmptyString('level');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentTaxonomies'), ['errorField' => 'parent_id']);

        return $rules;
    }

    /**
     * @return SelectQuery
     */
    public function getTypes(): SelectQuery
    {
        return $this->find('all')->where(['type' => 'types']);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function getType(string $id): mixed
    {
        return $this->find()->where(['id' => $id, 'type' => 'types'])->first();
    }

    /**
     * @return SelectQuery
     */
    public function getTypesList(): SelectQuery
    {
        return $this->find('list')->where(['type' => 'types']);
    }

    /**
     * @return SelectQuery
     */
    public function getCategories(): SelectQuery
    {
        return $this->find('all')->where(['type' => 'categories']);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function getCategory(string $id): mixed
    {
        return $this->find()->where(['id' => $id, 'type' => 'categories'])->first();
    }

    /**
     * @return SelectQuery
     */
    public function getCategoriesList(): SelectQuery
    {
        return $this->find('list')->where(['type' => 'categories']);
    }
}
