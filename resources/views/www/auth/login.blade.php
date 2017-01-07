@extends('www.layouts.full_screen')


@section('contents')
    <div id="auth_container">
        <div id="auth_form">
            <form action="/auth/login" method="post">
                {{ csrf_field() }}
                <p class="site_label">{{ $site_label }}</p>
                <div class="auth_input">
                    <div id="login_account">
                        <input type="text" name="account" placeholder="Email Address">
                    </div>
                    <div id="login_pwd">
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    <div id="login_button">
                        <input type="submit" value="登陆">
                    </div>
                </div>
            </form>
        </div>
    @include("www.layouts._partial.footer")
    </div>
@stop

@section("modal")
    @parent
    {!!
        ViewHelper::registerJsTemplate([
            'utility.weui_dialog_alert',
            'utility.weui_dialog_confirm',
            'utility.weui_toast_ok',
            'utility.weui_toast_loading',
        ])
    !!}
    {!! ViewHelper::registerRequirejs('app/homepage') !!}
@stop
