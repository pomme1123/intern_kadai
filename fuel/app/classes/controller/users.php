<?php

use Fuel\Core\Controller;
use Fuel\Core\Input;
use Fuel\Core\Response;
use Fuel\Core\Session;
use Fuel\Core\View;
use Auth\Auth;

class Controller_Users extends Controller
{
    public function action_signup()
    {
        if (Input::method() == 'POST')
        {
            $username  = Input::post('username');
            $password  = Input::post('password');
            $email     = Input::post('email');

            if (empty($username) || empty($password) || empty($email))
            {
                Session::set_flash('error', '全ての項目を入力してください。');
            }
            else
            {
                try {
                    Auth::create_user($username, $password, $email, 1);
                    Session::set_flash('success', '登録が完了しました！ログインしてください。');
                    Response::redirect('users/login');
                } catch (\Exception $e) {
                    Session::set_flash('error', '登録に失敗しました: ' . $e->getMessage());
                }
            }
        }

        return Response::forge(View::forge('users/signup'));
    }

    public function action_login()
    {
        if (Input::method() == 'POST')
        {
            $username  = Input::post('username');
            $password  = Input::post('password');

            if (Auth::login($username, $password))
            {
                Session::set_flash('success', 'ログイン成功！');
                Response::redirect('book/dashboard');
            }
            else
            {
                Session::set_flash('error', 'ユーザー名またはパスワードが間違っています。');
            }
        }

        return Response::forge(View::forge('users/login'));
    }
        /**
        * ログアウト処理
         */
        public function action_logout()
        {
            // ログアウト実行
            \Auth::logout();

            // セッションにメッセージを表示
            \Session::set_flash('success', 'ログアウトしました。');

            // ログインページへリダイレクト
            \Response::redirect('users/login');
        }
    

}

