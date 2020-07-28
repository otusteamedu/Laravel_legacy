<div class="modal fade" id="modalUserActivate" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userActivateModalLabel">Активация пользователя</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.users.active') }}">
                    @csrf
                    <input name="id" type="hidden" value="">
                    <input type="hidden" name="_method" value="PATCH">
                    Вы действительно хотите активировать пользователя?
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                <button type="button" class="btn btn-primary send_modal_form">Да</button>
            </div>
        </div>
    </div>
</div>