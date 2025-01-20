<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AttributeOptions Model
 *
 * @property \App\Model\Table\AttributesTable&\Cake\ORM\Association\BelongsTo $Attributes
 * @property \App\Model\Table\VariantsTable&\Cake\ORM\Association\BelongsToMany $Variants
 *
 * @method \App\Model\Entity\AttributeOption newEmptyEntity()
 * @method \App\Model\Entity\AttributeOption newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\AttributeOption> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AttributeOption get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\AttributeOption findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\AttributeOption patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\AttributeOption> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AttributeOption|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\AttributeOption saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\AttributeOption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AttributeOption>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AttributeOption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AttributeOption> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AttributeOption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AttributeOption>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AttributeOption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AttributeOption> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AttributeOptionsTable extends Table
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

        $this->setTable('attribute_options');
        $this->setDisplayField('value');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Translate', [
            'strategyClass' => \Cake\ORM\Behavior\Translate\EavStrategy::class,
            'fields' => ['value'],
            'defaultLocale' => 'en',
        ]);

        $this->belongsTo('Attributes', [
            'foreignKey' => 'attribute_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('Variants', [
            'foreignKey' => 'attribute_option_id',
            'targetForeignKey' => 'variant_id',
            'joinTable' => 'variants_attribute_options',
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
            ->integer('attribute_id')
            ->notEmptyString('attribute_id');

        $validator
            ->scalar('value')
            ->maxLength('value', 255)
            ->requirePresence('value', 'create')
            ->notEmptyString('value');

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
        $rules->add($rules->existsIn(['attribute_id'], 'Attributes'), ['errorField' => 'attribute_id']);

        return $rules;
    }

    public function getOptions(int $attributeId): SelectQuery
    {
        return $this->find('list')->where(['attribute_id' => $attributeId]);
    }
}
