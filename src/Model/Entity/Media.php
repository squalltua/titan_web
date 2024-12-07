<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Media Entity
 *
 * @property int $id
 * @property string|null $filename
 * @property string|null $path
 * @property int|null $size
 * @property string|null $mime
 * @property string|null $hash
 * @property string|null $using_type
 * @property string|null $title
 * @property string|null $description
 * @property string|null $alt
 * @property int|null $order_index
 * @property string|null $link_url
 * @property string|null $uuid
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Product[] $products
 * @property \App\Model\Entity\Variant[] $variants
 */
class Media extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'filename' => true,
        'path' => true,
        'size' => true,
        'mime' => true,
        'hash' => true,
        'using_type' => true,
        'title' => true,
        'description' => true,
        'alt' => true,
        'order_index' => true,
        'link_url' => true,
        'uuid' => true,
        'created' => true,
        'modified' => true,
        'products' => true,
        'variants' => true,
    ];
}
