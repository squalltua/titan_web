<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Languages Model
 *
 * @method \App\Model\Entity\Language newEmptyEntity()
 * @method \App\Model\Entity\Language newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Language> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Language get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Language findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Language patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Language> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Language|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Language saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Language>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Language>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Language>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Language> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Language>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Language>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Language>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Language> deleteManyOrFail(iterable $entities, array $options = [])
 */
class LanguagesTable extends Table
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

        $this->setTable('languages');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');
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
            ->scalar('title')
            ->maxLength('title', 45)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('unicode')
            ->maxLength('unicode', 5)
            ->requirePresence('unicode', 'create')
            ->notEmptyString('unicode');

        $validator
            ->allowEmptyString('is_default');

        return $validator;
    }

    public function getDefaultLanguageUnicode()
    {
        return $this->findByIsDefault(1)->first()->unicode;
    }

    public function getTabList()
    {
        return $this->find('list', keyField: 'unicode', valueField: 'title')->orderByDesc('is_default')->toArray();
    }

    public function initLanguagesData()
    {
        $data = [
            [
                'title' => 'English',
                'unicode' => 'en',
                'is_default' => 1,
            ], 
            [
                'title' => 'Thail',
                'unicode' => 'th',
                'is_default' => 0,
            ],
        ];

        $entities = $this->newEntities($data);

        return $this->saveMany($entities);
    }
}
