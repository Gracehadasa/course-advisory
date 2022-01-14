<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for creating an admin';

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
     * @return int
     */
    public function handle()
    {
        $id = $this->argument('id');
        $user = User::find($id);
        if(isset($user)) {
            $user->role = 1;
            if($user->save()) {
                $this->info("Admin was created successfully !!!");
                return 0;
            }
            $this->error('"Oops try again later"');
            return 0;
        }
         $this->error("User with id $id was not found");
        return 0;
    }
}
