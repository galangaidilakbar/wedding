<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRecommendations
{
    // get product recommendations
    public function get(): Collection
    {
        return Product::all()->random(3);
    }

}
