<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Feature;
use App\Models\FeatureType;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
 
    public function run(): void
    {


        // populate tables from .json files
        foreach (Storage::disk('seeder_data')->files() ?? [] as $file)
        {

            if (Str::endsWith(basename($file),".json"))  {
                $data  = Storage::disk("seeder_data")->get($file);
                $table = Str::Studly(Str::Singular(basename(preg_replace("/^(\d+_)?/", "", $file), ".json")));
                $model = "App\\Models\\{$table}";

                foreach (json_decode($data, true) as $item) {
                    $model::create($item);
                }
            }        
        }
    }

}