<?php

namespace TsWink\Commands;

use Illuminate\Console\Command;
use TsWink\Classes\TswinkGenerator;

class TswinkGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tswink:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate typescript classes from Laravel models.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        (new TswinkGenerator)->generate();

        $this->info("Typescript classes has been generated.");
    }
}
