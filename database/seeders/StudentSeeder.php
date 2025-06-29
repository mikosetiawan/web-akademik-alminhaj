<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            [
                'name'       => 'Ahmad Fauzi',
                'nis'        => '1234567890',
                'class'      => '10 IPA 1',
                'birth_date' => '2007-08-15',
                'address'    => 'Jl. Merdeka No. 10'
            ],
            [
                'name'       => 'Siti Rahma',
                'nis'        => '1234567891',
                'class'      => '10 IPA 2',
                'birth_date' => '2007-09-10',
                'address'    => 'Jl. Kenanga No. 22'
            ],
            [
                'name'       => 'Budi Santoso',
                'nis'        => '1234567892',
                'class'      => '11 IPS 1',
                'birth_date' => '2006-11-20',
                'address'    => 'Jl. Mawar No. 5'
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
