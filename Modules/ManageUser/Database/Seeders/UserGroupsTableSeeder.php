<?php

namespace Modules\ManageUser\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\ManageUser\Entities\UserGroup;

class UserGroupsTableSeeder extends Seeder
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
        $user_group = UserGroup::query()->where('nama', '=', 'superadmin')->first();
        if (is_null($user_group)) {
            UserGroup::query()->create([
                'nama' => 'superadmin',
                'deskripsi' => 'semua akses',
                'hak_akses' => ["dashboard.index","grup-user.destroy","grup-user.index","grup-user.create","grup-user.edit","member.destroy","member.index","member.create","member.edit","user.destroy","user.index","user.create","user.edit","anime.index","anime.create","anime.show","anime.destroy","anime.edit","anime.episode.index","anime.episode.create","episode.destroy","episode.edit"],
            ]);
        }
    }
}
