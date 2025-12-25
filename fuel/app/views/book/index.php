
<p><a href="/book/create" class="btn btn-primary">新しい本を登録</a></p>

<table class="table table-striped">
    <thead>
        <tr>
            <th>タイトル</th>
            <th>読了日</th>
            <th>感想</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($books): ?>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?php echo e($book->title); ?></td>
                    <td><?php echo e($book->finished_at); ?></td>
                    <td><?php echo e($book->impression); ?></td>
                    <td>
                        <a href="/book/edit/<?php echo $book->id; ?>" class="btn btn-warning btn-sm">編集</a>
                        <button type="button" class="btn btn-danger delete-book" data-id="<?= $book->id ?>">
                            削除
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">まだ登録された本はありません。</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<script src="/assets/js/delete.js"></script>
