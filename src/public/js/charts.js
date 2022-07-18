$(function () {
    $(".send_email").click(function () {
        if (!confirm("グラフの元データをメール送信しますか？")) {
            /* キャンセルの時の処理 */
            return false;
        } else {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: "/send_chart_data",
                type: "GET",
                data: {
                    // title: fav_title,
                    // url: fav_url,
                    // img_url: fav_image_url,
                },
                success: function (data) {
                    alert("メールを送信しました");
                },
                error: function (err) {},
            });
        }
    });
});
