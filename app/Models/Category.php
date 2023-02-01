<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    public function scopeWithDonationCount($query)
    {
        $subQuery = DB::table('donations as d')
            ->select('category_id', DB::raw('sum(d.quantity) as qtd'))
            ->where('status', 'a')
            ->groupBy('d.category_id');

        $query->leftJoinSub($subQuery, 'donations', function ($join) {
            $join->on('categories.id', '=', 'donations.category_id');
        });
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
