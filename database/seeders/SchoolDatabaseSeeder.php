<?php
namespace Database\Seeders;

use App\Models\Classe;
use App\Enum\UserRole;
use Illuminate\Database\Seeder;
use App\Models\Level;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SchoolDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Levels
        $level1 = Level::create(['title' => '1st Year Baccalaureate']);
        $level2 = Level::create(['title' => '2nd Year Baccalaureate']);

        // 2. Create Classes for Level 1
        $class1A = Classe::create(['title' => '1 Sciences A', 'level_id' => $level1->id]);
        $class1B = Classe::create(['title' => '1 Sciences B', 'level_id' => $level1->id]);

        // 3. Create Classes for Level 2
        $class2A = Classe::create(['title' => '2 Math Sciences', 'level_id' => $level2->id]);

        // 4. Create Admin Account
        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@massar.test',
            'password' => Hash::make('password'),
            'role' => UserRole::Admin,
        ]);

        // 5. Create Teacher Account
        User::create([
            'name' => 'Prof. Mohammed Alami',
            'email' => 'teacher@massar.test',
            'password' => Hash::make('password'),
            'role' => UserRole::Teacher,
        ]);

        // 6. Create Student Accounts (Assigned to Classes)
        User::create([
            'name' => 'Youssef Benali',
            'email' => 'student1@massar.test',
            'password' => Hash::make('password'),
            'role' => UserRole::Student,
            'class_id' => $class1A->id,
        ]);

        User::create([
            'name' => 'Fatima Zahra',
            'email' => 'student2@massar.test',
            'password' => Hash::make('password'),
            'role' => UserRole::Student,
            'class_id' => $class2A->id,
        ]);
    }
}
