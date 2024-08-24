<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            [
                'name' => '田中テスト１',
                'date_of_birth' => '2005-03-15',
                'sex' => '男',
                'adress' => '住所テスト１',
                'admission_year' => 2022,
                'email' => 'test1@example.com',
            ],
            [
                'name' => '鈴木テスト２',
                'date_of_birth' => '2005-06-20',
                'sex' => '女',
                'adress' => '住所テスト２',
                'admission_year' => 2021,
                'email' => 'test2@example.com',
            ],
            [
                'name' => '佐藤テスト３',
                'date_of_birth' => '2006-01-11',
                'sex' => '男',
                'adress' => '住所テスト３',
                'admission_year' => 2023,
                'email' => 'test3@example.com',
            ],
            [
                'name' => '加藤テスト４',
                'date_of_birth' => '2005-09-30',
                'sex' => '女',
                'adress' => '住所テスト４',
                'admission_year' => 2019,
                'email' => 'test4@example.com',
            ],
            [
                'name' => '中村テスト５',
                'date_of_birth' => '2006-03-21',
                'sex' => '男',
                'adress' => '住所テスト５',
                'admission_year' => 2024,
                'email' => 'test5@example.com',
            ],
            [
                'name' => '山田テスト６',
                'date_of_birth' => '2005-12-01',
                'sex' => '女',
                'adress' => '住所テスト６',
                'admission_year' => 2020,
                'email' => 'test6@example.com',
            ],
            [
                'name' => '小林テスト７',
                'date_of_birth' => '2006-05-15',
                'sex' => '男',
                'adress' => '住所テスト７',
                'admission_year' => 2023,
                'email' => 'test7@example.com',
            ],
            [
                'name' => '佐々木テスト８',
                'date_of_birth' => '2005-08-25',
                'sex' => '女',
                'adress' => '住所テスト８',
                'admission_year' => 2019,
                'email' => 'test8@example.com',
            ],
            [
                'name' => '伊藤テスト９',
                'date_of_birth' => '2006-02-10',
                'sex' => '男',
                'adress' => '住所テスト９',
                'admission_year' => 2022,
                'email' => 'test9@example.com',
            ],
            [
                'name' => '渡辺テスト１０',
                'date_of_birth' => '2005-07-19',
                'sex' => '女',
                'adress' => '住所テスト１０',
                'admission_year' => 2021,
                'email' => 'test10@example.com',
            ],
            [
                'name' => '山本テスト１１',
                'date_of_birth' => '2005-10-22',
                'sex' => '男',
                'adress' => '住所テスト１１',
                'admission_year' => 2024,
                'email' => 'test11@example.com',
            ],
            [
                'name' => '中島テスト１２',
                'date_of_birth' => '2006-04-03',
                'sex' => '女',
                'adress' => '住所テスト１２',
                'admission_year' => 2020,
                'email' => 'test12@example.com',
            ],
            [
                'name' => '木村テスト１３',
                'date_of_birth' => '2005-11-27',
                'sex' => '男',
                'adress' => '住所テスト１３',
                'admission_year' => 2021,
                'email' => 'test13@example.com',
            ],
            [
                'name' => '松本テスト１４',
                'date_of_birth' => '2006-06-05',
                'sex' => '女',
                'adress' => '住所テスト１４',
                'admission_year' => 2023,
                'email' => 'test14@example.com',
            ],
            [
                'name' => '長谷川テスト１５',
                'date_of_birth' => '2005-09-11',
                'sex' => '男',
                'adress' => '住所テスト１５',
                'admission_year' => 2019,
                'email' => 'test15@example.com',
            ],
        ]);
    }
}
