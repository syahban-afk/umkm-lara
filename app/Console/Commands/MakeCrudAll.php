<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeCrudAll extends Command
{
    protected $signature = 'make:crud-all';
    protected $description = 'Generate model, migration, and resource controller for all UMKM tables';

    protected $tables = [
        'ProductCategory',
        'DiscountCategory',
        'Product',
        'Discount',
        'Customer',
        'Order',
        'OrderDetail',
        'Payment',
        'Delivery',
        'ProductReview',
        'Wishlist',
    ];

    public function handle()
    {
        foreach ($this->tables as $name) {
            $model = Str::studly($name);
            $controller = $model . 'Controller';

            // 1. Make model + migration
            $this->call('make:model', [
                'name' => $model,
                '--migration' => true,
            ]);

            // 2. Make controller resource
            $this->call('make:controller', [
                'name' => $controller,
                '--resource' => true,
            ]);

            $this->info("✅ $model created with migration and controller.");
        }

        $this->info("🎉 Selesai membuat semua struktur CRUD.");
    }
}
