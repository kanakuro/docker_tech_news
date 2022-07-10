<div class="news_menu">
    <div class="fav_list">
        <button class="to_fav_list">お気に入り</button>
    </div>
    <div class="news_list">
        <button class="to_news_list">ニュース一覧</button>
    </div>
</div>
<div class="field">
    @foreach($news as $data)
    <div class="data_body" id="data_body_0{{$loop->index}}">
        <div class="card_body" id="card_body_0{{$loop->index}}">
            <h3 class="card_title" id="card_title_0{{$loop->index}}">
                <a href="{{$data['url']}}" target="_blank" rel="noopener noreferrer">{{$data['name']}}</a>
            </h3>
            <div class="card_text" id="card_text_0{{$loop->index}}">
                <img src="{{$data['thumbnail']}}" class="news_thumbnail">
            </div>
        </div>
        <div class="favorite_area">
            @if($data['fav'] == 0)
                <div class="favorite" id="favorite_0{{$loop->index}}">
                    <img src="../img/heart.png" class="favorite_icon" title="お気に入り登録">
                </div>
                <div class="favorite_after" id="favorite_after_0{{$loop->index}}" style="display:none;">
                    <img src="../img/heart_red.png" class="favorite_icon" title="お気に入り解除">
                </div>
            @elseif($data['fav'] == 1)
                <div class="favorite" id="favorite_0{{$loop->index}}" style="display:none;">
                    <img src="../img/heart.png" class="favorite_icon" title="お気に入り登録">
                </div>
                <div class="favorite_after" id="favorite_after_0{{$loop->index}}">
                    <img src="../img/heart_red.png" class="favorite_icon" title="お気に入り解除">
                </div>
            @endif
        </div>
        <div class="share_area">
            <div class="share" title="Slack送信">
            </div>
            <div class="share_active">
                <img src="../img/share_blue.png" class="share_icon">
            </div>
        </div>
    </div>
    @endforeach
    <div class="fav_data_body" style="display:none;">
        <div class="clone_fav" id="original">
            <div class="fav_card_body">
                <h3 class="fav_card_title">
                    <a href="" target="_blank" rel="noopener noreferrer"></a>
                </h3>
                <div class="fav_card_text">
                    <img src="" class="news_thumbnail">
                </div>
            </div>
            <div class="favorite_area">
                <div class="favorite" style="display:none;">
                    <img src="../img/heart.png" class="favorite_icon" title="お気に入り登録">
                </div>
                <div class="favorite_after">
                    <img src="../img/heart_red.png" class="favorite_icon" title="お気に入り解除">
                </div>
            </div>
            <div class="share_area">
                <div class="share" title="Slack送信">
                </div>
                <div class="share_active">
                    <img src="../img/share_blue.png" class="share_icon">
                </div>
                </div>
        </div>
    </div>
</div>
