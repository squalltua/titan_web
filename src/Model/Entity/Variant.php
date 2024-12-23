<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Variant Entity
 *
 * @property int $id
 * @property int $product_id
 * @property string $title
 * @property string $slug
 * @property string $sku
 * @property string $supplier_price
 * @property string $sell_price
 * @property string|null $discount_price
 * @property int|null $stock_quantity
 * @property string $status
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\AttributeOption[] $attribute_options
 * @property \App\Model\Entity\Media[] $medias
 */
class Variant extends Entity
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
        'product_id' => true,
        'title' => true,
        'slug' => true,
        'sku' => true,
        'supplier_price' => true,
        'sell_price' => true,
        'discount_price' => true,
        'stock_quantity' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'product' => true,
        'attribute_options' => true,
        'medias' => true,
    ];
}
