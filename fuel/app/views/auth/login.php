<h2>ログイン</h2>

<?php echo Form::open(array('action' => 'auth/login', 'class' => 'form-horizontal')); ?>
    <div class="form-group">
        <?php echo Form::label('ユーザー名', 'username', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo Form::input('username', Input::post('username', ''), array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo Form::label('パスワード', 'password', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo Form::password('password', '', array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="controls">
            <?php echo Form::submit('submit', 'ログイン', array('class' => 'btn btn-primary')); ?>
        </div>
    </div>
<?php echo Form::close(); ?>

<?php if (Session::get_flash('error')): ?>
    <p style="color: red;"><?php echo Session::get_flash('error'); ?></p>
<?php endif; ?>
<?php if (Session::get_flash('success')): ?>
    <p style="color: green;"><?php echo Session::get_flash('success'); ?></p>
<?php endif; ?>
