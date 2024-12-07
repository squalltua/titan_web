<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerNote Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property int|null $parent_id
 * @property string $title
 * @property string|null $content
 * @property string|null $type
 * @property int|null $is_private
 * @property string|null $status
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\CustomerNote $parent_customer_note
 * @property \App\Model\Entity\CustomerNote[] $child_customer_notes
 */
class CustomerNote extends Entity
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
        'parent_id' => true,
        'title' => true,
        'content' => true,
        'type' => true,
        'is_private' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'parent_customer_note' => true,
        'child_customer_notes' => true,
    ];
}
