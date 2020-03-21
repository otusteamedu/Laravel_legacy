@extends('plain.layout')

@section('header-styles')
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.arcticmodal-0.3.css">
    <link rel="stylesheet" href="css/badum.css">
    <link rel="stylesheet" href="css/base-laravel-style.css">
@endsection

@section('header-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/jquery.arcticmodal-0.3.min.js"></script>
    <script src="js/inputmask.min.js"></script>
    <script src="https://yastatic.net/share2/share.js" async="async"></script>
    <script src="js/badum.js"></script>
@endsection

@section('title')
    Публичная оферта
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Публичная оферта</h1>
                @include('plain.blocks.header-sub')
            </div>
            <div class="content">
                <div class="offer-text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et ipsum venenatis ligula hendrerit
                    finibus a non lorem. Mauris molestie a quam nec ullamcorper. Morbi vitae auctor nisi. Nunc rhoncus
                    sit amet metus et aliquam. Fusce gravida molestie sagittis. Maecenas ex nulla, suscipit nec placerat
                    non, auctor nec neque. Phasellus aliquam rutrum neque, vel auctor ligula imperdiet vel. Proin mattis
                    porttitor viverra. Sed pretium condimentum accumsan. Donec lacus libero, varius eget mauris sit
                    amet, vulputate varius velit. Sed rutrum arcu quis eros feugiat viverra.

                    Sed ex diam, viverra tincidunt ligula sit amet, feugiat semper arcu. Curabitur placerat orci turpis,
                    eu tempus diam suscipit ac. Nam eu mauris pulvinar, mattis leo vulputate, convallis orci. Cras
                    sagittis, felis in bibendum commodo, felis dui congue velit, nec euismod nibh elit volutpat turpis.
                    Ut quis mauris feugiat, tempus metus quis, ornare magna. Duis faucibus efficitur ex, ac ullamcorper
                    felis faucibus vitae. Pellentesque fringilla dolor ut est dapibus condimentum. Vivamus vitae neque
                    non lacus finibus tincidunt non ut leo. Sed vehicula, massa vel pretium suscipit, turpis velit
                    fringilla orci, eget vestibulum nulla arcu vitae magna. Duis facilisis lorem fringilla velit
                    pellentesque, id pulvinar lectus accumsan.

                    Aliquam quis erat interdum, viverra quam quis, lacinia enim. Vivamus luctus massa erat, sed viverra
                    purus congue eget. Sed blandit, nunc non elementum dignissim, eros nunc dictum arcu, vel vestibulum
                    augue erat nec leo. Vivamus a enim pulvinar, ornare neque ut, pellentesque lorem. Phasellus sem
                    felis, laoreet vel blandit aliquam, volutpat at lacus. Etiam ornare, est a porttitor fermentum,
                    lectus orci iaculis augue, sed consectetur tellus lectus id odio. Donec at interdum nulla. Aliquam
                    aliquet nisl id neque ullamcorper, nec iaculis diam ultrices. Proin dignissim semper euismod.
                    Praesent vel nulla cursus, fringilla nisl sit amet, ornare nisi. Nunc pharetra, diam in bibendum
                    aliquam, dolor felis porta lorem, eu dictum enim sapien molestie metus.

                    Nulla maximus consectetur neque at lobortis. Aliquam quis suscipit neque. Donec ultricies porta
                    libero rutrum cursus. Pellentesque et tempor erat, et tempor urna. Duis egestas felis nec ligula
                    euismod dictum. Mauris in lacinia felis. Praesent tempor nunc non aliquam placerat. Vestibulum
                    consectetur augue at felis tincidunt, eget sodales nisi egestas. Aliquam erat volutpat. Donec in
                    tristique elit, vitae porta nunc.

                    Phasellus sagittis, tellus id ultrices pharetra, ante arcu pellentesque leo, in tincidunt odio lacus
                    id lectus. Aenean sollicitudin placerat dolor, a efficitur lectus euismod ullamcorper. Nulla
                    facilisi. Mauris sed ipsum elit. Nulla dui turpis, fringilla ut velit sed, facilisis mattis diam.
                    Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque quis
                    semper dolor. Praesent nec nisi blandit, placerat mi non, aliquet lectus. Maecenas lorem tortor,
                    pharetra quis metus non, posuere viverra lacus.
                </div>
            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
