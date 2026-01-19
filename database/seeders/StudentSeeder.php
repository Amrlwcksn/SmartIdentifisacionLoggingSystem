<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            // Anak dari Budi Santoso (parent_id: 1)
            [
                'nis' => '2024001',
                'name' => 'Andi Santoso',
                'class' => '10A',
                'uid' => 'A1B2C3D4',
                'parent_id' => 1,
            ],
            [
                'nis' => '2024002',
                'name' => 'Bima Santoso',
                'class' => '8B',
                'uid' => 'E5F6G7H8',
                'parent_id' => 1,
            ],
            
            // Anak dari Siti Nurhaliza (parent_id: 2)
            [
                'nis' => '2024003',
                'name' => 'Citra Nurhaliza',
                'class' => '11A',
                'uid' => 'I9J0K1L2',
                'parent_id' => 2,
            ],
            
            // Anak dari Ahmad Dahlan (parent_id: 3)
            [
                'nis' => '2024004',
                'name' => 'Dimas Dahlan',
                'class' => '9C',
                'uid' => 'M3N4O5P6',
                'parent_id' => 3,
            ],
            [
                'nis' => '2024005',
                'name' => 'Elsa Dahlan',
                'class' => '7A',
                'uid' => 'Q7R8S9T0',
                'parent_id' => 3,
            ],
            
            // Anak dari Dewi Lestari (parent_id: 4)
            [
                'nis' => '2024006',
                'name' => 'Fajar Lestari',
                'class' => '12A',
                'uid' => 'U1V2W3X4',
                'parent_id' => 4,
            ],
            
            // Anak dari Eko Prasetyo (parent_id: 5)
            [
                'nis' => '2024007',
                'name' => 'Gita Prasetyo',
                'class' => '10B',
                'uid' => 'Y5Z6A7B8',
                'parent_id' => 5,
            ],
            
            // Anak dari Fitri Handayani (parent_id: 6)
            [
                'nis' => '2024008',
                'name' => 'Hendra Handayani',
                'class' => '11B',
                'uid' => 'C9D0E1F2',
                'parent_id' => 6,
            ],
            [
                'nis' => '2024009',
                'name' => 'Indah Handayani',
                'class' => '9A',
                'uid' => 'G3H4I5J6',
                'parent_id' => 6,
            ],
            
            // Anak dari Gunawan Wijaya (parent_id: 7)
            [
                'nis' => '2024010',
                'name' => 'Jaka Wijaya',
                'class' => '8A',
                'uid' => 'K7L8M9N0',
                'parent_id' => 7,
            ],
            
            // Anak dari Hana Permata (parent_id: 8)
            [
                'nis' => '2024011',
                'name' => 'Kiki Permata',
                'class' => '10C',
                'uid' => 'O1P2Q3R4',
                'parent_id' => 8,
            ],
            
            // Anak dari Irfan Hakim (parent_id: 9)
            [
                'nis' => '2024012',
                'name' => 'Lina Hakim',
                'class' => '7B',
                'uid' => 'S5T6U7V8',
                'parent_id' => 9,
            ],
            [
                'nis' => '2024013',
                'name' => 'Maya Hakim',
                'class' => '11C',
                'uid' => 'W9X0Y1Z2',
                'parent_id' => 9,
            ],
            
            // Anak dari Joko Widodo (parent_id: 10)
            [
                'nis' => '2024014',
                'name' => 'Nanda Widodo',
                'class' => '12B',
                'uid' => 'A3B4C5D6',
                'parent_id' => 10,
            ],
            [
                'nis' => '2024015',
                'name' => 'Omar Widodo',
                'class' => '9B',
                'uid' => 'E7F8G9H0',
                'parent_id' => 10,
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
