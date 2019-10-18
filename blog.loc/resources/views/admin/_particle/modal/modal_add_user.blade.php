<div class="modal fade" id="modalUserAdd" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userAddModalLabel">Добавление пользователя</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Введите email">
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Пароль">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Повторите пароль</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Повторите пароль">
                    </div>
                    <div class="form-group">
                        <label for="role">Выберите роль</label>
                        <select name="role" class="form-control" id="role">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary send_modal_form">Добавить</button>
            </div>
        </div>
    </div>
</div>