<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'logo_filename',
        'background_filename',
        'button_color',
        'button_style',
        'background_color',
        'text_color',
        'logo_shape',
        'logo_size',
        'background_style',
        'use_background_image',
        'visit_count',
        'container_background',
        'container_border_color',
        'container_border_width',
        'container_border_radius',
        'container_shadow',
        'container_blur',
        'container_opacity',
        'use_container_styling',
    ];

    protected $casts = [
        'use_background_image' => 'boolean',
        'container_shadow' => 'boolean',
        'container_blur' => 'boolean',
        'use_container_styling' => 'boolean',
        'visit_count' => 'integer',
        'container_border_width' => 'integer',
        'container_border_radius' => 'integer',
        'container_opacity' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buttons()
    {
        return $this->hasMany(Button::class)->orderBy('order');
    }

    public function activeButtons()
    {
        return $this->hasMany(Button::class)->where('is_active', true)->orderBy('order');
    }

    public function incrementVisitCount()
    {
        $this->increment('visit_count');
    }

    public function getTotalClicksAttribute()
    {
        return $this->buttons->sum('click_count');
    }
}