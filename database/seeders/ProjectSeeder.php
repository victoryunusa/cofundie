<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Projectmeta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
            ['title' => '2587 Deerfiled rd Nw, Huntsville, All 35874', 'slug' => Str::slug('2587 Deerfiled rd Nw, Huntsville, All 35874-1'), 'thumbnail' => '/uploads/1/22/09/633298e0be2b42709221664260320.jpg', 'preview' => '/uploads/1/22/09/633298e0be2b42709221664260320.jpg', 'invest_type' => 0, 'capital_back' => 1, 'min_invest' => 1000, 'max_invest' => 2000, 'max_invest_amount' => 20000, 'is_period' => 1, 'period_duration' => 'monthly', 'profit_range' => 10, 'loss_range' => 5, 'status' => 1, 'accept_installments' => 1, 'address' => 'Rayerbag, Dhaka, Bangladesh', 'created_at' => now()],

            ['title' => '2587 Deerfiled rd Nw, Huntsville, All 35874', 'slug' => Str::slug('2587 Deerfiled rd Nw, Huntsville, All 35874-2'), 'thumbnail' => '/uploads/1/22/09/633298e2096f52709221664260322.jpg', 'preview' => '/uploads/1/22/09/633298e0be2b42709221664260320.jpg', 'invest_type' => 1, 'capital_back' => 0, 'min_invest' => 1000, 'max_invest' => 2000, 'max_invest_amount' => 20000, 'is_period' => 0, 'period_duration' => '', 'profit_range' => 10, 'loss_range' => 5, 'status' => 1,'accept_installments' => 0, 'address' => 'Rayerbag, Dhaka, Bangladesh', 'created_at' => now()],

            ['title' => '2587 Deerfiled rd Nw, Huntsville, All 35874', 'slug' => Str::slug('2587 Deerfiled rd Nw, Huntsville, All 35874-3'), 'thumbnail' => '/uploads/1/22/09/633298e0be2b42709221664260320.jpg', 'preview' => '/uploads/1/22/09/633298e0be2b42709221664260320.jpg', 'invest_type' => 0, 'capital_back' => 1, 'min_invest' => 1000, 'max_invest' => 2000, 'max_invest_amount' => 20000, 'is_period' => 1, 'period_duration' => 'monthly', 'profit_range' => 10, 'loss_range' => 5, 'status' => 1,'accept_installments' => 0, 'address' => 'Rayerbag, Dhaka, Bangladesh', 'created_at' => now()],

            ['title' => '2587 Deerfiled rd Nw, Huntsville, All 35874', 'slug' => Str::slug('2587 Deerfiled rd Nw, Huntsville, All 35874-4'), 'thumbnail' => '/uploads/1/22/09/633298e2096f52709221664260322.jpg', 'preview' => '/uploads/1/22/09/633298e0be2b42709221664260320.jpg', 'invest_type' => 1, 'capital_back' => 0, 'min_invest' => 1000, 'max_invest' => 2000, 'max_invest_amount' => 20000, 'is_period' => 0, 'period_duration' => '', 'profit_range' => 10, 'loss_range' => 5, 'status' => 1,'accept_installments' => 0, 'address' => 'Rayerbag, Dhaka, Bangladesh', 'created_at' => now()],

            ['title' => '2587 Deerfiled rd Nw, Huntsville, All 35874', 'slug' => Str::slug('2587 Deerfiled rd Nw, Huntsville, All 35874-5'), 'thumbnail' => '/uploads/1/22/09/633298e0be2b42709221664260320.jpg', 'preview' => '/uploads/1/22/09/633298e0be2b42709221664260320.jpg', 'invest_type' => 0, 'capital_back' => 1, 'min_invest' => 1000, 'max_invest' => 2000, 'max_invest_amount' => 20000, 'is_period' => 1, 'period_duration' => 'monthly', 'profit_range' => 10, 'loss_range' => 5, 'status' => 1,'accept_installments' => 0, 'address' => 'Rayerbag, Dhaka, Bangladesh', 'created_at' => now()],

            ['title' => '2587 Deerfiled rd Nw, Huntsville, All 35874', 'slug' => Str::slug('2587 Deerfiled rd Nw, Huntsville, All 35874-6'), 'thumbnail' => '/uploads/1/22/09/633298e2096f52709221664260322.jpg', 'preview' => '/uploads/1/22/09/633298e0be2b42709221664260320.jpg', 'invest_type' => 1, 'capital_back' => 0, 'min_invest' => 1000, 'max_invest' => 2000, 'max_invest_amount' => 20000, 'is_period' => 0, 'period_duration' => '', 'profit_range' => 10, 'loss_range' => 5, 'status' => 1,'accept_installments' => 0, 'address' => 'Rayerbag, Dhaka, Bangladesh', 'created_at' => now()],
        ];


        $metas = [
            ['project_id' => 1, 'key' => 'meta', 'value' => '{"location":"https:\/\/www.google.com\/maps\/embed?pb=!1m18!1m12!1m3!1d2745.25572937075!2d90.48134853069325!3d23.67605714757436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b7c7a80066a1%3A0x71f6f80282e23c46!2sBhuighor%20Bus%20stop!5e1!3m2!1sen!2sbd!4v1664262057207!5m2!1sen!2sbd","description":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet unde voluptas commodi nostrum repudiandae facere suscipit incidunt? Libero error qui, adipisci est officia provident ullam. Molestiae similique incidunt eveniet vitae pariatur repellendus animi odio. Vitae fugiat, repellendus suscipit quaerat eveniet magnam, ad maiores officia illum exercitationem cum aliquam autem?\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet unde voluptas commodi nostrum repudiandae facere suscipit incidunt? Libero error qui, adipisci est officia provident ullam. Molestiae similique incidunt eveniet vitae pariatur repellendus animi odio. Vitae fugiat, repellendus suscipit quaerat eveniet magnam, ad maiores officia illum exercitationem cum aliquam autem?","galleries":["/uploads\/1\/22\/09\/633298e0be2b42709221664260320.jpg","/uploads\/1\/22\/09\/633298e2096f52709221664260322.jpg"],"icon":["fas fa-bed","fas fa-cocktail","fas fa-car"],"text":["Bed","Commot","Car"],"item":["2","1","1"]}'],
            ['project_id' => 2, 'key' => 'meta', 'value' => '{"location":"https:\/\/www.google.com\/maps\/embed?pb=!1m18!1m12!1m3!1d2745.25572937075!2d90.48134853069325!3d23.67605714757436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b7c7a80066a1%3A0x71f6f80282e23c46!2sBhuighor%20Bus%20stop!5e1!3m2!1sen!2sbd!4v1664262057207!5m2!1sen!2sbd","description":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet unde voluptas commodi nostrum repudiandae facere suscipit incidunt? Libero error qui, adipisci est officia provident ullam. Molestiae similique incidunt eveniet vitae pariatur repellendus animi odio. Vitae fugiat, repellendus suscipit quaerat eveniet magnam, ad maiores officia illum exercitationem cum aliquam autem?\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet unde voluptas commodi nostrum repudiandae facere suscipit incidunt? Libero error qui, adipisci est officia provident ullam. Molestiae similique incidunt eveniet vitae pariatur repellendus animi odio. Vitae fugiat, repellendus suscipit quaerat eveniet magnam, ad maiores officia illum exercitationem cum aliquam autem?","galleries":["/uploads\/1\/22\/09\/633298e0be2b42709221664260320.jpg","/uploads\/1\/22\/09\/633298e2096f52709221664260322.jpg"],"icon":["fas fa-bed","fas fa-cocktail","fas fa-car"],"text":["Bed","Commot","Car"],"item":["2","1","1"]}'],
            ['project_id' => 3, 'key' => 'meta', 'value' => '{"location":"https:\/\/www.google.com\/maps\/embed?pb=!1m18!1m12!1m3!1d2745.25572937075!2d90.48134853069325!3d23.67605714757436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b7c7a80066a1%3A0x71f6f80282e23c46!2sBhuighor%20Bus%20stop!5e1!3m2!1sen!2sbd!4v1664262057207!5m2!1sen!2sbd","description":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet unde voluptas commodi nostrum repudiandae facere suscipit incidunt? Libero error qui, adipisci est officia provident ullam. Molestiae similique incidunt eveniet vitae pariatur repellendus animi odio. Vitae fugiat, repellendus suscipit quaerat eveniet magnam, ad maiores officia illum exercitationem cum aliquam autem?\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet unde voluptas commodi nostrum repudiandae facere suscipit incidunt? Libero error qui, adipisci est officia provident ullam. Molestiae similique incidunt eveniet vitae pariatur repellendus animi odio. Vitae fugiat, repellendus suscipit quaerat eveniet magnam, ad maiores officia illum exercitationem cum aliquam autem?","galleries":["/uploads\/1\/22\/09\/633298e0be2b42709221664260320.jpg","/uploads\/1\/22\/09\/633298e2096f52709221664260322.jpg"],"icon":["fas fa-bed","fas fa-cocktail","fas fa-car"],"text":["Bed","Commot","Car"],"item":["2","1","1"]}'],
            ['project_id' => 4, 'key' => 'meta', 'value' => '{"location":"https:\/\/www.google.com\/maps\/embed?pb=!1m18!1m12!1m3!1d2745.25572937075!2d90.48134853069325!3d23.67605714757436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b7c7a80066a1%3A0x71f6f80282e23c46!2sBhuighor%20Bus%20stop!5e1!3m2!1sen!2sbd!4v1664262057207!5m2!1sen!2sbd","description":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet unde voluptas commodi nostrum repudiandae facere suscipit incidunt? Libero error qui, adipisci est officia provident ullam. Molestiae similique incidunt eveniet vitae pariatur repellendus animi odio. Vitae fugiat, repellendus suscipit quaerat eveniet magnam, ad maiores officia illum exercitationem cum aliquam autem?\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet unde voluptas commodi nostrum repudiandae facere suscipit incidunt? Libero error qui, adipisci est officia provident ullam. Molestiae similique incidunt eveniet vitae pariatur repellendus animi odio. Vitae fugiat, repellendus suscipit quaerat eveniet magnam, ad maiores officia illum exercitationem cum aliquam autem?","galleries":["/uploads\/1\/22\/09\/633298e0be2b42709221664260320.jpg","/uploads\/1\/22\/09\/633298e2096f52709221664260322.jpg"],"icon":["fas fa-bed","fas fa-cocktail","fas fa-car"],"text":["Bed","Commot","Car"],"item":["2","1","1"]}'],
            ['project_id' => 5, 'key' => 'meta', 'value' => '{"location":"https:\/\/www.google.com\/maps\/embed?pb=!1m18!1m12!1m3!1d2745.25572937075!2d90.48134853069325!3d23.67605714757436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b7c7a80066a1%3A0x71f6f80282e23c46!2sBhuighor%20Bus%20stop!5e1!3m2!1sen!2sbd!4v1664262057207!5m2!1sen!2sbd","description":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet unde voluptas commodi nostrum repudiandae facere suscipit incidunt? Libero error qui, adipisci est officia provident ullam. Molestiae similique incidunt eveniet vitae pariatur repellendus animi odio. Vitae fugiat, repellendus suscipit quaerat eveniet magnam, ad maiores officia illum exercitationem cum aliquam autem?\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet unde voluptas commodi nostrum repudiandae facere suscipit incidunt? Libero error qui, adipisci est officia provident ullam. Molestiae similique incidunt eveniet vitae pariatur repellendus animi odio. Vitae fugiat, repellendus suscipit quaerat eveniet magnam, ad maiores officia illum exercitationem cum aliquam autem?","galleries":["/uploads\/1\/22\/09\/633298e0be2b42709221664260320.jpg","/uploads\/1\/22\/09\/633298e2096f52709221664260322.jpg"],"icon":["fas fa-bed","fas fa-cocktail","fas fa-car"],"text":["Bed","Commot","Car"],"item":["2","1","1"]}'],
            ['project_id' => 6, 'key' => 'meta', 'value' => '{"location":"https:\/\/www.google.com\/maps\/embed?pb=!1m18!1m12!1m3!1d2745.25572937075!2d90.48134853069325!3d23.67605714757436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b7c7a80066a1%3A0x71f6f80282e23c46!2sBhuighor%20Bus%20stop!5e1!3m2!1sen!2sbd!4v1664262057207!5m2!1sen!2sbd","description":"Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet unde voluptas commodi nostrum repudiandae facere suscipit incidunt? Libero error qui, adipisci est officia provident ullam. Molestiae similique incidunt eveniet vitae pariatur repellendus animi odio. Vitae fugiat, repellendus suscipit quaerat eveniet magnam, ad maiores officia illum exercitationem cum aliquam autem?\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet unde voluptas commodi nostrum repudiandae facere suscipit incidunt? Libero error qui, adipisci est officia provident ullam. Molestiae similique incidunt eveniet vitae pariatur repellendus animi odio. Vitae fugiat, repellendus suscipit quaerat eveniet magnam, ad maiores officia illum exercitationem cum aliquam autem?","galleries":["/uploads\/1\/22\/09\/633298e0be2b42709221664260320.jpg","/uploads\/1\/22\/09\/633298e2096f52709221664260322.jpg"],"icon":["fas fa-bed","fas fa-cocktail","fas fa-car"],"text":["Bed","Commot","Car"],"item":["2","1","1"]}'],
            ['project_id' => 1, 'key' => 'installments', 'value' => '{"installment_amount":"500","total_installments":"3","installment_duration":"7","late_fees":"5"}'],
        ];

        Project::insert($projects);
        Projectmeta::insert($metas);
    }
}