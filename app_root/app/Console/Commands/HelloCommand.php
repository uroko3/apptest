<?php

namespace App\Console\Commands;

use App\Services\SoyamaService;
use Illuminate\Console\Command;
use Log;

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
    public function handle(SoyamaService $sss, SoyamaService $ssss)
    {
    	$i = 0;
    	while(($i++) < 2) {
    		log::info( "i = $i");
    		log::info('call HelloCommand');
    		$this->comment($sss->getData(1)->name);
    		$this->comment($ssss->getData(1)->name);
    		
    		$name = $this->argument('name');
    		$option = $this->option('option');
    		
    		$option_view = 'false';
    		if( $option === true ) {
    			$option_view = 'true';
    		}
    		
    		$this->comment('Hello ' . $name . ' ' . $option_view);
    		sleep(1);
    	}
    }
}
