<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Sofa\Eloquence\Eloquence;

class User extends Authenticatable
{
    use Eloquence;

    protected $searchableColumns = [
        'id', 'name', 'email', 'phone_number',
    ];

    public $incrementing = false;

    protected $fillable = [
        'id', 'name', 'email', 'phone_number', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, 'user_role')->withTimestamps();
    }

    public function tootCards() {
        return $this->belongsToMany(TootCard::class, 'user_toot_card')->withTimestamps();
    }

    public function transactions() {
        return $this->belongsToMany(Transaction::class, 'user_toot_card_transaction')->withTimestamps();
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = ucwords(strtolower($value));
    }

    public function getGravatarAttribute() {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?d=identicon&s=120";
    }

    public function hasAnyRole($roles) {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role) {
        if ($this->roles()->find($role)) {
            return true;
        }
        return false;
    }

    public static function searchFor($keyword, $model = null) {
        if (!is_null($model)) {
            return $model->search(strtolower($keyword));
        }
        return self::search(strtolower($keyword));
    }

    public static function sort($sort, $model = null) {
        if (!is_null($model)) {
            if ($sort == str_slug(trans('sort.users')[0])) {
                return $model->orderBy('name', 'asc');
            }

            if ($sort == str_slug(trans('sort.users')[1])) {
                return $model->orderBy('updated_at', 'desc');
            }
        } else {
            if ($sort == str_slug(trans('sort.users')[0])) {
                return self::orderBy('name', 'asc');
            }

            if ($sort == str_slug(trans('sort.users')[1])) {
                return self::orderBy('updated_at', 'desc');
            }
        }
    }

    public static function adminJson($field = null) {
        $path  = resource_path('assets/json/users/admin.json');
        $admin = collect(json_decode(file_get_contents($path), true));

        if (is_null($field)) {
            return $admin->all();
        }
        return $admin[$field];
    }

    public static function testJson($field = null) {
        $path  = resource_path('assets/json/users/test.json');
        $test = collect(json_decode(file_get_contents($path), true));

        if (is_null($field)) {
            return $test->all();
        }
        return $test[$field];
    }

    public static function cashiersJson($index = null) {
        $path  = resource_path('assets/json/users/cashiers.json');
        $cashiers = collect(json_decode(file_get_contents($path), true));

        if (is_null($index)) {
            return $cashiers->all();
        }
        return $cashiers[$index];
    }

    public static function cardholdersJson($index = null) {
        $path  = resource_path('assets/json/users/cardholders.json');
        $cardholders = collect(json_decode(file_get_contents($path), true));

        if (is_null($index)) {
            return $cardholders->all();
        }
        return $cardholders[$index];
    }

    public static function guestJson($field = null) {
        $path  = resource_path('assets/json/users/guest.json');
        $guest = collect(json_decode(file_get_contents($path), true));

        if (is_null($field)) {
            return $guest->all();
        }
        return $guest[$field];
    }

    public static function admin() {
        return self::whereIn('id', collect(DB::table('user_role')->where('role_id', admin())->get())->pluck('user_id')->toArray());
    }

    public static function cardholder() {
        return self::whereIn('id', collect(DB::table('user_role')->where('role_id', cardholder())->get())->pluck('user_id')->toArray());
    }

    public static function cashier() {
        return self::whereIn('id', collect(DB::table('user_role')->where('role_id', cashier())->get())->pluck('user_id')->toArray());
    }

    public static function guest() {
        return self::whereIn('id', collect(DB::table('user_role')->where('role_id', guest())->get())->pluck('user_id')->toArray());
    }
}
