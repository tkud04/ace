<?php

namespace App\Jobs;

use App\Helpers\Contracts\HelperContract; 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $helpers; //Helpers implementation

    /**
     * Create a new job instance.
     *
     * @return void
     */
        
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;                      
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
