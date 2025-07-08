<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Button extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_id',
        'label',
        'url',
        'file_filename',
        'icon_class',
        'order',
        'click_count',
        'is_active',
        'is_promotion',
        'promotion_color',
        'discount_label',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_promotion' => 'boolean',
        'order' => 'integer',
        'click_count' => 'integer',
    ];

    public function link()
    {
        return $this->belongsTo(Link::class);
    }

    public function incrementClickCount()
    {
        $this->increment('click_count');
    }

    public function getRedirectUrlAttribute()
    {
        if ($this->url) {
            return $this->url;
        }
        
        if ($this->file_filename) {
            return asset('storage/uploads/' . $this->file_filename);
        }
        
        return null;
    }
}