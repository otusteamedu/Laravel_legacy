<div class="col-md-8 blog-main rounded box-shadow bg-white pt-3 align-items-center">
    <div class="col-lg-4" >
        <div class="text-center">
            <img class="rounded-circle" src="/img/avatar.svg" alt="Generic placeholder image" width="140" height="140">
            <h2>{{ Auth::user()->name }}</h2>
        </div>

    </div>
    <p>EMAIL: {{ Auth::user()->email }}</p>
    <p>Дата регистрации: {{ Auth::user()->created_at }}</p>
</div>
