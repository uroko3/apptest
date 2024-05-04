<?php

namespace App\Console\Commands;

use App\Services\SoyamaService;
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
    
    
    private $ss;
    
    public function __construct(SoyamaService $ss) {
    	parent::__construct();
    	
    	$this->ss = $ss;
    	
    	echo "call construct\n";
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
    	$this->comment($this->ss->getData(1)->name);
    	
    	$name = $this->argument('name');
    	$option = $this->option('option');
    	
    	$option_view = 'false';
    	if( $option === true ) {
    		$option_view = 'true';
    	}
        return $this->comment('Hello ' . $name . ' ' . $option_view);
    }
}
