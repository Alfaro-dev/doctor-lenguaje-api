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
            'Level A1' => 'data/level_a1.json'
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
                        'order' => $lessonData['order'],
                        'description' => $lessonData['description'],
                        'grammar_topic' => $lessonData['grammar_topic'],
                        'experience_points' => $lessonData['experience_points'],
                        'objective' => $lessonData['objective'],
                        'vocabulary' => isset($lessonData['vocabulary']) ? $lessonData['vocabulary'] : [],
                        'verbs' => isset($lessonData['verbs']) ? $lessonData['verbs'] : [],
                        'native_expression' => isset($lessonData['native_expression']) ? $lessonData['native_expression'] : [],
                        'content' => isset($lessonData['content']) ? $lessonData['content'] : [],
                    ]);
                }
            }
        }
    }
}
