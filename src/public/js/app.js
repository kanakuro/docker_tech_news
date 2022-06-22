// require("./bootstrap");

$(function () {
    $(".favorite").click(function () {
        // 表示
        var fav_id = $(this).attr("id").slice(9, 11);
        $("#favorite_" + fav_id).hide();
        $("#favorite_after_" + fav_id).show();
        let favOrNews = $(this).parent().attr("class");
        if (favOrNews == "clone_fav") {
            fav_url = $("#fav_card_title_" + fav_id)
                .find("a")
                .attr("href");
            fav_title = $("#fav_card_title_" + fav_id)
                .find("a")
                .text();
            fav_image_url = $("#fav_card_text_" + fav_id)
                .find("img.news_thumbnail")
                .attr("src");
        } else if (favOrNews == "data_body") {
            fav_url = $("#card_title_" + fav_id)
                .find("a")
                .attr("href");
            fav_title = $("#card_title_" + fav_id)
                .find("a")
                .text();
            fav_image_url = $("#card_text_" + fav_id)
                .find("img.news_thumbnail")
                .attr("src");
        }
        // お気に入り登録
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/post_favorite",
            type: "GET",
            data: {
                //サーバーに送信するデータ
                title: fav_title,
                url: fav_url,
                img_url: fav_image_url,
            },
            success: function (data) {},
            error: function (err) {},
        });
    });

    $(".favorite_after").click(function () {
        // 表示
        var fav_id = $(this).attr("id").slice(15, 17);
        var user_id = 99;
        $("#favorite_" + fav_id).show();
        $("#favorite_after_" + fav_id).hide();
        // お気に入り論理削除
        let favOrData = $(this).parent().attr("class");
        if (favOrData == "clone_fav") {
            fav_url = $("#fav_card_title_" + fav_id)
                .find("a")
                .attr("href");
            fav_title = $("#fav_card_title_" + fav_id)
                .find("a")
                .text();
            fav_image_url = $("#fav_card_text_" + fav_id)
                .find("img.news_thumbnail")
                .attr("src");
        } else if (favOrData == "data_body") {
            fav_url = $("#card_title_" + fav_id)
                .find("a")
                .attr("href");
            fav_title = $("#card_title_" + fav_id)
                .find("a")
                .text();
            fav_image_url = $("#card_text_" + fav_id)
                .find("img.news_thumbnail")
                .attr("src");
        } else {
            return;
        }
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/invalid_favorite",
            type: "GET",
            data: {
                //サーバーに送信するデータ
                user_id: user_id,
                title: fav_title,
                url: fav_url,
                img_url: fav_image_url,
            },
            success: function (data) {},
            error: function (err) {},
        });
    });

    $(".to_fav_list").click(function () {
        var user_id = 99;
        // お気に入り画面へ遷移
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/get_favorite",
            type: "GET",
            data: {
                //サーバーに送信するデータ
                user_id: user_id,
            },
            success: function (data) {
                $("div.data_body").hide();
                $("div.fav_data_body").show();
                $.each(data, function (index, fav) {
                    cloneFav(index);
                    $("#fav_card_title_9" + index)
                        .find("a")
                        .attr("href", fav.news_url);
                    $("#fav_card_title_9" + index)
                        .find("a")
                        .text(fav.news_title);
                    $("#fav_card_text_9" + index)
                        .find("img")
                        .attr("src", fav.image_url);
                });
                $("#original").remove();
            },
            error: function (err) {},
        });
    });

    $(".to_news_list").click(function () {
        // 画面をリロード
        location.reload();
    });

    function cloneFav(index) {
        cloned_card = $("#original").clone(true);
        cloned_card.appendTo(".fav_data_body");
        cloned_card.attr("id", "fav_9" + index);
        cloned_card
            .find(".fav_card_body")
            .attr("id", "fav_card_body_9" + index);
        cloned_card
            .find(".fav_card_title")
            .attr("id", "fav_card_title_9" + index);
        cloned_card
            .find(".fav_card_text")
            .attr("id", "fav_card_text_9" + index);
        cloned_card.find(".favorite").attr("id", "favorite_9" + index);
        cloned_card
            .find(".favorite_after")
            .attr("id", "favorite_after_9" + index);
    }
});
