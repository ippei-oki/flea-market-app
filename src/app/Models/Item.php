<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'price',
        'explanation',
        'image',
        'condition_id',
        'user_id'
    ];

    public function likes()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categorizations', 'item_id', 'category_id');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class, 'condition_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchasers()
    {
        return $this->belongsToMany(User::class, 'purchases');
    }

    public function purchase()
    {
        return $this->hasOne(Purchase::class, 'item_id');
    }

    public function isSold()
    {
        return $this->purchase()->exists();
    }
}