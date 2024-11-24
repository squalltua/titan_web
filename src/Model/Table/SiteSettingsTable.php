<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\Database\Connection;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Hash;
use Cake\Validation\Validator;

/**
 * SiteSettings Model
 *
 * @method \App\Model\Entity\SiteSetting newEmptyEntity()
 * @method \App\Model\Entity\SiteSetting newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\SiteSetting> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SiteSetting get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\SiteSetting findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\SiteSetting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\SiteSetting> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SiteSetting|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\SiteSetting saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\SiteSetting>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SiteSetting>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SiteSetting>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SiteSetting> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SiteSetting>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SiteSetting>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SiteSetting>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SiteSetting> deleteManyOrFail(iterable $entities, array $options = [])
 */
class SiteSettingsTable extends Table
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

        $this->setTable('site_settings');
        $this->setDisplayField('key_field');
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
            ->scalar('key_field')
            ->maxLength('key_field', 255)
            ->requirePresence('key_field', 'create')
            ->notEmptyString('key_field');

        $validator
            ->scalar('value_field')
            ->allowEmptyString('value_field');

        return $validator;
    }

    /**
     * @return array
     */
    public function getSiteSetting(): array
    {
        $settingData = $this->find('all');
        return Hash::combine($settingData->toArray(), '{n}.key_field', '{n}.value_field');
    }

    /**
     * @param array $data
     * @return bool
     */
    public function saveSiteSetting(array $data): bool
    {
        $config = ConnectionManager::getConfig('default');
        $conn = new Connection($config);

        foreach ($data as $key => $value) {
            $setting = $this->find()->where(['key_field' => $key])->first();
            if ($setting) {
                // update data
                $setting->value_field = $value;
            } else {
                // new data
                $setting = $this->newEntity([
                    'key_field' => $key,
                    'value_field' => $value
                ]);
            }

            // save data
            if (!$this->save($setting)) {
                $conn->rollback();
                return false;
            }
        }

        $conn->commit();

        return true;
    }

    public function initSiteSettingData()
    {
        $settings = $this->newEntities([
            ['key_field' => 'site_name', 'value_field' => 'Site name'],
            ['key_field' => 'telephone', 'value_field' => " "],
            ['key_field' => 'address', 'value_field' => " "],
            ['key_field' => 'contact_email', 'value_field' => " "],
            ['key_field' => 'support_email', 'value_field' => " "],
            ['key_field' => 'sns_facebook_name', 'value_field' => " "],
            ['key_field' => 'sns_facebook_url', 'value_field' => " "],
            ['key_field' => 'sns_twitter_name', 'value_field' => " "],
            ['key_field' => 'sns_twitter_url', 'value_field' => " "],
            ['key_field' => 'sns_instagram_name', 'value_field' => " "],
            ['key_field' => 'sns_instagram_url', 'value_field' => " "],
            ['key_field' => 'sns_tiktok_name', 'value_field' => " "],
            ['key_field' => 'sns_tiktok_url', 'value_field' => " "],
        ]);

        if ($this->saveMany($settings)) {
            return true;
        }

        return false;
    }
}
