<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PostComment Entity
 *
 * @property int $id
 * @property int $posts_id
 * @property int|null $parent_id
 * @property string|null $content
 * @property \Cake\I18n\DateTime|null $created
 * @property string|null $status
 * @property \Cake\I18n\DateTime|null $modified
 * @property int $clientuser_id
 *
 * @property \App\Model\Entity\Post $post
 * @property \App\Model\Entity\PostComment $parent_post_comment
 * @property \App\Model\Entity\Clientuser $clientuser
 * @property \App\Model\Entity\PostComment[] $child_post_comments
 */
class PostComment extends Entity
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
        'posts_id' => true,
        'parent_id' => true,
        'content' => true,
        'created' => true,
        'status' => true,
        'modified' => true,
        'clientuser_id' => true,
        'post' => true,
        'parent_post_comment' => true,
        'clientuser' => true,
        'child_post_comments' => true,
    ];
}
