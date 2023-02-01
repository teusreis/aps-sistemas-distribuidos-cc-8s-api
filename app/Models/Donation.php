<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'donations';

    protected $fillable = [
        'is_monetary',
        'value',
        'quantity',
        'user_id',
        'status',
        'category_id'
    ];

    public function scopeWithCategoryName($query)
    {
        $query->addSelect([
            "category" => Category::select('name')
                ->whereColumn("donations.category_id", "id")
        ]);
    }

    public function scopeWithUserName($query)
    {
        $query->addSelect([
            'user_name' => User::select('name')
                ->whereColumn("donations.user_id", "id")
        ]);
    }

    public function doador()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
