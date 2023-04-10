<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are NOT mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
    ];

    /**
     * The products where the image belongs to.
     */
    public function products()
    {
       return $this->belongsToMany(Product::class, 'product_has_images');
    }

    /**
     * The variations where the image belongs to.
     */
    public function variations()
    {
       return $this->belongsToMany(Variation::class, 'variation_has_images');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];
}
