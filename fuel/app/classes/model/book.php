<?php

use Orm\Model;
use Fuel\Core\Validation;

class Model_Book extends Model
{
    protected static $_properties = [
        'id',
        'user_id',
        'title',
        'impression',
        'finished_at',
        'created_at',
        'updated_at',
    ];

    protected static $_observers = [
        'Orm\\Observer_CreatedAt' => [
            'events'           => ['before_insert'],
            'mysql_timestamp'  => false,
        ],
        'Orm\\Observer_UpdatedAt' => [
            'events'           => ['before_save'],
            'mysql_timestamp'  => false,
        ],
    ];

    protected static $_table_name = 'books';

    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('title', 'タイトル', 'required|max_length[255]');
        $val->add_field('impression', '感想', 'required');
        $val->add_field('finished_at', '読了日', 'required');
        return $val;
    }
}
