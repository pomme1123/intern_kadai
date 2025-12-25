document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".delete-book");

    buttons.forEach(btn => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;

            if (!confirm("本当に削除しますか？")) return;

            fetch("/book/delete_json", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `id=${id}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.closest("tr").remove();
                } else {
                    alert("削除に失敗しました：" + data.error);
                }
            })
            .catch(() => {
                alert("通信エラーが発生しました。");
            });
        });
    });
});
