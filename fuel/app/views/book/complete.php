<h2>📚 登録が完了しました！</h2>

<p>「<?php echo e($book->title); ?>」を追加しました。</p>

<div style="margin-top: 20px;">
    <?php echo Html::anchor('book/create', '➕ さらに追加する', [
        'class' => 'btn btn-success'
    ]); ?>

    <?php echo Html::anchor('book', '📖 一覧に戻る', [
        'class' => 'btn btn-primary',
        'style' => 'margin-left: 10px;'
    ]); ?>
</div>
