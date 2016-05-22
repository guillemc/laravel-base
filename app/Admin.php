<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    /**
     * Default values used for new models
     *
     * @var array
     */
    protected $attributes = [
        'name' => '',
        'email' => '',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['created_at', 'updated_at', 'last_login'];

    public static function getOptions($attribute) {
        switch ($attribute) {
            case 'role':
                return [
                    'admin' => 'admin',
                    'editor' => 'editor',
                ];
        }
        return [];
    }

    public function getOptionValue($attribute) {
        $a = static::getOptions($attribute);
        return isset($a[$this->$attribute]) ? $a[$this->$attribute] : $this->$attribute;
    }
}
