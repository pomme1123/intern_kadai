<?php

use Auth\Auth;

class Controller_Test extends Controller
{
    public function action_index()
    {
        // FuelPHP の Auth を使ってユーザーを作成
        try {
            $user_id = Auth::create_user('akari', 'password123', 'akari@example.com');
            echo "✅ ユーザー作成に成功しました！<br>";
            echo "新しいユーザーID: " . $user_id;
        } catch (\SimpleUserUpdateException $e) {
            echo "⚠️ ユーザー作成に失敗: " . $e->getMessage();
        }
    }
}
