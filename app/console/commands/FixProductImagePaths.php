<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class FixProductImagePaths extends Command
{
    protected $signature = 'products:fix-image-paths';
    protected $description = 'Fix product image paths that have incorrect format';

    public function handle()
    {
        $products = Product::whereNotNull('image')->get();
        $fixed = 0;

        foreach ($products as $product) {
            $oldPath = $product->image;
            
            // Fix paths that start with "public/"
            if (strpos($oldPath, 'public/') === 0) {
                $newPath = str_replace('public/', '', $oldPath);
                $product->update(['image' => $newPath]);
                $this->info("Fixed: $oldPath → $newPath");
                $fixed++;
            }
        }

        $this->info("Fixed $fixed product image paths!");
    }
}
