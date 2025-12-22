<?php

use Orm\Model;

class Model_User extends Model
{
    protected static $_table_name = 'users';
    protected static $_primary_key = array('id');

    protected static $_properties = array(
        'id',
        'username',
        'email',
        'password',
        'group',
        'profile_fields',
        'created_at',
        'last_login',
        'login_hash'
    );
}

