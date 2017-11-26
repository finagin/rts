<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeOfCity($query, $city)
    {
        return $query->whereHas('cities', function ($query) use ($city) {
            $query->where('id', $city);
        });
    }

    public function scopeOfArea($query, $area)
    {
        return $query->whereHas('area', function ($query) use ($area) {
            $query->where('id', $area);
        });
    }

    /**
     * The skills that belong to the user.
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function hasSkill($skill_id)
    {
        return $this->skills->pluck('id')->search($skill_id) !== false;
    }

    /**
     * The cities that belong to the user.
     */
    public function cities()
    {
        return $this->belongsToMany(City::class);
    }

    public function hasCity($city_id)
    {
        return $this->cities->pluck('id')->search($city_id) !== false;
    }

    /**
     * Get the area that owns the user.
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
