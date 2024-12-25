<?php

namespace Modules\ManageUser\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\ManageUser\Entities\User;
use Modules\ManageUser\Entities\UserGroup;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        $super_user = User::query()->where('email', '=', 'admin@admin.com')->first();
        if (!$super_user) {
            $user_group = UserGroup::query()->where('nama', '=', 'superadmin')->first();
            if ($user_group) {
                User::query()->create([
                    'nama' => 'super_user',
                    'email' => 'admin@admin.com',
                    'password' => bcrypt('password'),
                    'grup_user_id' => $user_group->id,
                    'telepon' => '08123456789',
                    'is_admin' => true,
                    'user_frontend' => true,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
