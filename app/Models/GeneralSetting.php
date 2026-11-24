<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'layout',
        'contact_email',
        'contact_phone',
        'contact_address',
        'map',
        'currency_name',
        'time_zone',
        'currency_icon',
        'theme_color',
        'header_bg_color',
        'header_text_color',
        'footer_bg_color',
        'footer_text_color',
        'footer_bottom_color',
        'button_color',
        'button_text_color',
        'button_hover_color',
    ];
}
