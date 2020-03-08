@extends('layouts.app')

@section('content')
<header class="jumbotron my-4"></header>
{{-- https://bootsnipp.com/snippets/5Moza --}}
<div class="container py-2">

    <div class="row my-2">

        <!-- edit form column -->

        <div class="col-lg-4">

            <h2 class="text-center font-weight-light">User Profile</h2>

        </div>

        <div class="col-lg-8 ">

            {{-- <div class="alert alert-info alert-dismissable"> <a class="panel-close close" data-dismiss="alert">×</a> This is an <strong>.alert</strong>. Use this to show important messages to the user. </div> --}}

        </div>

        <div class="col-lg-8 order-lg-1 personal-info">

            <form role="form">

                <div class="form-group row">

                    <label class="col-lg-3 col-form-label form-control-label">First name</label>

                    <div class="col-lg-9">

                        <input class="form-control" type="text" value="Jane" />

                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-lg-3 col-form-label form-control-label">Last name</label>

                    <div class="col-lg-9">

                        <input class="form-control" type="text" value="Bishop" />

                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-lg-3 col-form-label form-control-label">Email</label>

                    <div class="col-lg-9">

                        <input class="form-control" type="email" value="email@gmail.com" />

                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-lg-3 col-form-label form-control-label">Company</label>

                    <div class="col-lg-9">

                        <input class="form-control" type="text" value="" />

                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-lg-3 col-form-label form-control-label">Website</label>

                    <div class="col-lg-9">

                        <input class="form-control" type="url" value="" />

                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-lg-3 col-form-label form-control-label">Address</label>

                    <div class="col-lg-9">

                        <input class="form-control" type="text" value="" placeholder="Street" />

                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-lg-3 col-form-label form-control-label"></label>

                    <div class="col-lg-6">

                        <input class="form-control" type="text" value="" placeholder="City" />

                    </div>

                    <div class="col-lg-3">

                        <input class="form-control" type="text" value="" placeholder="State" />

                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-lg-3 col-form-label form-control-label">Time Zone</label>

                    <div class="col-lg-9">

                        <select id="user_time_zone" class="form-control" size="0">

                            <option value="Hawaii">(GMT-10:00) Hawaii</option>

                            <option value="Alaska">(GMT-09:00) Alaska</option>

                            <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>

                            <option value="Arizona">(GMT-07:00) Arizona</option>

                            <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>

                            <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00) Central Time (US &amp; Canada)</option>

                            <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>

                            <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>

                        </select>

                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-lg-3 col-form-label form-control-label">Username</label>

                    <div class="col-lg-9">

                        <input class="form-control" type="text" value="janeuser" />

                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-lg-3 col-form-label form-control-label">Password</label>

                    <div class="col-lg-9">

                        <input class="form-control" type="password" value="11111122333" />

                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-lg-3 col-form-label form-control-label">Confirm password</label>

                    <div class="col-lg-9">

                        <input class="form-control" type="password" value="11111122333" />

                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-lg-9 ml-auto text-right">

                        <input type="reset" class="btn btn-outline-secondary" value="Cancel" />

                        <input type="button" class="btn btn-primary" value="Save Changes" />

                    </div>

                </div>

            </form>

        </div>

        <div class="col-lg-4 order-lg-0 text-center">

            <img src="//api.adorable.io/avatars/120/trickst3r.png" class="mx-auto img-fluid rounded-circle" alt="avatar" />

            <h6 class="my-4">Upload a new photo</h6>

            <div class="input-group px-lg-4">

                <div class="custom-file">

                    <input type="file" class="custom-file-input" id="inputGroupFile02">

                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>

                </div>

                <div class="input-group-append">

                    <button class="btn btn-secondary"><i class="fa fa-upload"></i></button>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection
