<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductReview Entity
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $content
 * @property int|null $rating
 * @property int|null $parent_id
 * @property int $product_id
 * @property string|null $status
 * @property \Cake\I18n\DateTime|null $created
 *
 * @property \App\Model\Entity\ParentProductReview $parent_product_review
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\ChildProductReview[] $child_product_reviews
 */
class ProductReview extends Entity
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
        'content' => true,
        'rating' => true,
        'parent_id' => true,
        'product_id' => true,
        'status' => true,
        'created' => true,
        'parent_product_review' => true,
        'product' => true,
        'child_product_reviews' => true,
    ];
}
