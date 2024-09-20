<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MetaProductFamilies Model
 *
 * @property \App\Model\Table\ProductFamiliesTable&\Cake\ORM\Association\BelongsTo $ProductFamilies
 *
 * @method \App\Model\Entity\MetaProductFamily newEmptyEntity()
 * @method \App\Model\Entity\MetaProductFamily newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaProductFamily> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MetaProductFamily get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MetaProductFamily findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MetaProductFamily patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaProductFamily> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MetaProductFamily|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MetaProductFamily saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MetaProductFamily>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaProductFamily>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaProductFamily>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaProductFamily> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaProductFamily>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaProductFamily>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaProductFamily>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaProductFamily> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MetaProductFamiliesTable extends Table
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

        $this->setTable('meta_product_families');
        $this->setDisplayField('meta_key');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProductFamilies', [
            'foreignKey' => 'product_family_id',
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
            ->integer('product_family_id')
            ->notEmptyString('product_family_id');

        $validator
            ->scalar('meta_key')
            ->maxLength('meta_key', 200)
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
        $rules->add($rules->existsIn(['product_family_id'], 'ProductFamilies'), ['errorField' => 'product_family_id']);

        return $rules;
    }
}
