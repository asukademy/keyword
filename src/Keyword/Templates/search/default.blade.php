{{-- Part of keyword project. --}}
@extends('_global.html')

@section('body')
    <div class="container">
        <div class="row">
            <form action="{{{ $action }}}" name="adminForm" method="post" enctype="multipart/form-data" class="form-horizontal">

                <h2>Google / Yahoo 關鍵字排名查詢</h2>

                <p>
                    本工具可協助你快速查詢你的網站在 Yahoo , Google 主要搜尋引擎的關鍵字排行,若只輸入網址,可以查詢Google Page Rank
                    排名以繁體中文網站為主 ,搜尋結果100名以外顯示為0, 請在下列欄位輸入網站網址及欲查詢的關鍵字
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
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">查詢</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop