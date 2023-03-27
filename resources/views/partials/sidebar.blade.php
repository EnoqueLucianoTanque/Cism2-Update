<div class="sidebar-collapse">
    <ul class="nav" id="main-menu">

        <li>
            <a class="{{ (Request::path() == 'admin/farmer') ? 'active-menu' : '' }}" href="{{route('farmer.index')}}"><i class="fa fa-dashboard"></i> Agricultor</a>
        </li>
{{--        <li>--}}
{{--            <a href="{{ route('categoria.index') }}" class="{{ (Request::path() == 'categoria') ? 'active-menu' : '' }}"><i class="fa fa-desktop"></i> Categoria</a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="{{ route('tipo_produto.index') }}" class="{{ (Request::path() == 'tipo_produto') ? 'active-menu' : '' }}"><i class="fa fa-desktop"></i> Tipos de Produto</a>--}}
{{--        </li>--}}

{{--        <li>--}}
{{--            <a href="#" class="{{ (Request::path() == 'cliente') ? 'active-menu' : '' }}">--}}
{{--                <i class="fa fa-sitemap"></i> Clientes<span class="fa arrow"></span>--}}
{{--            </a>--}}
{{--            <ul class="nav nav-second-level">--}}
{{--                <li>--}}
{{--                    <a href="{{ route('cliente.index') }}" >Clientes</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                                        <a href="morris-chart.html">Morris Chart</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}

{{--        <li>--}}
{{--            <a href="{{route('produto.index')}}" class="{{ (Request::path() == 'produto') ? 'active-menu' : '' }}"><i class="fa fa-qrcode"></i> Produtos</a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="#" class="{{ (Request::path() == 'venda'|| Request::path()=='venda' || Request::path()=='venda/create' || Request::path()=='cotacao') ? 'active-menu' : '' }}">--}}
{{--                <i class="fa fa-sitemap"></i> Vendas e Cotações<span class="fa arrow"></span>--}}
{{--            </a>--}}
{{--            <ul class="nav nav-second-level ">--}}
{{--                <li>--}}
{{--                    <a class="{{ (Request::path() == 'venda/create') ? 'active-menu' : '' }}" href="{{ route('venda.create') }}" >Vendas e Cotações</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a class="{{ (Request::path() == 'venda') ? 'active-menu' : '' }}" href="{{ route('venda.index') }}">Listar vendas</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a class="{{ (Request::path() == 'cotacao') ? 'active-menu' : '' }}" href="{{ route('cotacao.index') }}">Listar Cotações</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="#" class="{{ (Request::path() == 'gestao_de_stock' || Request::path()=='transferencia') ? 'active-menu' : '' }}">--}}
{{--                <i class="fa fa-sitemap"></i> Gestão de Stock<span class="fa arrow"></span>--}}
{{--            </a>--}}
{{--            <ul class="nav nav-second-level ">--}}
{{--                <li>--}}
{{--                    <a class="{{ (Request::path() == 'gestao_de_stock') ? 'active-menu' : '' }}" href="{{ route('gestao_stock.index') }}" >Stock</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a class="{{ (Request::path() == 'transferencia') ? 'active-menu' : '' }}" href="{{ route('transferencia.index') }}">Tranferências</a>--}}
{{--                </li>--}}
{{--                                <li>--}}
{{--                                    <a class="{{ (Request::path() == 'cotacao') ? 'active-menu' : '' }}" href="{{ route('cotacao.index') }}">Listar Cotações</a>--}}
{{--                                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}

        <li>
            <a class="{{ (Request::path() == 'admin/user') ? 'active-menu' : '' }}" href="{{ route('user.index') }}"><i class="fa fa-user"></i> Usuários </a>
        </li>
{{--                <li>--}}
{{--                    <a href="table.html"><i class="fa fa-table"></i> Responsive Tables</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="form.html"><i class="fa fa-edit"></i> Forms </a>--}}
{{--                </li>--}}


{{--                <li>--}}
{{--                    <a href="#"><i class="fa fa-sitemap"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>--}}
{{--                    <ul class="nav nav-second-level">--}}
{{--                        <li>--}}
{{--                            <a href="#">Second Level Link</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#">Second Level Link</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#">Second Level Link<span class="fa arrow"></span></a>--}}
{{--                            <ul class="nav nav-third-level">--}}
{{--                                <li>--}}
{{--                                    <a href="#">Third Level Link</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">Third Level Link</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">Third Level Link</a>--}}
{{--                                </li>--}}

{{--                            </ul>--}}

{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="empty.html"><i class="fa fa-fw fa-file"></i> Empty Page</a>--}}
{{--                </li>--}}
    </ul>

</div>
