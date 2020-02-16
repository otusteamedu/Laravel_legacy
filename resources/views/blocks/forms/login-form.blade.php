@php(
    $formFields = [
    'name' => [
        'name' => 'user_name',
        'type' => 'text',
        'title' => 'messages.page_reg.form.name',
    ],
    'email' => [
        'name' => 'user_email',
        'type' => 'email',
        'title' => 'messages.page_reg.form.email',
    ],
    'password' => [
        'name' => 'user_password',
        'type' => 'text',
        'title' => 'messages.page_reg.form.password',
    ],
    'confirm_password' => [
        'name' => 'confirm_password',
        'type' => 'text',
        'title' => 'messages.page_reg.form.confirm_password',
    ],
])
{{ Form::open() }}
    @each('blocks.forms.field', $formFields, 'field')
    @include('blocks.forms.btn-submit', ['buttonTitle' => 'messages.page_reg.form.submit_button'])
{{ Form::close() }}
