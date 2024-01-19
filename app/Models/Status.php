<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title_en
 * @property string $title_fa
 * @property string $title
 * @property string $email_en
 * @property string $email_fa
 * @property string $email
 * @property string $sms_en
 * @property string $sms_fa
 * @property string $sms
 * @property string $badge
 * @property string $color
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Status extends Model
{
    use HasLocalization;

    protected $table = "status";

    protected $fillable = [
        'color',
    ];

    public $hastTranslate = [
        'title',
        'email',
        'sms',
    ];

    public $appends = [
        'badge',
    ];

    public function getBadgeAttribute(){
        return '<span style="color: '.$this->color.';" >'.$this->title.'</span>';
    }
}
