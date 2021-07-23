<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessProductList implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected string $path
    )
    {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo("Task running for product list import\n");

        $file_handle = fopen($this->path, "r");

        $exclude_header = true;
        while (($data = fgetcsv($file_handle)) !== false) {
            if ($exclude_header === true) {
                $exclude_header = false;
                continue;
            }

            ProcessProduct::dispatch($data);
        }

        echo("Product list imported\n");
    }
}
