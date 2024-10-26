<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Taxonomy Entity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property int|null $parent_id
 * @property int|null $lft
 * @property int|null $rght
 * @property int|null $level
 * @property string|null $taxonomiescol
 *
 * @property \App\Model\Entity\Taxonomy $parent_taxonomy
 * @property \App\Model\Entity\Taxonomy[] $child_taxonomies
 * @property \App\Model\Entity\Product[] $products
 */
class Taxonomy extends Entity
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
        'type' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'level' => true,
        'taxonomiescol' => true,
        'parent_taxonomy' => true,
        'child_taxonomies' => true,
        'products' => true,
    ];
}
