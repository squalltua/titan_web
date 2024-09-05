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
 * @property string|null $summary
 * @property string|null $content
 * @property string|null $status
 * @property string|null $price_base
 * @property string|null $price_sell
 * @property string|null $price_discount
 * @property string|null $sku
 * @property int|null $quantity
 * @property string|null $type
 * @property int|null $in_shop
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property \Cake\I18n\DateTime|null $start_at
 * @property \Cake\I18n\DateTime|null $end_at
 * @property int $user_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\MetaProduct[] $meta_products
 * @property \App\Model\Entity\ProductReview[] $product_reviews
 * @property \App\Model\Entity\ProductGroup[] $product_groups
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
        'status' => true,
        'price_base' => true,
        'price_sell' => true,
        'price_discount' => true,
        'sku' => true,
        'quantity' => true,
        'type' => true,
        'in_shop' => true,
        'created' => true,
        'modified' => true,
        'start_at' => true,
        'end_at' => true,
        'user_id' => true,
        'user' => true,
        'meta_products' => true,
        'product_reviews' => true,
        'product_groups' => true,
    ];
}
