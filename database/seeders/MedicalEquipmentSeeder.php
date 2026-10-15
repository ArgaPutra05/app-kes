<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'code' => 'ALK-2026-001',
                'name' => 'Patient Monitor Mindray uMEC 10',
                'category' => 'Monitoring',
                'brand' => 'Mindray',
                'model_number' => 'uMEC 10',
                'serial_number' => 'MN-884920-X',
                'stock' => 8,
                'price' => 45000000,
                'location' => 'Ruang ICU',
                'condition' => 'Baik',
                'description' => 'Monitor tanda vital pasien 10.4 inchi dengan modul ECG, SpO2, NIBP, Respirasi, dan Temperatur.',
                'purchase_date' => '2024-03-15',
            ],
            [
                'code' => 'ALK-2026-002',
                'name' => 'Ventilator ICU Mindray SynoVent E3',
                'category' => 'Life Support',
                'brand' => 'Mindray',
                'model_number' => 'SynoVent E3',
                'serial_number' => 'SV-991044-B',
                'stock' => 4,
                'price' => 185000000,
                'location' => 'Ruang ICU',
                'condition' => 'Kalibrasi',
                'description' => 'Ventilator medis canggih untuk perawatan intensif dewasa dan pediatrik dengan layar sentuh 10.4 inchi.',
                'purchase_date' => '2023-11-20',
            ],
            [
                'code' => 'ALK-2026-003',
                'name' => 'USG Portable 4D Mindray DP-10',
                'category' => 'Diagnostic',
                'brand' => 'Mindray',
                'model_number' => 'DP-10 Digital',
                'serial_number' => 'USG-44102-K',
                'stock' => 3,
                'price' => 85000000,
                'location' => 'Poliklinik Kebidanan',
                'condition' => 'Baik',
                'description' => 'Sistem ultrasonografi hitam putih digital portabel dengan transduser linier dan konveks.',
                'purchase_date' => '2025-01-10',
            ],
            [
                'code' => 'ALK-2026-004',
                'name' => 'Defibrillator Biphasic Philips HeartStart XL+',
                'category' => 'Life Support',
                'brand' => 'Philips',
                'model_number' => 'HeartStart XL+',
                'serial_number' => 'DF-772910-P',
                'stock' => 5,
                'price' => 98000000,
                'location' => 'Ruang IGD',
                'condition' => 'Baik',
                'description' => 'Defibrillator/Monitor resusitasi jantung darurat dengan mode AED dan pacu jantung eksternal.',
                'purchase_date' => '2024-06-05',
            ],
            [
                'code' => 'ALK-2026-005',
                'name' => 'Stetoskop Digital 3M Littmann CORE',
                'category' => 'Diagnostic',
                'brand' => '3M Littmann',
                'model_number' => 'CORE Digital 8570',
                'serial_number' => 'ST-330192-M',
                'stock' => 15,
                'price' => 65000000,
                'location' => 'Poliklinik Umum',
                'condition' => 'Baik',
                'description' => 'Stetoskop digital pintar dengan penguatan suara hingga 40x dan visualisasi gelombang di aplikasi smartphone.',
                'purchase_date' => '2025-02-14',
            ],
            [
                'code' => 'ALK-2026-006',
                'name' => 'Syringe Pump Fresenius Injectomat Agilia',
                'category' => 'Life Support',
                'brand' => 'Fresenius Kabi',
                'model_number' => 'Injectomat Agilia',
                'serial_number' => 'SP-109482-F',
                'stock' => 12,
                'price' => 24500000,
                'location' => 'Ruang OK (Bedah)',
                'condition' => 'Perlu Perbaikan',
                'description' => 'Pompa suntik presisi tinggi untuk infusi obat kontinyu pada kondisi kritis.',
                'purchase_date' => '2023-08-30',
            ],
            [
                'code' => 'ALK-2026-007',
                'name' => 'Autoclave Sterilizer Hirayama HVE-50',
                'category' => 'Sterilization',
                'brand' => 'Hirayama',
                'model_number' => 'HVE-50 Vertikal',
                'serial_number' => 'AT-550192-H',
                'stock' => 2,
                'price' => 115000000,
                'location' => 'Ruang Sterilisasi (CSSD)',
                'condition' => 'Baik',
                'description' => 'Autoklaf Uap tekanan tinggi 50 liter untuk sterilisasi peralatan bedah dan instrumen medis.',
                'purchase_date' => '2024-01-22',
            ],
            [
                'code' => 'ALK-2026-008',
                'name' => 'Electrocardiogram ECG 12-Channel GE MAC 2000',
                'category' => 'Diagnostic',
                'brand' => 'GE Healthcare',
                'model_number' => 'MAC 2000',
                'serial_number' => 'EKG-88201-G',
                'stock' => 6,
                'price' => 58000000,
                'location' => 'Poliklinik Jantung',
                'condition' => 'Baik',
                'description' => 'Mesin EKG 12 Lead dengan analisis otomatis Marquette 12SL dan printer thermal internal.',
                'purchase_date' => '2024-09-18',
            ],
            [
                'code' => 'ALK-2026-009',
                'name' => 'Suction Pump Portable Thomas 1632',
                'category' => 'Surgical',
                'brand' => 'Thomas Medical',
                'model_number' => '1632 Series',
                'serial_number' => 'SUC-11029-T',
                'stock' => 10,
                'price' => 12500000,
                'location' => 'Gudang Utama',
                'condition' => 'Rusak',
                'description' => 'Alat penyedot cairan medis portabel untuk tindakan bedah dan gawat darurat.',
                'purchase_date' => '2022-04-10',
            ],
        ];

        foreach ($items as $item) {
            \App\Models\MedicalEquipment::updateOrCreate(
                ['code' => $item['code']],
                $item
            );
        }
    }
}
