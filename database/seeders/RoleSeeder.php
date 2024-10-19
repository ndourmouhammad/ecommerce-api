<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            Role::create(['name' => 'Client']);
            Role::create(['name' => 'Admin']);
           
        }
    }
}
