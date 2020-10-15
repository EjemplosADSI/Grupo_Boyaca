<footer class="main-footer">
    <div class="content py-0">
        <div class="row font-size-sm">
            <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-right">
                Creado con <i class="fa fa-fire text-warning"></i> - <b>Version</b> {{ env("APP_VERSION", "") }}
                @yield('footer')
            </div>
            <div class="col-sm-6 order-sm-1 text-center text-sm-left">
                Copyright  <a class="font-w600" href="http://esiga.info" target="_blank"><strong>{{ config('app.name') }}</strong></a> &copy; <span data-toggle="year-copy">{{ date('Y') }}</span>  - <a class="font-w600" href="" target="_blank"> Términos y Condiciones</a>
            </div>
        </div>
    </div>
</footer>
