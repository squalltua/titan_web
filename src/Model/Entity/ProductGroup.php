<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductGroup Entity
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $type
 * @property string $title
 * @property string|null $slug
 * @property string|null $content
 *
 * @property \App\Model\Entity\ParentProductGroup $parent_product_group
 * @property \App\Model\Entity\ChildProductGroup[] $child_product_groups
 * @property \App\Model\Entity\Product[] $products
 */
class ProductGroup extends Entity
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
        'parent_id' => true,
        'type' => true,
        'title' => true,
        'slug' => true,
        'content' => true,
        'parent_product_group' => true,
        'child_product_groups' => true,
        'products' => true,
    ];
}
