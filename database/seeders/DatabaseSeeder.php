<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /* Seeder for Web Owner */
        User::create([
            'nip' => '065119076',
            'name' => 'Feri Fadilah',
            'email' => 'feri.065119076@unpak.ac.id',
            'password' => Hash::make('@ferifadilah!'),
            'is_admin' => true
        ]);

        /* Seeder for Admin */
        User::create([
            'nip' => '12345678',
            'name' => 'Admin BPN',
            'email' => 'admin@bpg.go.id',
            'password' => Hash::make('@adminbpn!'),
            'is_admin' => true
        ]);

        /* Seeder for regular user / employee */
        User::create([
            'nip' => '87654321',
            'name' => 'Pegawai',
            'email' => 'employee@bpn.go.id',
            'password' => Hash::make('@employee!'),
        ]);
    }
}
