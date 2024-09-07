<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * Medias Model
 *
 * @property \App\Model\Table\MetaMediasTable&\Cake\ORM\Association\HasMany $MetaMedias
 *
 * @method \App\Model\Entity\Media newEmptyEntity()
 * @method \App\Model\Entity\Media newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Media> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Media get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Media findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Media patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Media> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Media|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Media saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Media>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Media>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Media>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Media> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Media>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Media>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Media>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Media> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MediasTable extends Table
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

        $this->setTable('medias');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('MetaMedias', [
            'foreignKey' => 'media_id',
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
            ->scalar('filename')
            ->allowEmptyString('filename');

        $validator
            ->scalar('path')
            ->allowEmptyString('path');

        $validator
            ->integer('size')
            ->allowEmptyString('size');

        $validator
            ->scalar('mime')
            ->maxLength('mime', 20)
            ->allowEmptyString('mime');

        $validator
            ->scalar('hash')
            ->maxLength('hash', 255)
            ->allowEmptyString('hash');

        $validator
            ->scalar('using_type')
            ->maxLength('using_type', 20)
            ->allowEmptyString('using_type');

        $validator
            ->scalar('title')
            ->maxLength('title', 100)
            ->allowEmptyString('title');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('alt')
            ->maxLength('alt', 100)
            ->allowEmptyString('alt');

        $validator
            ->integer('order_index')
            ->allowEmptyString('order_index');

        $validator
            ->scalar('link_url')
            ->allowEmptyString('link_url');

        $validator
            ->uuid('uuid')
            ->allowEmptyString('uuid');

        return $validator;
    }

    public function uploadImage(object $image): bool
    {
        $fileName = Text::slug(str_replace(['.jpg', '.png'], '', $image->getClientFilename));
        $fileExtension = ['image/jpeg' => '.jpg', 'image/png' => '.png'];
        $webroot = WWW_ROOT;

        $media = $this->newEntity([
            'filename' => "{$fileName}{$fileExtension[$image->getClientMediaType()]}",
            'path' => "{$webroot}storage/{$fileName}{$fileExtension[$image->getClientMediaType()]}",
            'size' => $image->getSize(),
            'mime' => $image->getClientMediaType(),
            'hash' => null,
            'using_type' => 'feature_image',
            'title' => $fileName,
            'description' => null,
            'alt' => $fileName,
            'order_index' => 0,
            'link_url' => 'https://',
            'uuid' => null,
        ]);

        return false;
    }

    public function removeImage(object $image): bool
    {
        return false;
    }
}
