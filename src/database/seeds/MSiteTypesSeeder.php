<?php

use Illuminate\Database\Seeder;

class MSiteTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $siteTypes = ['Feedly'];
        $now = (new \DateTime())->format('Y-m-d H:i:s');
        foreach($siteTypes as $siteType){
            DB::table('m_site_types')->insert([
                'site_type' => $siteType,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }
    }
}
