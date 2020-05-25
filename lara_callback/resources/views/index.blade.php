<!-- load jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="../css/callback.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<button class="callme-button" data-toggle="modal" data-target="#callme-modal"><span class="glyphicon glyphicon-earphone"></span></button>

<!-- Modal -->
<div class="modal fade" id="callme-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Обратный звонок</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <form class="callme-form" >
                    @csrf
                    <div class="form-group">
                        <label for="callme_name">Ваше имя</label>
                        <input type="text" name="callme_name"  id = "callme_name" class="form-control" placeholder="Ваше имя" required="">
                    </div>
                    <div class="form-group">
                        <label for="callme_phone">Телефон</label>
                        <input type="text" name="callme_phone" id="callme_phone" class="form-control" placeholder="Телефон" required="">
                    </div>
                    <button type="submit" class="btn btn-default">Отправить</button>
                </form>
            </div>
            <div class="modal-footer text-center">
            </div>
        </div>
    </div>
</div>

<script src="../js/callback.js"></script>