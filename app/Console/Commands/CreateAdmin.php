<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Admin;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inserts a user in the admins table';

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
        do {
            $email = $this->ask('Admin email');
            $exists = Admin::where('email', $email)->count() > 0;
            if ($exists) {
                $this->error('An administrator with this email already exists.');
            }
        } while ($exists);

        $name = $this->ask('Admin name');

        do {
            $password = $this->ask('Password');
        } while ('' == trim($password));

        $admin = new Admin();
        $admin->name = $name;
        $admin->email = $email;
        $admin->password = bcrypt($password);
        $admin->save();

        $this->info("Admin {$name} <{$email}> created");
    }
}
