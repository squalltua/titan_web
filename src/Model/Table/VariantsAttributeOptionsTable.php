<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VariantsAttributeOptions Model
 *
 * @property \App\Model\Table\VariantsTable&\Cake\ORM\Association\BelongsTo $Variants
 * @property \App\Model\Table\AttributeOptionsTable&\Cake\ORM\Association\BelongsTo $AttributeOptions
 *
 * @method \App\Model\Entity\VariantsAttributeOption newEmptyEntity()
 * @method \App\Model\Entity\VariantsAttributeOption newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\VariantsAttributeOption> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VariantsAttributeOption get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\VariantsAttributeOption findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\VariantsAttributeOption patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\VariantsAttributeOption> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\VariantsAttributeOption|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\VariantsAttributeOption saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\VariantsAttributeOption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VariantsAttributeOption>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VariantsAttributeOption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VariantsAttributeOption> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VariantsAttributeOption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VariantsAttributeOption>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VariantsAttributeOption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VariantsAttributeOption> deleteManyOrFail(iterable $entities, array $options = [])
 */
class VariantsAttributeOptionsTable extends Table
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

        $this->setTable('variants_attribute_options');
        $this->setDisplayField(['variant_id', 'attribute_option_id']);
        $this->setPrimaryKey(['variant_id', 'attribute_option_id']);

        $this->belongsTo('Variants', [
            'foreignKey' => 'variant_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('AttributeOptions', [
            'foreignKey' => 'attribute_option_id',
            'joinType' => 'INNER',
        ]);
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
        $rules->add($rules->existsIn(['variant_id'], 'Variants'), ['errorField' => 'variant_id']);
        $rules->add($rules->existsIn(['attribute_option_id'], 'AttributeOptions'), ['errorField' => 'attribute_option_id']);

        return $rules;
    }
}
