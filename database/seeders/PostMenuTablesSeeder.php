<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostMenuTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PostMenu::truncate();
        
        \App\Models\PostMenu::insert([
            [
                'group' => '0',
                'title' => 'All Action',
                'icon' => 'fa-bar-chart',
                'uri' => '*',
            ],
            [
                'group' => '1',
                'title' => 'Chỉnh sửa',
                'icon' => 'fa-bar-chart',
                'uri' => '/edit',
            ],
            [    
                'group' => '1',
                'title' => 'Xóa bài viết',
                'icon' => 'fa-bar-chart',
                'uri' => '/remove',
            ],
            [    
                'group' => '2',
                'title' => 'Ẩn bài viết',
                'icon' => 'fa-bar-chart',
                'uri' => '/hidden',
            ],
            [    
                'group' => '2',
                'title' => 'Báo cáo nội dung',
                'icon' => 'fa-bar-chart',
                'uri' => '/report',
            ],
        ]);
    }
}
