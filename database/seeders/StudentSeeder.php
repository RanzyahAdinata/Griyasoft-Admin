<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;


class StudentSeeder extends Seeder
{
    public function run()
    {
        
        Student::create([
            'name' => 'Ranzyah Adinata Aldo',
            'image' => 'public/image/aldo.jpg',
            'description' => 'A diligent student with excellent grades.',
        ]);

        Student::create([
            'name' => 'Syarif Hidayat',
            'image' => 'public/image/syarif.jpg',
            'description' => 'Active participant in extracurricular activities.',
        ]);

        Student::create([
            'name' => 'Adhipuspo',
            'image' => 'public/image/adhi.jpg',
            'description' => 'Active participant in extracurricular activities.',
        ]);

    
    }
}

