<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseOrder Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property string $title
 * @property string|null $content
 * @property string $amount_total
 * @property string $amount_tax
 * @property string $amount_discount
 * @property string $amount_net
 * @property int|null $create_uid
 * @property int|null $modified_uid
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Customer $customer
 */
class PurchaseOrder extends Entity
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
        'customer_id' => true,
        'title' => true,
        'content' => true,
        'amount_total' => true,
        'amount_tax' => true,
        'amount_discount' => true,
        'amount_net' => true,
        'create_uid' => true,
        'modified_uid' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
    ];
}
