<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MetaMedias Model
 *
 * @property \App\Model\Table\MediasTable&\Cake\ORM\Association\BelongsTo $Medias
 *
 * @method \App\Model\Entity\MetaMedia newEmptyEntity()
 * @method \App\Model\Entity\MetaMedia newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaMedia> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MetaMedia get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MetaMedia findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MetaMedia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaMedia> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MetaMedia|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MetaMedia saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MetaMedia>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaMedia>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaMedia>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaMedia> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaMedia>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaMedia>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaMedia>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaMedia> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MetaMediasTable extends Table
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

        $this->setTable('meta_medias');
        $this->setDisplayField('meta_key');
        $this->setPrimaryKey('id');

        $this->belongsTo('Medias', [
            'foreignKey' => 'media_id',
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
            ->integer('media_id')
            ->notEmptyString('media_id');

        $validator
            ->scalar('meta_key')
            ->maxLength('meta_key', 255)
            ->requirePresence('meta_key', 'create')
            ->notEmptyString('meta_key');

        $validator
            ->scalar('meta_value')
            ->requirePresence('meta_value', 'create')
            ->notEmptyString('meta_value');

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
        $rules->add($rules->existsIn(['media_id'], 'Medias'), ['errorField' => 'media_id']);

        return $rules;
    }
}
