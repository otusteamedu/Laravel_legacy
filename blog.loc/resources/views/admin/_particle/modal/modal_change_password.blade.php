<div class="modal fade" id="modalChangePassword" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDeleteModalLabel">Изменение пароля</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.users.changePassword', ['id' => $user->id]) }}">
                    @csrf
                    <input name="id" type="hidden" value="{{ $user->id }}">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Пароль">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Повторите пароль</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Повторите пароль">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                <button type="button" class="btn btn-primary send_modal_form">Да</button>
            </div>
        </div>
    </div>
</div>