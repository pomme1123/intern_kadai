<?php

use Auth\Auth;

class Controller_Test extends Controller
{
    public function action_index()
    {
        try {
            // FuelPHP の Auth を使ってユーザーを作成
            $user_id = Auth::create_user(
                'akari',
                'password123',
                'akari@example.com'
            );

            echo "ユーザー作成に成功しました！<br>";
            echo "新しいユーザーID: " . $user_id;
        }

        catch (\SimpleUserUpdateException $e) {
            echo "ユーザー作成に失敗（SimpleUserUpdateException）: "
                 . $e->getMessage();
        }

        catch (\Exception $e) {
            echo "予期しないエラーが発生しました: "
                 . $e->getMessage();
        }
    }
}
