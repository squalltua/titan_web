<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PostGroup Entity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $type
 *
 * @property \App\Model\Entity\MetaPostGroup[] $meta_post_groups
 * @property \App\Model\Entity\Post[] $posts
 */
class PostGroup extends Entity
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
        'meta_post_groups' => true,
        'posts' => true,
    ];
}
