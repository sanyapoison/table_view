<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    public function run()
    {
        $csvPath = base_path('data/property-data.csv');
        $csvData = array_map('str_getcsv', file($csvPath));
        $header = array_shift($csvData);

        foreach ($csvData as $row) {
            $data = array_combine($header, $row);
            Property::create([
                'name' => $data['Name'],
                'price' => $data['Price'],
                'bedrooms' => $data['Bedrooms'],
                'bathrooms' => $data['Bathrooms'],
                'storeys' => $data['Storeys'],
                'garages' => $data['Garages'],
            ]);
        }
    }
}
