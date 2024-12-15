<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $summary
 * @property string $content
 * @property string $supplier_price
 * @property string $sell_price
 * @property string $discount_price
 * @property string|null $sku
 * @property \Cake\I18n\DateTime|null $start_at
 * @property \Cake\I18n\DateTime|null $end_at
 * @property int $on_sell
 * @property string $status
 * @property int $has_variants
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\MetaProduct[] $meta_products
 * @property \App\Model\Entity\ProductReview[] $product_reviews
 * @property \App\Model\Entity\Variant[] $variants
 * @property \App\Model\Entity\Category[] $categories
 * @property \App\Model\Entity\Media[] $medias
 */
class Product extends Entity
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
        'title' => true,
        'slug' => true,
        'summary' => true,
        'content' => true,
        'supplier_price' => true,
        'sell_price' => true,
        'discount_price' => true,
        'sku' => true,
        'start_at' => true,
        'end_at' => true,
        'on_sell' => true,
        'status' => true,
        'has_variants' => true,
        'created' => true,
        'modified' => true,
        'meta_products' => true,
        'product_reviews' => true,
        'variants' => true,
        'categories' => true,
        'medias' => true,
    ];
}
