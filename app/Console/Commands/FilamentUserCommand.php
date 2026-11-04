<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class FilamentUserCommand extends Command
{
    protected $signature = 'make:filament-user
        {name : The user\'s display name}
        {email : The user\'s email address}
        {--password=password : The user\'s password}';

    protected $description = 'Create a new Filament user';

    public function handle(): int
    {
        $password = bcrypt($this->option('password'));

        $user = User::create([
            'name' => $this->argument('name'),
            'email' => $this->argument('email'),
            'password' => $password,
        ]);

        $this->components->success("Created Filament user [{$user->id}] {$user->name} <{$user->email}>");

        return Command::SUCCESS;
    }
}
