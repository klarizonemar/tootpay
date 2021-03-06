<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Setting extends Model
{
    use Eloquence;

    protected $searchableColumns = [
        'key',
    ];

    public $timestamps = false;

    protected $primaryKey = 'key';

    protected $fillable = [
        'key', 'value',
    ];

    public static function value($key) {
        return self::find($key)->value;
    }

    public static function json($index = null) {
        $path  = resource_path('assets/json/settings.json');
        $settings = collect(json_decode(file_get_contents($path), true));

        if (is_null($index)) {
            return $settings->all();
        }
        return $settings[$index]['id'];
    }
}
