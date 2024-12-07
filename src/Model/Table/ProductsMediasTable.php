<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductsMedias Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\MediasTable&\Cake\ORM\Association\BelongsTo $Medias
 *
 * @method \App\Model\Entity\ProductsMedia newEmptyEntity()
 * @method \App\Model\Entity\ProductsMedia newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductsMedia> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductsMedia get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ProductsMedia findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ProductsMedia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductsMedia> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductsMedia|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ProductsMedia saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ProductsMedia>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductsMedia>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductsMedia>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductsMedia> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductsMedia>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductsMedia>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductsMedia>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductsMedia> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProductsMediasTable extends Table
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

        $this->setTable('products_medias');
        $this->setDisplayField(['product_id', 'media_id']);
        $this->setPrimaryKey(['product_id', 'media_id']);

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Medias', [
            'foreignKey' => 'media_id',
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
        $rules->add($rules->existsIn(['product_id'], 'Products'), ['errorField' => 'product_id']);
        $rules->add($rules->existsIn(['media_id'], 'Medias'), ['errorField' => 'media_id']);

        return $rules;
    }
}
