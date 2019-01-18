@component('mail::message')

请点击此按钮以确定修改账户邮箱：

@component('mail::button', ['url' => $user->geValidateMailLink()])
    确定验证
@endcomponent

Thanks,<br>
{{ config('app.name') }}

@endcomponent