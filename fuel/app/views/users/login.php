<h2>ログイン</h2>

<?php echo Form::open('users/login'); ?>

<p>
    <?php echo Form::label('ユーザー名', 'username'); ?><br>
    <?php echo Form::input('username'); ?>
</p>

<p>
    <?php echo Form::label('パスワード', 'password'); ?><br>
    <?php echo Form::password('password'); ?>
</p>




<p>
    <?php echo Form::submit('submit', 'ログイン'); ?>
</p>

<?php echo Form::close(); ?>

<?php if (Session::get_flash('error')): ?>
    <p style="color: red;"><?php echo Session::get_flash('error'); ?></p>
<?php endif; ?>

<?php if (Session::get_flash('success')): ?>
    <p style="color: green;"><?php echo Session::get_flash('success'); ?></p>
<?php endif; ?>

