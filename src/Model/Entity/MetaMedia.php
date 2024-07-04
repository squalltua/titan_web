<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MetaMedia Entity
 *
 * @property int $id
 * @property int $media_id
 * @property string $meta_key
 * @property string $meta_value
 *
 * @property \App\Model\Entity\Media $media
 */
class MetaMedia extends Entity
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
        'media_id' => true,
        'meta_key' => true,
        'meta_value' => true,
        'media' => true,
    ];
}
