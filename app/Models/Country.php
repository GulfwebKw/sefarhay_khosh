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
 * @property string $iso_code
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Country extends Model
{
    use HasLocalization , SoftDeletes;

    protected $fillable = [
        'is_active',
        'iso_code',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $appends = [
        'flag',
    ];

    public $hastTranslate = [
        'title'
    ];

    public function getFlagAttribute(){
        return asset('images/flags/'.strtolower($this->iso_code).'.svg');
    }
}
