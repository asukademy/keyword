{{-- Part of keyword project. --}}
@extends('_global.html')

@section('siteTitle')
{{{ $url }}} 在關鍵字「{{{ $keyword }}}」的搜尋排名 | Google： {{{ $result->google }}} - Yahoo： {{{ $result->yahoo }}}
@stop

@section('meta')
<meta name="description" content="網址 {{{ $url }}} 在關鍵字「{{{ $keyword }}}」的搜尋排名，Google：{{{ $result->google }}} ，Yahoo：{{{ $result->yahoo }}}。" />
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

                <h4>查詢結果</h4>

                <p>以下為搜尋引擎排名，顯示 0 表示關鍵字查無搜尋結果或不在前 100 名內。 前往此網址: <a target="_blank" href="http://{{{ $url }}}" rel="nofollow">{{{ $url }}}</a></p>

                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td width="15%">
                            <img width="16" src="{{{ $uri['media.path'] }}}images/google-icon.png" alt="Google icon" />
                            Google
                        </td>
                        <td>
                            <span class="lead {{{ $googleText }}}">
                                <strong>{{{ $result->google }}}</strong>
                            </span>
                        </td>
                        <td>
                            <a target="_blank" href="{{{ $googleUrl }}}">前往搜尋結果 <span class="glyphicon glyphicon-new-window"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img width="16" src="{{{ $uri['media.path'] }}}images/yahoo-icon.ico" alt="Yahoo icon" />
                            Yahoo
                        </td>
                        <td>
                            <span class="lead {{{ $yahooText }}}">
                                <strong>{{{ $result->yahoo }}}</strong>
                            </span>
                        </td>
                        <td>
                            <a target="_blank" href="{{{ $yahooUrl }}}">前往搜尋結果 <span class="glyphicon glyphicon-new-window"></span></a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <h4>本結果分享網址</h4>
                <pre>{{{ $uri['current'] }}}</pre>
                <div class="addthis_sharing_toolbox"></div>

            </form>

            <hr />

            <p class="text-warning">
                查詢結果以主機所在位置向搜尋引擎請求的結果為準，且不包含個人 google 記錄加權，因此會與您用瀏覽器查詢的結果稍有不同喔。
                搜尋引擎皆使用 tw 語系而非國際版，因此對於中文世界的排名有一定程度參考價值
            </p>

            <p class="text-danger">
                Google 有查詢流量控管，請不要密集大量查詢，這樣會造成其他人也無法使用喔
            </p>
        </div>
    </div>

    {{--AddThis--}}
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4d7f6648467b99e4" async="async"></script>

@stop