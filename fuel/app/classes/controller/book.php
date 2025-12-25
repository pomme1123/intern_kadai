<?php
use Fuel\Core\Controller_Template;
use Fuel\Core\Response;
use Fuel\Core\Input;
use Fuel\Core\Session;
use Fuel\Core\View;
use Fuel\Core\Validation;
use Fuel\Core\DB;
use Auth\Auth;

class Controller_Book extends Controller_Template
{
    public function before()
    {
        parent::before();

        if (!Auth::check()) {
            Response::redirect('users/login');
        }
    }

    // -------------------------------
    // 本の一覧
    // -------------------------------
    public function action_index()
    {
        $user_id = Auth::get_user_id()[1];

        $data['books'] = Model_Book::query()
            ->where('user_id', $user_id)
            ->order_by('finished_at', 'desc')
            ->get();

        $this->template->title = "読んだ本の一覧";
        $this->template->content = View::forge('book/index', $data);
    }

    // -------------------------------
    // 本の詳細
    // -------------------------------
    public function action_view($id = null)
    {
        $book = Model_Book::find($id);

        if (!$book) {
            Session::set_flash('error', '指定された本が見つかりません。');
            return Response::redirect('book');
        }

        if ($book->user_id != Auth::get_user_id()[1]) {
            Session::set_flash('error', 'この本を見る権限がありません。');
            return Response::redirect('book');
        }

        $this->template->title = "本の詳細";
        $this->template->content = View::forge('book/view', ['book' => $book]);
    }

    // -------------------------------
    // 本の登録
    // -------------------------------
    public function action_create()
    {
        // POST のときだけ保存処理
        if (Input::post()) {

            if (!\Security::check_token()) {
                Session::set_flash('error', '不正なリクエストです（CSRFエラー）');
                Response::redirect('book');
            }

            // Validation（コントローラ側に移動）
            $val = Validation::forge();
            $val->add('title')->add_rule('required');
            $val->add('impression')->add_rule('required');
            $val->add('finished_at')->add_rule('required');

            if (!$val->run()) {
                Session::set_flash('error', $val->error());
                return Response::redirect('book/create');
            }

            // 保存処理
            $book = Model_Book::forge([
                'user_id'     => Auth::get_user_id()[1],
                'title'       => Input::post('title'),
                'impression'  => Input::post('impression'),
                'finished_at' => Input::post('finished_at'),
                'created_at'  => time(),
            ]);

            if ($book->save()) {
                Session::set_flash('success', '本を登録しました！');
                $this->template->title = "登録完了";
                $this->template->content = View::forge('book/created');
                return;
            }

            Session::set_flash('error', '本の登録に失敗しました。');
        }

        // GET のとき → フォーム表示
        $this->template->title = "新しい本の登録";
        $this->template->content = View::forge('book/create');
    }

    // -------------------------------
    // 本の編集
    // -------------------------------
    public function action_edit($id = null)
    {
        $book = Model_Book::find($id);

        if (!$book) {
            Session::set_flash('error', '指定された本が見つかりません。');
            return Response::redirect('book');
        }

        if ($book->user_id != Auth::get_user_id()[1]) {
            Session::set_flash('error', 'この本を編集する権限がありません。');
            return Response::redirect('book');
        }

        // POST のときだけ更新処理
        if (Input::post()) {

            if (!\Security::check_token()) {
                Session::set_flash('error', '不正なリクエストです（CSRFエラー）');
                Response::redirect('book/edit', $id);
            }

            // Validation
            $val = Validation::forge();
            $val->add('title')->add_rule('required');
            $val->add('impression')->add_rule('required');
            $val->add('finished_at')->add_rule('required');

            if (!$val->run()) {
                Session::set_flash('error', $val->error());
                return Response::redirect('book/edit/'.$id);
            }

            // 更新処理
            $book->title       = Input::post('title');
            $book->impression  = Input::post('impression');
            $book->finished_at = Input::post('finished_at');

            if ($book->save()) {
                Session::set_flash('success', '本の情報を更新しました。');
                return Response::redirect('book');
            }

            Session::set_flash('error', '本の更新に失敗しました。');
        }

        // GET のとき
        $this->template->title = "本の編集";
        $this->template->content = View::forge('book/edit', [
            'book' => $book
        ]);
    }

    // -------------------------------
    // 本の削除
    // -------------------------------
    public function action_delete($id = null)
    {
        $book = Model_Book::find($id);

        if (!$book) {
            Session::set_flash('error', '指定された本が見つかりません。');
            return Response::redirect('book');
        }

        if ($book->user_id != Auth::get_user_id()[1]) {
            Session::set_flash('error', 'この本を削除する権限がありません。');
            return Response::redirect('book');
        }

        $book->delete();
        Session::set_flash('success', '本を削除しました。');
        return Response::redirect('book');
    }
    public function post_delete_json()
    {
        if (!Auth::check()) {
            return json_encode(['error' => 'not_logged_in']);
        }

        $id = Input::post('id');
        $book = Model_Book::find($id);

        if (!$book) {
            return json_encode(['error' => 'not_found']);
        }

        // 権限チェック
        if ($book->user_id != Auth::get_user_id()[1]) {
            return json_encode(['error' => 'no_permission']);
        }

        // 削除
        $book->delete();

        return json_encode(['success' => true]);
    }


    // -------------------------------
    // ダッシュボード
    // -------------------------------
    public function action_dashboard()
    {
        $user_id = Auth::get_user_id()[1];

        $count = DB::select(DB::expr('COUNT(*) AS total'))
            ->from('books')
            ->where('user_id', $user_id)
            ->execute()
            ->get('total');

        $this->template->title = "Dashboard";
        $this->template->content = View::forge('book/dashboard', [
            'count' => $count,
        ]);
    }
}
