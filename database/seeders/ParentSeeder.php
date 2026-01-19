<?php

namespace Database\Seeders;

use App\Models\ParentModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParentSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parents = [
            [
                'name' => 'Budi Santoso',
                'address' => 'Jl. Merdeka No. 12, Jakarta Pusat',
                'telegram_id' => '123456789',
                'phone' => '081234567890',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'address' => 'Jl. Sudirman No. 45, Jakarta Selatan',
                'telegram_id' => '234567890',
                'phone' => '081234567891',
            ],
            [
                'name' => 'Ahmad Dahlan',
                'address' => 'Jl. Gatot Subroto No. 78, Jakarta Barat',
                'telegram_id' => '345678901',
                'phone' => '081234567892',
            ],
            [
                'name' => 'Dewi Lestari',
                'address' => 'Jl. Thamrin No. 23, Jakarta Pusat',
                'telegram_id' => '456789012',
                'phone' => '081234567893',
            ],
            [
                'name' => 'Eko Prasetyo',
                'address' => 'Jl. Kuningan No. 56, Jakarta Selatan',
                'telegram_id' => '567890123',
                'phone' => '081234567894',
            ],
            [
                'name' => 'Fitri Handayani',
                'address' => 'Jl. Rasuna Said No. 89, Jakarta Selatan',
                'telegram_id' => '678901234',
                'phone' => '081234567895',
            ],
            [
                'name' => 'Gunawan Wijaya',
                'address' => 'Jl. Kebon Jeruk No. 34, Jakarta Barat',
                'telegram_id' => '789012345',
                'phone' => '081234567896',
            ],
            [
                'name' => 'Hana Permata',
                'address' => 'Jl. Cikini Raya No. 67, Jakarta Pusat',
                'telegram_id' => '890123456',
                'phone' => '081234567897',
            ],
            [
                'name' => 'Irfan Hakim',
                'address' => 'Jl. Pancoran No. 90, Jakarta Selatan',
                'telegram_id' => '901234567',
                'phone' => '081234567898',
            ],
            [
                'name' => 'Joko Widodo',
                'address' => 'Jl. Menteng No. 12, Jakarta Pusat',
                'telegram_id' => '012345678',
                'phone' => '081234567899',
            ],
        ];

        foreach ($parents as $parent) {
            ParentModel::create($parent);
        }
    }
}
