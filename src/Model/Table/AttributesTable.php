<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Attributes Model
 *
 * @property \App\Model\Table\AttributeOptionsTable&\Cake\ORM\Association\HasMany $AttributeOptions
 *
 * @method \App\Model\Entity\Attribute newEmptyEntity()
 * @method \App\Model\Entity\Attribute newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Attribute> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Attribute get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Attribute findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Attribute patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Attribute> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Attribute|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Attribute saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Attribute>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attribute>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Attribute>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attribute> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Attribute>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attribute>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Attribute>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attribute> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AttributesTable extends Table
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

        $this->setTable('attributes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('AttributeOptions', [
            'foreignKey' => 'attribute_id',
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
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }

    public function getOptionsList()
    {
        return $this->find('list');
    }

    public function getAllAtributes(array $conditions = []): SelectQuery
    {
        return $this->find()->where($conditions);
    }
}
