<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * カテゴリーに紐づく記事を取得
     */
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
