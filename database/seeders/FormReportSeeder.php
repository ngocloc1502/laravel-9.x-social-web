<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;

class FormReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        \App\Models\FormReport::truncate();
        
        Schema::enableForeignKeyConstraints();
        \App\Models\FormReport::insert([
            [
                'name' => 'Hình ảnh khoản thân',
            ],
            [
                'name' => 'Bán hàng trái phép',
            ],
            [
                'name' => 'Bạo lực',
            ],
            [
                'name' => 'Quấy rối',
            ],
            [
                'name' => 'Ngôn từ gây thù ghét',
            ],
            [
                'name' => 'Vấn đề khác',
            ],
        ]);
    }
}
