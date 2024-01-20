<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $uuid
 * @property int $country_id
 * @property Country $country
 * @property int $status_id
 * @property Status $status
 * @property int $package_id
 * @property Package $package
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $passport
 * @property string $face
 * @property string $national_id
 * @property string $national_id2
 * @property string $gateway
 * @property string $invoiceReference
 * @property string $invoiceId
 * @property boolean $paid
 * @property float $price
 * @property Carbon $paid_at
 * @property Carbon $deleted_at
 * @property Carbon $updated_at
 * @property Carbon $created_at
 */
class Application extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'country_id',
        'status_id',
        'package_id',
        'name',
        'phone',
        'email',
        'passport',
        'face',
        'national_id',
        'national_id2',
        'gateway',
        'invoiceReference',
        'invoiceId',
        'paid',
        'price',
        'paid_at',
    ];

    protected $casts = [
        'paid' => 'boolean',
        'paid_at' => 'datetime',
        'price' => 'float',
        'package_id' => 'int',
        'status_id' => 'int',
        'country_id' => 'int',
    ];

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function country(){
        return $this->belongsTo(Country::class)->withTrashed();
    }

    public function package(){
        return $this->belongsTo(Package::class)->withTrashed();
    }
}
