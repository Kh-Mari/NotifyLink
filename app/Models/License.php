<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_key',
        'user',
        'expires',
        'device_id',
        'activated_at'
    ];

    protected $casts = [
        'expires' => 'date',
        'activated_at' => 'datetime'
    ];

    public static function generateLicenseKey()
    {
        return strtoupper(Str::uuid());
    }

    public function isExpired()
    {
        return $this->expires < now();
    }

    public function isActivated()
    {
        return !is_null($this->device_id);
    }
}