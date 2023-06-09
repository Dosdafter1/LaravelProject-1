<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user {name} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new application user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = new User();
        $user->name = $this->argument('name');
        $user->email = $this->argument('email');
        $this->line("Create new user: {$user->name} {$user->password}");
        $pswd = $this->secret('Password');
        $user->password = Hash::make($pswd);
        if($user->save()){
            $this->line('Created');
        }else{
            $this->error('User not created');
        }
    }
}
