<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $media = [
            ['id' => '1','url' => '/uploads/1/22/07/62e6814c04fd93107221659273548.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e6814c04fd93107221659273548.png","/uploads\\/1\\/22\\/07\\/62e6814c04fd93107221659273548small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '2','url' => '/uploads/1/22/07/62e6814c3a57a3107221659273548.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e6814c3a57a3107221659273548.png","/uploads\\/1\\/22\\/07\\/62e6814c3a57a3107221659273548small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '3','url' => '/uploads/1/22/07/62e6814c6a87d3107221659273548.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e6814c6a87d3107221659273548.png","/uploads\\/1\\/22\\/07\\/62e6814c6a87d3107221659273548small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '4','url' => '/uploads/1/22/07/62e6814c8ed5f3107221659273548.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e6814c8ed5f3107221659273548.png","/uploads\\/1\\/22\\/07\\/62e6814c8ed5f3107221659273548small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '5','url' => '/uploads/1/22/07/62e6814cae0483107221659273548.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e6814cae0483107221659273548.png","/uploads\\/1\\/22\\/07\\/62e6814cae0483107221659273548small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '6','url' => '/uploads/1/22/07/62e6814cd37233107221659273548.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e6814cd37233107221659273548.png","/uploads\\/1\\/22\\/07\\/62e6814cd37233107221659273548small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '7','url' => '/uploads/1/22/07/62e681584c3fa3107221659273560.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e681584c3fa3107221659273560.png","/uploads\\/1\\/22\\/07\\/62e681584c3fa3107221659273560small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '8','url' => '/uploads/1/22/07/62e681586a77e3107221659273560.png','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e681586a77e3107221659273560.png","/uploads\\/1\\/22\\/07\\/62e681586a77e3107221659273560small.png"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
            ['id' => '9','url' => '/uploads/1/22/07/62e68164ae22d3107221659273572.jpg','driver' => 'local','files' => '["/uploads\\/1\\/22\\/07\\/62e68164ae22d3107221659273572.jpg","/uploads\\/1\\/22\\/07\\/62e68164ae22d3107221659273572small.jpg"]','user_id' => NULL,'is_optimized' => '0','created_at' => now(),'updated_at' => now()],
        ];

        Media::insert($media);
    }
}
