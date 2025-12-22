<?php

namespace Fuel\Migrations;

use Fuel\Core\DBUtil;

class Create_auth_tables
{
    public function up()
    {
        // users テーブル
        DBUtil::create_table('users', [
            'id'             => ['type' => 'int', 'auto_increment' => true],
            'username'       => ['type' => 'varchar', 'constraint' => 50],
            'email'          => ['type' => 'varchar', 'constraint' => 100],
            'password'       => ['type' => 'varchar', 'constraint' => 255],
            'login_hash'     => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'last_login'     => ['type' => 'int', 'null' => true],
            'profile_fields' => ['type' => 'text', 'null' => true],
            'created_at'     => ['type' => 'int', 'null' => false],
        ], ['id']);

        // user_roles テーブル
        DBUtil::create_table('user_roles', [
            'id'   => ['type' => 'int', 'auto_increment' => true],
            'name' => ['type' => 'varchar', 'constraint' => 50],
        ], ['id']);
    }

    public function down()
    {
        DBUtil::drop_table('user_roles');
        DBUtil::drop_table('users');
    }
}
