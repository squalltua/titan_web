<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VariantsMedia Entity
 *
 * @property int $variant_id
 * @property int $media_id
 *
 * @property \App\Model\Entity\Variant $variant
 * @property \App\Model\Entity\Media $media
 */
class VariantsMedia extends Entity
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
        'variant' => true,
        'media' => true,
    ];
}
