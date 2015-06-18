{{-- Part of keyword project. --}}
@extends('_global.html')

@section('body')
    <div class="container">
        <div class="row">
            <form action="{{{ $action }}}" name="adminForm" method="post" enctype="multipart/form-data" class="form-horizontal">

                <h2>Google / Yahoo 關鍵字排名查詢</h2>

                <p>
                    本工具可以快速協助您查詢 Google / Yahoo 的關鍵字排名，輸入您要搜尋的關鍵字以及網址，就能得到排名結果。超過 100 名或查詢不到都會以 0 顯示。
                    如果出現「Something error」表示短期內查詢量太大，請稍後再來查詢
                </p>

                <p class="text-warning">
                    查詢結果以主機所在位置向搜尋引擎請求的結果為準，且不包含個人 google 記錄加權，因此會與您用瀏覽器查詢的結果稍有不同喔。
                    搜尋引擎皆使用 tw 語系而非國際版，因此對於中文世界的排名有一定程度參考價值
                </p>

                <p class="text-danger">
                    Google 有查詢流量控管，請不要密集大量查詢，這樣會造成其他人也無法使用喔
                </p>

                <div class="messages">
                    {{ \Windwalker\Core\View\Helper\ViewHelper::showFlash($flashes) }}
                </div>

                <hr />

                <div class="form-group">
                    <label for="keywordInput" class="col-sm-2 control-label">關鍵字</label>
                    <div class="col-sm-10">
                        <input type="text" name="keyword" class="form-control" id="keywordInput" value="{{{ $keyword }}}" placeholder="欲查詢的關鍵字">
                    </div>
                </div>
                <div class="form-group">
                    <label for="urlInput" class="col-sm-2 control-label">網址</label>
                    <div class="col-sm-10">
                        <input type="text" name="url" class="form-control" id="urlInput" value="{{{ $url }}}" placeholder="欲查詢的網址">
                    </div>
                </div>
                <div class="form-group">
                    <div class="g-recaptcha col-md-offset-2 col-md-10" data-sitekey="6Lc0aggTAAAAAAzpAmFMKhTG7Z7UsHdu1r-TZAuv"></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">查詢</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop