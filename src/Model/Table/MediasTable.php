<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

/**
 * Medias Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsToMany $Products
 * @property \App\Model\Table\VariantsTable&\Cake\ORM\Association\BelongsToMany $Variants
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

        $this->belongsToMany('Products', [
            'foreignKey' => 'media_id',
            'targetForeignKey' => 'product_id',
            'joinTable' => 'products_medias',
        ]);
        $this->belongsToMany('Variants', [
            'foreignKey' => 'media_id',
            'targetForeignKey' => 'variant_id',
            'joinTable' => 'variants_medias',
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

    public function uploadImage(string $type, object $image): mixed
    {
        $fileName = Text::slug(strtolower(str_replace(['.jpg', '.png'], '', $image->getClientFilename())));
        $fileExtension = ['image/jpeg' => '.jpg', 'image/png' => '.png', 'image/webp' => '.webp'];
        $webroot = WWW_ROOT;
        $fullUrl = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]/api/v1/medias/images/{$fileName}";
        $uuid = Text::uuid();
        $path = "{$webroot}storage/{$uuid}{$fileExtension[$image->getClientMediaType()]}";

        $media = $this->newEntity([
            'filename' => "{$fileName}",
            'path' => $path,
            'size' => $image->getSize(),
            'mime' => $image->getClientMediaType(),
            'hash' => null,
            'using_type' => $type,
            'title' => $fileName,
            'description' => null,
            'alt' => $fileName,
            'order_index' => 0,
            'link_url' => $fullUrl,
            'uuid' => $uuid,
        ]);

        if ($this->save($media)) {
            $image->moveTo($path);
            return $media;
        }

        return false;
    }

    public function removeFileBySlug(string $slug): bool
    {
        return false;
    }

    public function removeFileById(string $slug): bool
    {
        return false;
    }
}
