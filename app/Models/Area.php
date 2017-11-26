<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Area extends Model
{
    use NodeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'area_id',
    ];

    /**
     * Get the cities for the area.
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * Get the cities for the area.
     */
    public function managers()
    {
        return $this->hasMany(User::class);
    }
}
