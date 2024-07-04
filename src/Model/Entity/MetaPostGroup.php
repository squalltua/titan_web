<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MetaPostGroup Entity
 *
 * @property int $id
 * @property int $post_group_id
 * @property string $meta_key
 * @property string|null $meta_value
 *
 * @property \App\Model\Entity\PostGroup $post_group
 */
class MetaPostGroup extends Entity
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
        'post_group_id' => true,
        'meta_key' => true,
        'meta_value' => true,
        'post_group' => true,
    ];
}
