<?php

namespace Fuel\Migrations;

use Fuel\Core\DBUtil;

class Create_users
{
    public function up()
    {
        DBUtil::create_table('users', [
            'id' => ['type' => 'int', 'auto_increment' => true],
            'birthdate' => ['type' => 'date', 'null' => false],
            'password_hash' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'created_at' => ['type' => 'datetime', 'null' => false],
        ], ['id']);
    }

    public function down()
    {
        DBUtil::drop_table('users');
    }
}
