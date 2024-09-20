<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductFamily Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $slug
 * @property string|null $description
 *
 * @property \App\Model\Entity\MetaProductFamily[] $meta_product_families
 */
class ProductFamily extends Entity
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
        'name' => true,
        'slug' => true,
        'description' => true,
        'meta_product_families' => true,
    ];
}
