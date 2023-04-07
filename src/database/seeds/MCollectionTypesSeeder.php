<?php

use Illuminate\Database\Seeder;

class MCollectionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collectionTypes = ['Feedly', 'Slideshare', 'Youtube', 'Html'];
        $now = (new \DateTime())->format('Y-m-d H:i:s');
        foreach($collectionTypes as $collectionType){
            DB::table('m_collection_types')->insert([
                'collection_type' => $collectionType,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }
    }
}
