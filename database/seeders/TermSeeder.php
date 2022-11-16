<?php

namespace Database\Seeders;

use App\Models\Term;
use App\Models\TermMeta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $terms = array(
            array('id' => '1','title' => 'New apartment development, Atlanta, GA.','slug' => 'new-apartment-development-atlanta-ga','type' => 'blog','status' => '1','featured' => '1','lang' => 'en','comment_status' => '1','meta' => NULL,'created_at' => '2022-07-31 14:59:43','updated_at' => '2022-07-31 14:59:43'),
            array('id' => '2','title' => 'New apartment development, Atlanta, GA.','slug' => 'new-apartment-development-atlanta-ga','type' => 'blog','status' => '1','featured' => '1','lang' => 'en','comment_status' => '1','meta' => NULL,'created_at' => '2022-07-31 15:00:23','updated_at' => '2022-07-31 15:00:23'),
            array('id' => '3','title' => 'New apartment development, Atlanta, GA.','slug' => 'new-apartment-development-atlanta-ga','type' => 'blog','status' => '1','featured' => '1','lang' => 'en','comment_status' => '1','meta' => NULL,'created_at' => '2022-07-31 15:00:56','updated_at' => '2022-07-31 15:00:56')
        );

        Term::insert($terms);

        $term_metas = array(
            array('id' => '2','term_id' => '2','key' => 'metatag','value' => NULL),
            array('id' => '3','term_id' => '2','key' => 'metadescription','value' => NULL),
            array('id' => '4','term_id' => '1','key' => 'preview','value' => '/uploads/1/22/07/632eeef1b12a62409221664020209.png'),
            array('id' => '5','term_id' => '1','key' => 'description','value' => 'Finance the redevelopment of an underutilized site located in the heart of Atlanta’s growing West Midtown neighborhood.'),
            array('id' => '7','term_id' => '2','key' => 'metatag','value' => NULL),
            array('id' => '8','term_id' => '2','key' => 'metadescription','value' => NULL),
            array('id' => '9','term_id' => '2','key' => 'preview','value' => '/uploads/1/22/07/632eeef1b12a62409221664020209.png'),
            array('id' => '10','term_id' => '2','key' => 'description','value' => 'Finance the redevelopment of an underutilized site located in the heart of Atlanta’s growing West Midtown neighborhood.'),
            array('id' => '12','term_id' => '3','key' => 'metatag','value' => NULL),
            array('id' => '13','term_id' => '3','key' => 'metadescription','value' => NULL),
            array('id' => '14','term_id' => '3','key' => 'preview','value' => '/uploads/1/22/07/632eeef1b12a62409221664020209.png'),
            array('id' => '15','term_id' => '3','key' => 'description','value' => 'Finance the redevelopment of an underutilized site located in the heart of Atlanta’s growing West Midtown neighborhood.')
        );
        TermMeta::insert($term_metas);
    }
}
