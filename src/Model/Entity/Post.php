<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $intro
 * @property string $content
 * @property string|null $type
 * @property string $status
 * @property \Cake\I18n\DateTime|null $publish_date
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 * @property int $adminuser_id
 *
 * @property \App\Model\Entity\Adminuser $adminuser
 * @property \App\Model\Entity\MetaPost[] $meta_posts
 * @property \App\Model\Entity\Group[] $groups
 */
class Post extends Entity
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
        'intro' => true,
        'content' => true,
        'type' => true,
        'status' => true,
        'publish_date' => true,
        'created' => true,
        'modified' => true,
        'adminuser_id' => true,
        'adminuser' => true,
        'meta_posts' => true,
        'groups' => true,
    ];
}
