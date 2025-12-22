
<p> <?php echo e(Auth::get_screen_name()); ?> さんがこれまでに読んだ本は <strong><?php echo $count; ?>冊</strong> です。</p>

    <div class="button-container">
        <a href="/book" class="btn btn-primary btn-lg">📚 読んだ本の一覧を見る</a>
        <a href="/book/create" class="btn btn-success btn-lg">➕ 新しい本を登録する</a>
    </div>
</div>

<style>
.mypage {
    text-align: center;
    margin-top: 40px;
}

.button-container {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin-top: 30px;
}

.btn-lg {
    padding: 15px 30px;
    font-size: 1.2rem;
}
</style>
<hr>

<h2>明日読む本リスト</h2>

<input type="text" placeholder="本のタイトル" data-bind="value: newToRead">
<button data-bind="click: addToRead">追加</button>

<ul data-bind="foreach: toReadList">
  <li>
    <span data-bind="text: $data"></span>
    <button data-bind="click: $parent.removeToRead">削除</button>
  </li>
</ul>


<script src="/assets/js/knockout.js"></script>
<script src="/assets/js/toread.js"></script>



