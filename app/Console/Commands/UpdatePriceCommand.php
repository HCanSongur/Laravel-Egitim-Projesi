<?php

namespace App\Console\Commands;

use App\Models\Book;
use Illuminate\Console\Command;

class UpdatePriceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $products = Book::get();
        // foreach ($products as $product){
        //     $product->price *= 0.1;
        //     $product->save();

        // }
    }
}
