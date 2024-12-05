@extends('layouts.app')

@section('top_nav')
    @include('navigation.top_menu')
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('images/author.jpg') }}" class="avatar">
                    </div>
                    <div class="col-md-8">
                        <form>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <div class="input-group">
                                    <input readonly type="text" class="form-control" id="name">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text edit_link edit_name" data-toggle="modal" data-target="#edit_name">edit</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input readonly type="email" class="form-control" id="email">
                            </div>

                            <div class="form-group">
                                <label for="name">Phone</label>
                                <div class="input-group">
                                    <input readonly type="text" class="form-control" id="phone">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text edit_link edit_phone" data-toggle="modal" data-target="#edit_phone">edit</div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#edit_password">Change password</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal edit name --}}
    <div class="modal" tabindex="-1" role="dialog" id="edit_name">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form>
                        @csrf
                        <input name="user_id" type="hidden">
                        <div class="modal-body">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="stage">Name</label>
                                    <input class="form-control" name="name" value="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End modal edit name--}}

    {{-- Modal edit phone --}}
    <div class="modal" tabindex="-1" role="dialog" id="edit_phone">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change phone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form>
                        @csrf
                        <input name="user_id" type="hidden">
                        <div class="modal-body">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="stage">Phone</label>
                                    <input class="form-control" name="phone" value="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End modal edit phone--}}

    {{-- Modal edit phone --}}
    <div class="modal" tabindex="-1" role="dialog" id="edit_password">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change passwod</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form>
                        @csrf
                        <input name="user_id" type="hidden">

                        <div class="form-group">
                            <label for="stage">Current password</label>
                            <input type="password" class="form-control" name="current_password" value="">
                        </div>

                        <div class="form-group">
                            <label for="stage">New password</label>
                            <input type="password" class="form-control" name="password" value="">
                        </div>

                        <div class="form-group">
                            <label for="stage">Confirm password</label>
                            <input type="password" class="form-control" name="confirm_password" value="">
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End modal edit phone--}}

@endsection

@section('footer')
    @include('layouts.footer')
@endsection


