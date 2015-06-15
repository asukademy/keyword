{{-- Part of keyword project. --}}
@extends('_global.html')

@section('body')
    <div class="container">
        <div class="row">
            <form action="{{{ $action }}}" name="adminForm" method="post" enctype="multipart/form-data" class="form-horizontal">

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
                        <input type="url" name="url" class="form-control" id="urlInput" value="{{{ $url }}}" placeholder="欲查詢的網址">
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