<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The artisans that belong to the city.
     */
    public function artisans()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the area that owns the city.
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
