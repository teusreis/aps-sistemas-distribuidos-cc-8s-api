<?php

namespace App\Services;

use App\Models\Donation;

class DonationService
{
    public function getDonationPaginate()
    {
        return Donation::query()
            ->withCategoryName()
            ->withUserName()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }


    public function getDonationByUserId(int $userId)
    {
        return Donation::query()
            ->where('user_id', auth()->id())
            ->withCategoryName()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
