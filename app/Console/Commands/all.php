<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class all extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:all {name : class name} {--a|all : create all controller} {--A|admin : create admin controller} {--B|user : create user controller} {--C|api : create api controller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model, controller, migration in 1 time';

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
        system("php artisan make:model ".$this->argument('name'));
        $this->info('Success Generate Model ... ');
        
        $this->createController();

        system("php artisan make:request " . $this->argument('name') . "Request");
        $this->info('Success Generate Request ... ');
        system("php artisan make:migration create_table_". strtolower($this->argument('name')). " --create=". strtolower($this->argument('name')). "s");
        $this->info('Success Generate Migration ... ');
        system("php artisan make:seeder ". $this->argument('name'). "Seeder");
        $this->info('Success Generate Seeder ... ');
        system("php artisan make:factory ". $this->argument('name'). "Factory --model=Models/". $this->argument('name'). "Model");
        $this->info('Success Generate Factory ... ');
    }

    public function createController(){
        $modelNamespace = "/App/Models/". $this->argument('name');
        $admin = 0;
        $user = 0;
        $api = 0;

        $arr = $this->options();
        if( $arr['all'] ) {
            $admin = true;
            $user = true;
            $api = true;
        } else{
            if( $arr['admin'] ){
                $admin = 1;
            }
            if ($arr['user']) {
                $user = 1;
            }
            if ($arr['api']) {
                $user_api = 1;
            }
        }


        if ($admin){
            system("php artisan make:controller Admin/". $this->argument('name'). "Controller --model=". $modelNamespace);
            $this->info('Success Generate Admin Controller ... ');
        }
        if ($user){
            system("php artisan make:controller User/". $this->argument('name')."Controller --model=". $modelNamespace);
            $this->info('Success Generate User Controller ... ');
        }
        if ($user_api){
            system("php artisan make:controller Api/". $this->argument('name'). "Controller --api --model=". $modelNamespace);
            $this->info('Success Generate Api User Controller ... ');
        }
    }
}
