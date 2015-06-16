{{-- Part of keyword project. --}}
@extends('_global.html')

@section('siteTitle')
網址: {{{ $url }}} - 關鍵字: {{{ $keyword }}} | Google / Yahoo 關鍵字排名查詢
@stop

@section('meta')
<meta name="description" content="用 [{{{ $keyword }}}] 搜尋 {{{ $url }}} 的查詢結果，Google 排名：{{{ $result->google }}} ，Yahoo排名：{{{ $result->yahoo }}}。" />
@stop

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
                        <input type="text" name="url" class="form-control" id="urlInput" value="{{{ $url }}}" placeholder="欲查詢的網址">
                    </div>
                </div>
                <div class="form-group">
                    <div class="g-recaptcha col-md-offset-2 col-md-10" data-sitekey="6Lc0aggTAAAAAAzpAmFMKhTG7Z7UsHdu1r-TZAuv"></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">再次查詢</button>
                    </div>
                </div>

                <hr />

                <p>以下為搜尋引擎排名，顯示 0 表示關鍵字查無搜尋結果或不在前 100 名內。</p>

                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td width="15%">
                            <img width="16" src="{{{ $uri['media.path'] }}}images/google-icon.png" alt="Google icon" />
                            Google
                        </td>
                        <td>{{{ $result->google }}}</td>
                    </tr>
                    <tr>
                        <td>
                            <img width="16" src="{{{ $uri['media.path'] }}}images/yahoo-icon.ico" alt="Yahoo icon" />
                            Yahoo
                        </td>
                        <td>{{{ $result->yahoo }}}</td>
                    </tr>
                    </tbody>
                </table>

                <p>前往此網址: <a target="_blank" href="http://{{{ $url }}}" rel="nofollow">{{{ $url }}}</a></p>
            </form>
        </div>
    </div>
@stop