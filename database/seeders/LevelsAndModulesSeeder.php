<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

use App\Models\Lenguaje;
use App\Models\Module;
use App\Models\Level;
use App\Models\Lesson;


class LevelsAndModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the JSON files to seed the database
        $jsonFiles = [
            'Level A1' => 'data/level_a1.json',
            'Level A2' => 'data/level_a2.json',
            'Level B1' => 'data/level_b1.json',
            'Level B2' => 'data/level_b2.json',
            'Level C1' => 'data/level_c1.json',
            'Level C2' => 'data/level_c2.json',
        ];

        // Create the English language
        $lenguaje = Lenguaje::create(['name' => 'English']);

        // Loop through the JSON files and seed the database
        foreach ($jsonFiles as $key => $jsonFile) {
            // Get the JSON file and decode it
            $jsonPath = database_path($jsonFile);
            $json = File::get($jsonPath);
            $data = json_decode($json, true);

            // Create the level
            $level = Level::create([
                'name' => $key,
                'lenguaje_id' => $lenguaje->id,
            ]);

            // Convert the level name to a key
            $levelKey = strtolower(str_replace(' ', '_', $key));

            // Create the modules
            foreach ($data[$levelKey]['modules'] as $moduleData) {
                $module = Module::create([
                    'level_id' => $level->id,
                    'name' => $moduleData['module'],
                    'description' => $moduleData['description'],
                ]);

                foreach ($moduleData['lessons'] as $lessonData) {
                    Lesson::create([
                        'module_id' => $module->id,
                        'title' => $lessonData['title'],
                        'grammar' => $lessonData['grammar']
                    ]);
                }
            }
        }
    }
}
