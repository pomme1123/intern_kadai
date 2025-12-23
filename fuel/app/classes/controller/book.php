<?php
use Fuel\Core\Controller_Template;
use Fuel\Core\Response;
use Fuel\Core\Input;
use Fuel\Core\Session;
use Fuel\Core\View;
use Auth\Auth;

class Controller_Book extends Controller_Template
{

    public function before()
    {
        parent::before();

        if(!Auth::check()){
            Response::redirect('users/login');
        }
    }
    public function action_index()
    {
        if (!Auth::check())
        {
            Response::redirect('users/login');
        }

        // ✅ ログイン中のユーザーIDを取得
        $user_id = Auth::get_user_id()[1];

        // ✅ そのユーザーが登録した本だけを取得
        $data['books'] = Model_Book::query()
            ->where('user_id', $user_id)
            ->order_by('finished_at', 'desc')
            ->get();

        $this->template->title = "読んだ本の一覧";
        $this->template->content = View::forge('book/index', $data);
    }
    

    /**
     * 詳細ページ
     */
    public function action_view($id = null)
    {
        if (is_null($id) || !$data['book'] = Model_Book::find($id))
        {
            Session::set_flash('error', '指定された本が見つかりません。');
            Response::redirect('book');
        }

        $this->template->title = "本の詳細";
        $this->template->content = View::forge('book/view', $data);
    }

    /**
     * 新しい本を登録
     */
    public function action_create()
    {
        if (!Auth::check())
        {
            Response::redirect('users/login');
        }

        if (Input::method() == 'POST')
        {
            $val = Model_Book::validate('create');

            if ($val->run())
            {
                $book = Model_Book::forge([
                    'user_id'    => Auth::get_user_id()[1],
                    'title'      => Input::post('title'),
                    'impression' => Input::post('impression'),
                    'finished_at'=> Input::post('finished_at'),
                    'created_at' => time(),
                ]);

                if ($book and $book->save())
                {
                    // 成功したら登録完了ページへ
                    Session::set_flash('success', '本を登録しました！');
                    $this->template->title = "登録完了";
                    $this->template->content = View::forge('book/created');
                    return;
                }
                else
                {
                    Session::set_flash('error', '本の登録に失敗しました。');
                }
            }
            else
            {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = "新しい本の登録";
        $this->template->content = View::forge('book/create');
    }

    /**
     * 編集
     */
    public function action_edit($id = null)
    {
        if (!Auth::check())
        {
            Response::redirect('users/login');
        }

        if (is_null($id) || !$book = Model_Book::find($id))
        {
            Session::set_flash('error', '指定された本が見つかりません。');
            Response::redirect('book');
        }

        $val = Model_Book::validate('edit');

        if ($val->run())
        {
            $book->title = Input::post('title');
            $book->impression = Input::post('impression');
            $book->finished_at = Input::post('finished_at');

            if ($book->save())
            {
                Session::set_flash('success', '本の情報を更新しました。');
                Response::redirect('book');
            }
            else
            {
                Session::set_flash('error', '本の更新に失敗しました。');
            }
        }
        else
        {
            if (Input::method() == 'POST')
            {
                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('book', $book, false);
        }

        $this->template->title = "本の編集";
        $this->template->content = View::forge('book/edit', ['book' => $book]);
    }

    /**
     * 削除
     */
    public function action_delete($id = null)
    {
        if (!Auth::check())
        {
            Response::redirect('users/login');
        }

        if ($book = Model_Book::find($id))
        {
            $book->delete();
            Session::set_flash('success', '本を削除しました。');
        }
        else
        {
            Session::set_flash('error', '指定された本が見つかりません。');
        }

        Response::redirect('book');
    }
    public function action_dashboard()
    {
        if (!Auth::check())
        {
            Response::redirect('users/login');
        }

        $user_id = Auth::get_user_id()[1];
        $count = Model_Book::query()->where('user_id', $user_id)->count();

        $this->template->title = "Dashboard";
        $this->template->content = View::forge('book/dashboard', [
            'count' => $count,
        ]);
    }

}
