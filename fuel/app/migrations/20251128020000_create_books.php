<?php
namespace Fuel\Migrations;

use Fuel\Core\DBUtil;

class Create_books
{
    public function up()
    {
        DBUtil::create_table('books', [
            'id' => ['type' => 'int', 'auto_increment' => true],
            'user_id' => ['type' => 'int', 'null' => false],
            'title' => ['type' => 'varchar', 'constraint' => 255],
            'impression' => ['type' => 'text'],
            'finished_at' => ['type' => 'date'],
            'created_at' => ['type' => 'datetime'],
            'updated_at' => ['type' => 'datetime'],
        ], ['id']);

        DBUtil::add_foreign_key('books', [
            'constraint' => 'books_user_id_fk',
            'key' => 'user_id',
            'reference' => [
                'table' => 'users',
                'column' => 'id',
            ],
            'on_update' => 'CASCADE',
            'on_delete' => 'CASCADE',
        ]);
    }

    public function down()
    {
        DBUtil::drop_table('books');
    }
}
