<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HelloCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hello:class {name=DEFAULT} {--option}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'サンプルコマンド（クラス）';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
    	$name = $this->argument('name');
    	$option = $this->option('option');
    	
    	$option_view = 'false';
    	if( $option === true ) {
    		$option_view = 'true';
    	}
        return $this->comment('Hello ' . $name . ' ' . $option_view);
    }
}
