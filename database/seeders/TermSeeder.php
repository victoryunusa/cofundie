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
            array('id' => '4','title' => 'How to Invest In Real Estate with Your First $500','slug' => 'how-to-invest-in-real-estate-with-your-first-500','type' => 'blog','status' => '1','featured' => '1','lang' => 'en','comment_status' => '1','meta' => NULL,'created_at' => '2022-11-18 04:26:41','updated_at' => '2022-11-18 04:26:41'),
            array('id' => '5','title' => 'How Do You Value a Real Estate Investment?','slug' => 'how-do-you-value-a-real-estate-investment','type' => 'blog','status' => '1','featured' => '1','lang' => 'en','comment_status' => '1','meta' => NULL,'created_at' => '2022-11-18 06:12:01','updated_at' => '2022-11-18 06:12:01'),
            array('id' => '6','title' => 'The 7 Most Profitable Real Estate Investments in the World','slug' => 'the-7-most-profitable-real-estate-investments-in-the-world','type' => 'blog','status' => '1','featured' => '1','lang' => 'en','comment_status' => '1','meta' => NULL,'created_at' => '2022-11-18 06:12:59','updated_at' => '2022-11-18 06:12:59')
          );

        Term::insert($terms);

        $term_metas = array(
            array('id' => '16','term_id' => '4','key' => 'metatag','value' => 'real estate, real invest'),
            array('id' => '17','term_id' => '4','key' => 'metadescription','value' => 'Many investors see real estate as a great long-term investment because it can appreciatively increase in value over time. But buying something that is not in a strong, stable economy can be a nightmare.'),
            array('id' => '18','term_id' => '4','key' => 'preview','value' => '/uploads/1/22/11/6376b3e52d1c41811221668723685.jpg'),
            array('id' => '19','term_id' => '4','key' => 'description','value' => '<p>Many investors see real estate as a great long-term investment because it can appreciatively increase in value over time. But buying something that is not in a strong, stable economy can be a nightmare.<br></p>'),
            array('id' => '20','term_id' => '5','key' => 'metatag','value' => NULL),
            array('id' => '21','term_id' => '5','key' => 'metadescription','value' => NULL),
            array('id' => '22','term_id' => '5','key' => 'preview','value' => '/uploads/1/22/11/6376cb77e79d21811221668729719.jpg'),
            array('id' => '23','term_id' => '5','key' => 'description','value' => '<p>In order to buy real estate for a rental property, you need to be aware of some key facts about how that type of investment works. First is the most obvious-you will need a lot of money to buy a rental property.<br></p>'),
            array('id' => '24','term_id' => '6','key' => 'metatag','value' => NULL),
            array('id' => '25','term_id' => '6','key' => 'metadescription','value' => NULL),
            array('id' => '26','term_id' => '6','key' => 'preview','value' => '/uploads/1/22/11/6376cb7a2453e1811221668729722.jpg'),
            array('id' => '27','term_id' => '6','key' => 'description','value' => '<p>The best way to buy into the market is to buy a pre-owned property with a down payment. The advantage to this type of investment is that you get a property that has already been rented out, which means that you don\'t have to fix it up before you start renting it out.<br></p>')
          );
        TermMeta::insert($term_metas);
    }
}
