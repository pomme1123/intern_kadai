<h2>新しい本の登録</h2>

<?php echo Form::open(['action' => 'book/create', 'method' => 'post']); ?>
<?php echo Form::csrf(); ?>
<p>
    <?php echo Form::label('タイトル', 'title'); ?><br>
    <?php echo Form::input('title', Input::post('title'), [
        'class' => 'form-control',
        'placeholder' => '本のタイトルを入力',
        'required' => 'required'
    ]); ?>
</p>

<p>
    <?php echo Form::label('感想', 'impression'); ?><br>
    <?php echo Form::textarea('impression', Input::post('impression'), [
        'class' => 'form-control',
        'rows' => 4,
        'placeholder' => '感想やメモを入力'
    ]); ?>
</p>

<p>
    <?php echo Form::label('読了日', 'finished_at'); ?><br>
    <?php echo Form::input('finished_at', Input::post('finished_at'), [
        'class' => 'form-control',
        'type' => 'date'
    ]); ?>
</p>

<p>
    <?php echo Form::submit('submit', '登録', [
        'class' => 'btn btn-primary'
    ]); ?>
</p>

<?php echo Form::close(); ?>

<hr>

<p><a href="/book">← 本の一覧に戻る</a></p>

<?php if (Session::get_flash('error')): ?>
    <div class="alert alert-danger">
        <?php echo implode('<br>', (array) Session::get_flash('error')); ?>
    </div>
<?php endif; ?>
