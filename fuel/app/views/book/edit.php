<h2>本の情報を編集</h2>

<?php echo Form::open(['action' => 'book/edit/'.$book->id, 'method' => 'post']); ?>
<?php echo Form::csrf(); ?>
<p>
    <?php echo Form::label('タイトル', 'title'); ?><br>
    <?php echo Form::input('title', Input::post('title', $book->title), ['class' => 'form-control']); ?>
</p>

<p>
    <?php echo Form::label('感想', 'impression'); ?><br>
    <?php echo Form::textarea('impression', Input::post('impression', $book->impression), ['class' => 'form-control']); ?>
</p>

<p>
    <?php echo Form::label('読了日', 'finished_at'); ?><br>
    <?php echo Form::input('finished_at', Input::post('finished_at', $book->finished_at), ['class' => 'form-control', 'type' => 'date']); ?>
</p>

<p><?php echo Form::submit('submit', '更新', ['class' => 'btn btn-success']); ?></p>

<?php echo Form::close(); ?>

<p><a href="/book" class="btn btn-secondary">← 一覧に戻る</a></p>

