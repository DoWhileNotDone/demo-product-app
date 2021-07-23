<?php

namespace App\Jobs;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected array $data
    )
    {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo("Queue running for product creation\n");

        $product = Product::create([
            'name' => $this->data[0],
            'barcode' => $this->data[1],
            'brand' => $this->data[2],
            'price' => $this->data[3],
            'image_url' => $this->data[4],
            'date_added' => Carbon::createFromFormat('d/m/Y H:i:s', $this->data[5]),
        ]);

        echo("Product created {$product->getKey()}\n");
    }
}
