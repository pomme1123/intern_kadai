<h2>ユーザー登録</h2>

<?php echo Form::open(['action' => 'users/signup', 'method' => 'post']); ?>

<p>
    <?php echo Form::label('ユーザー名', 'username'); ?><br>
    <?php echo Form::input('username', Input::post('username'), [
        'class' => 'form-control',
        'placeholder' => '例：akari123',
        'required' => 'required'
    ]); ?>
</p>

<p>
    <?php echo Form::label('メールアドレス', 'email'); ?><br>
    <?php echo Form::input('email', Input::post('email'), [
        'class' => 'form-control',
        'type' => 'email',
        'placeholder' => '例：sample@example.com',
        'required' => 'required'
    ]); ?>
</p>

<p>
    <?php echo Form::label('パスワード', 'password'); ?><br>
    <?php echo Form::password('password', '', [
        'class' => 'form-control',
        'placeholder' => 'パスワードを入力',
        'required' => 'required'
    ]); ?>
</p>

<p>
    <?php echo Form::submit('submit', '登録', [
        'class' => 'btn btn-primary'
    ]); ?>
</p>

<?php echo Form::close(); ?>

<hr>

<p>すでにアカウントをお持ちの方は、<a href="/users/login">こちらからログイン</a></p>
