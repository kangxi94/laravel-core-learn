@if (session('status'))
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('status') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('error') }}
    </div>
@endif
@auth
    @if(Auth::user()->is_validate == 0 && !session('confirm'))
        <div class="alert alert-warning alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            邮箱未激活，请前往 {{ Auth::user()->email }} 查收激活邮件。未收到邮件？请前往 <a href="{{ Auth::user()->getSendConfirmMailLink() }}" class="alert-link">重新发送>></a> 。
        </div>
    @endif
@endguest

