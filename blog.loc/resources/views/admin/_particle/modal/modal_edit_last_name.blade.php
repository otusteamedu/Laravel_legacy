<div class="modal fade" id="modalLastNameEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userLastNameModalLabel">Редактирование фамилии пользователя</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.users.editLastName', ['id' => $user->id]) }}">
                    @csrf
                    <input name="id" type="hidden" value="{{ $user->id }}">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group">
                        <label for="first_name">Фамилия</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $user->last_name }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary send_modal_form">Сохранить</button>
            </div>
        </div>
    </div>
</div>