<?php

namespace Database\Seeders;

use App\Models\Penumpang;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'nama_agen_travel' => null,
            'no_telepon' => null,
            'alamat' => null,
            'is_admin' => true,
        ]);
        User::create([
            'username' => 'LogosPKY',
            'password' => bcrypt('agent123'),
            'nama_agen_travel' => 'Logos Travel PKY',
            'no_telepon' => 1122334455,
            'alamat' => 'Jl.RTA.Milono',
            'is_admin' => false,
        ]);
        User::create([
            'username' => 'Travel1',
            'password' => bcrypt('agent123'),
            'nama_agen_travel' => 'Travel Tilung',
            'no_telepon' => 5544332211,
            'alamat' => 'jl.Menteg 2',
            'is_admin' => false,
        ]);
        User::create([
            'username' => 'travel2',
            'password' => bcrypt('agent123'),
            'nama_agen_travel' => 'Travel Tjilik Riwut',
            'no_telepon' => 12345678910,
            'alamat' => 'jl.Tjilik riwut Km.1',
            'is_admin' => false,
        ]);
        User::create([
            'username' => 'travel3',
            'password' => bcrypt('agent123'),
            'nama_agen_travel' => 'Tamiang Travel',
            'no_telepon' => 12345678911,
            'alamat' => 'jl.G.Obos 8',
            'is_admin' => false,
        ]);


        Penumpang::create([
            'username' => 'user1',
            'password' => bcrypt('customer123'),
            'nama' => 'User1',
            'alamat' => 'Palangka Raya',
            'jenis_kelamin' => 'laki-laki',
            'nik' => 21323454531,
            'no_telepon' => null,
        ]);
        Penumpang::create([
            'username' => 'user2',
            'password' => bcrypt('customer123'),
            'nama' => 'User2',
            'alamat' => 'Palangka Raya',
            'jenis_kelamin' => 'perempuan',
            'nik' => 21323454532,
            'no_telepon' => null,
        ]);
        Penumpang::create([
            'username' => 'user3',
            'password' => bcrypt('customer123'),
            'nama' => 'User3',
            'alamat' => 'Palangka Raya',
            'jenis_kelamin' => 'laki-laki',
            'nik' => 21323454533,
            'no_telepon' => null,
        ]);
        Penumpang::create([
            'username' => 'user4',
            'password' => bcrypt('customer123'),
            'nama' => 'User4',
            'alamat' => 'Palangka Raya',
            'jenis_kelamin' => 'perempuan',
            'nik' => 21323454534,
            'no_telepon' => null,
        ]);
        Penumpang::create([
            'username' => 'user5',
            'password' => bcrypt('customer123'),
            'nama' => 'User5',
            'alamat' => 'Palangka Raya',
            'jenis_kelamin' => 'laki-laki',
            'nik' => 21323454535,
            'no_telepon' => null,
        ]);
    }
}
