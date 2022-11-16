<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = array(
            array('id' => '1','name' => 'Header','position' => 'header','data' => '[{"text":"Home","icon":"empty","href":"/","target":"_self","title":""},{"text":"Pages","icon":"empty","href":"javascript:void(0)","target":"_self","title":"","children":[{"text":"About","icon":"empty","href":"about","target":"_self","title":""},{"text":"Properties","icon":"empty","href":"properties","target":"_self","title":""},{"text":"How Works","icon":"empty","href":"how-works","target":"_self","title":""},{"text":"Faq","icon":"empty","href":"/faqs","target":"_self","title":""},{"text":"Privacy","icon":"empty","href":"/privacy","target":"_self","title":""},{"text":"Terms","icon":"empty","href":"/terms","target":"_self","title":""}]},{"text":"Invest","icon":"empty","href":"/invest","target":"_self","title":""},{"text":"Blog","icon":"empty","href":"/blogs","target":"_self","title":""},{"text":"Contact","icon":"empty","href":"/contacts","target":"_self","title":""}]','lang' => 'en','status' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','name' => 'Company','position' => 'footer_left_menu','data' => '[{"text":" About us","href":"#","icon":"empty","target":"_self","title":""},{"text":"Roadmap","href":"#","icon":"empty","target":"_self","title":""},{"text":"Pricing","href":"#","icon":"empty","target":"_self","title":""},{"text":"Privacy","href":"/privacy","icon":"empty","target":"_self","title":""},{"text":"Help","icon":"empty","href":"#","target":"_self","title":""}]','lang' => 'en','status' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','name' => 'Usefull Links','position' => 'footer_right_menu','data' => '[{"text":"About Api","href":"#","icon":"empty","target":"_self","title":""},{"text":"Pricing","href":"#","icon":"empty","target":"_self","title":""},{"text":"Blog","icon":"empty","href":"/blogs","target":"_self","title":""},{"text":"Privacy","href":"/privacy","icon":"empty","target":"_self","title":""},{"text":"Help","href":"#","icon":"empty","target":"_self","title":""}]','lang' => 'en','status' => '1','created_at' => NULL,'updated_at' => NULL)
        );
        Menu::insert($menus);
    }
}
