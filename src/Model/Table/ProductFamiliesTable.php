<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductFamilies Model
 *
 * @property \App\Model\Table\MetaProductFamiliesTable&\Cake\ORM\Association\HasMany $MetaProductFamilies
 *
 * @method \App\Model\Entity\ProductFamily newEmptyEntity()
 * @method \App\Model\Entity\ProductFamily newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductFamily> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductFamily get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ProductFamily findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ProductFamily patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductFamily> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductFamily|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ProductFamily saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ProductFamily>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductFamily>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductFamily>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductFamily> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductFamily>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductFamily>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductFamily>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductFamily> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProductFamiliesTable extends Table
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

        $this->setTable('product_families');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('MetaProductFamilies', [
            'foreignKey' => 'product_family_id',
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
            ->allowEmptyString('name');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 150)
            ->allowEmptyString('slug');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        return $validator;
    }
}
