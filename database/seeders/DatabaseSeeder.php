<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Midwife;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles & Permissions (Reset cached first)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $this->call(RoleSeeder::class);

        // 2. Master Data
        $this->call(MasterDataSeeder::class);

        // 3. Admin
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@clinic.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // 4. Midwives (3 Users)
        $midwives = [
            [
                'name' => 'Bidan Siti',
                'email' => 'siti@clinic.com',
                'sip' => 'SIP-001',
                'photo' => 'https://images.unsplash.com/photo-1559839734-2b71ea86b48e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'name' => 'Bidan Dewi',
                'email' => 'dewi@clinic.com',
                'sip' => 'SIP-002',
                'photo' => 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'name' => 'Bidan Rina',
                'email' => 'rina@clinic.com',
                'sip' => 'SIP-003',
                'photo' => 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
            ],
        ];

        foreach ($midwives as $m) {
            $u = User::create([
                'name' => $m['name'],
                'email' => $m['email'],
                'password' => Hash::make('password'),
            ]);
            $u->assignRole('bidan');

            $midwife = Midwife::create([
                'user_id' => $u->id,
                'sip_number' => $m['sip'],
                'bio' => 'Bidan Profesional yang berpengalaman dalam kesehatan ibu dan anak.',
                'photo_path' => $m['photo'],
            ]);

            // Create Schedules for this Midwife (Mocking Shifts)
            // Bidan Siti -> Pagi (all week)
            // Bidan Dewi -> Siang (all week)
            // Bidan Rina -> Malam (all week)
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            $shift = '';

            if ($m['name'] == 'Bidan Siti') {
                $start = '07:00:00';
                $end = '15:00:00';
            } elseif ($m['name'] == 'Bidan Dewi') {
                $start = '15:00:00';
                $end = '22:00:00';
            } else {
                $start = '22:00:00';
                $end = '07:00:00';
            }

            foreach ($days as $day) {
                \App\Models\PracticeSchedule::create([
                    'midwife_id' => $midwife->id,
                    'day' => $day,
                    'start_time' => $start,
                    'end_time' => $end,
                ]);
            }
        }

        // 5. Patients (7 Users)
        Patient::factory()->count(7)->create()->each(function ($patient) {
            // Optional: Create a User account for them
            $u = User::create([
                'name' => $patient->name,
                'email' => strtolower(str_replace(' ', '', $patient->name)) . '@clinic.com',
                'password' => Hash::make('password'),
            ]);
            $u->assignRole('patient');

            $patient->user_id = $u->id;
            $patient->save();
        });

        // 6. Clinical Data (Transactions, Visits, etc.)
        $this->call(ClinicalSeeder::class);
    }
}
