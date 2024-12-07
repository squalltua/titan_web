<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VariantsMedias Model
 *
 * @property \App\Model\Table\VariantsTable&\Cake\ORM\Association\BelongsTo $Variants
 * @property \App\Model\Table\MediasTable&\Cake\ORM\Association\BelongsTo $Medias
 *
 * @method \App\Model\Entity\VariantsMedia newEmptyEntity()
 * @method \App\Model\Entity\VariantsMedia newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\VariantsMedia> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VariantsMedia get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\VariantsMedia findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\VariantsMedia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\VariantsMedia> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\VariantsMedia|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\VariantsMedia saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\VariantsMedia>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VariantsMedia>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VariantsMedia>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VariantsMedia> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VariantsMedia>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VariantsMedia>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VariantsMedia>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VariantsMedia> deleteManyOrFail(iterable $entities, array $options = [])
 */
class VariantsMediasTable extends Table
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

        $this->setTable('variants_medias');
        $this->setDisplayField(['variant_id', 'media_id']);
        $this->setPrimaryKey(['variant_id', 'media_id']);

        $this->belongsTo('Variants', [
            'foreignKey' => 'variant_id',
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
        $rules->add($rules->existsIn(['variant_id'], 'Variants'), ['errorField' => 'variant_id']);
        $rules->add($rules->existsIn(['media_id'], 'Medias'), ['errorField' => 'media_id']);

        return $rules;
    }
}
