<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasLocalization;

    protected $fillable = [
        'color',
    ];

    public $hastTranslate = [
        'title',
        'email',
        'sms',
    ];

}
