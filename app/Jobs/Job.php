<?php

namespace App\Jobs;
 
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldBeUnique;
 

abstract class Job implements ShouldQueue, ShouldBeUnique
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $backoff   = 30;
    public $timeout   = 90;
    public $tries     = 3;
    public $uniqueFor = 90;

    public function __construct(protected mixed $data) {}

    public function handle() {}


}
 