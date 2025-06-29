<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            [
                'name'    => 'Ibu Rina Marlina',
                'nip'     => '198001012005042001',
                'subject' => 'Matematika',
                'phone'   => '081234567890',
                'email'   => 'rina.marlina@example.com',
            ],
            [
                'name'    => 'Bapak Dedi Suhendar',
                'nip'     => '197512102006011003',
                'subject' => 'Fisika',
                'phone'   => '082345678901',
                'email'   => 'dedi.suhendar@example.com',
            ],
            [
                'name'    => 'Ibu Lilis Suryani',
                'nip'     => '198304152007022005',
                'subject' => 'Bahasa Indonesia',
                'phone'   => '083456789012',
                'email'   => 'lilis.suryani@example.com',
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}
