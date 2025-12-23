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

}
