<footer class="footer">
    <div class="row">
        <div class="col-md-4">
            @include('widgets.widgets_menu')
        </div>
        {{-- TODO: widget menu - только передавать будем категрии --}}
        <div class="col-md-4">
            <div class="row widget">
                <h3 class="widget-title">Category</h3>

                <div class="row widget-text">
                    <ul class="widget-nav">
                        <li><a href="#">Laravel</a></li>
                        <li><a href="#">Space</a></li>
                        <li><a href="#">Universe</a></li>
                        <li><a href="#">Infinity</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('widgets.widget_feedback')
        </div>
    </div>
    <div class="row widget">
        Nikolaenkov Roman &copy; 2018-{{ date('Y') }}
    </div>
</footer>