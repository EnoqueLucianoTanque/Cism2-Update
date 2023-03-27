<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{route('user.index')}}"><strong>Kunona</strong></a>

    <div id="sideNav" href="">
        <i class="fa fa-bars icon"></i>
    </div>
</div>

<ul class="nav navbar-top-links navbar-right">

    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
            </li>
{{--            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>--}}
{{--            </li>--}}
            <li class="divider"></li>
            <li><a href="{{route('do_logout')}}"><i class="fa fa-sign-out fa-fw"></i> Sair da Conta</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
