<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title_en
 * @property string $title_fa
 * @property string $title
 * @property boolean $is_active
 * @property float $price
 * @property string $background_image
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Package extends Model
{
    use HasLocalization , SoftDeletes;
    protected $fillable = [
        'is_active',
        'price',
        'background_image',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'float',
    ];

    public $hastTranslate = [
        'title'
    ];

}
