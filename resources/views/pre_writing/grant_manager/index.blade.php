@extends('layout.template')
@section('page_title', 'Dashboard')
@section('title_description', 'Página inicial')
@section('page_title_', 'Grant Manager')
@section('page_title_active', 'Dashboard')
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))

@section('content')

    <div class="row">
        <div class="col-md-3">

            <ul class="app-feature-gallery app-feature-gallery-noshadow margin-bottom-0">
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Sales Per Month</div>
                            <div class="title pull-right"><span class="label label-success label-ghost label-bordered">+14.2%</span></div>
                        </div>
                        <div class="intval">9,427</div>
                        <div class="line">
                            <div class="subtitle">Total items sold</div>
                            <div class="subtitle pull-right text-success"><span class="icon-arrow-up"></span> good</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Sales Per Year</div>
                            <div class="title pull-right text-success">+32.9%</div>
                        </div>
                        <div class="intval">24,834</div>
                        <div class="line">
                            <div class="subtitle">Total items sold</div>
                            <div class="subtitle pull-right text-success"><span class="icon-arrow-up"></span> good</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Profit</div>
                            <div class="title pull-right text-success">+9.2%</div>
                        </div>
                        <div class="intval">539,277 <small>usd</small></div>
                        <div class="line">
                            <div class="subtitle">Frofit for the year</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Outlay</div>
                            <div class="title pull-right text-success">-12.7%</div>
                        </div>
                        <div class="intval">45,385<small>usd</small></div>
                        <div class="line">
                            <div class="subtitle">Statistic per year</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
            </ul>

        </div>
        <div class="col-md-3">

            <ul class="app-feature-gallery app-feature-gallery-noshadow margin-bottom-0">
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Sales Per Month</div>
                            <div class="title pull-right"><span class="label label-success label-ghost label-bordered">+14.2%</span></div>
                        </div>
                        <div class="intval">9,427</div>
                        <div class="line">
                            <div class="subtitle">Total items sold</div>
                            <div class="subtitle pull-right text-success"><span class="icon-arrow-up"></span> good</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Sales Per Year</div>
                            <div class="title pull-right text-success">+32.9%</div>
                        </div>
                        <div class="intval">24,834</div>
                        <div class="line">
                            <div class="subtitle">Total items sold</div>
                            <div class="subtitle pull-right text-success"><span class="icon-arrow-up"></span> good</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Profit</div>
                            <div class="title pull-right text-success">+9.2%</div>
                        </div>
                        <div class="intval">539,277 <small>usd</small></div>
                        <div class="line">
                            <div class="subtitle">Frofit for the year</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Outlay</div>
                            <div class="title pull-right text-success">-12.7%</div>
                        </div>
                        <div class="intval">45,385<small>usd</small></div>
                        <div class="line">
                            <div class="subtitle">Statistic per year</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
            </ul>

        </div>
        <div class="col-md-3">

            <ul class="app-feature-gallery app-feature-gallery-noshadow margin-bottom-0">
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Sales Per Month</div>
                            <div class="title pull-right"><span class="label label-success label-ghost label-bordered">+14.2%</span></div>
                        </div>
                        <div class="intval">9,427</div>
                        <div class="line">
                            <div class="subtitle">Total items sold</div>
                            <div class="subtitle pull-right text-success"><span class="icon-arrow-up"></span> good</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Sales Per Year</div>
                            <div class="title pull-right text-success">+32.9%</div>
                        </div>
                        <div class="intval">24,834</div>
                        <div class="line">
                            <div class="subtitle">Total items sold</div>
                            <div class="subtitle pull-right text-success"><span class="icon-arrow-up"></span> good</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Profit</div>
                            <div class="title pull-right text-success">+9.2%</div>
                        </div>
                        <div class="intval">539,277 <small>usd</small></div>
                        <div class="line">
                            <div class="subtitle">Frofit for the year</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Outlay</div>
                            <div class="title pull-right text-success">-12.7%</div>
                        </div>
                        <div class="intval">45,385<small>usd</small></div>
                        <div class="line">
                            <div class="subtitle">Statistic per year</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
            </ul>

        </div>
        <div class="col-md-3">

            <ul class="app-feature-gallery app-feature-gallery-noshadow margin-bottom-0">
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Sales Per Month</div>
                            <div class="title pull-right"><span class="label label-success label-ghost label-bordered">+14.2%</span></div>
                        </div>
                        <div class="intval">9,427</div>
                        <div class="line">
                            <div class="subtitle">Total items sold</div>
                            <div class="subtitle pull-right text-success"><span class="icon-arrow-up"></span> good</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Sales Per Year</div>
                            <div class="title pull-right text-success">+32.9%</div>
                        </div>
                        <div class="intval">24,834</div>
                        <div class="line">
                            <div class="subtitle">Total items sold</div>
                            <div class="subtitle pull-right text-success"><span class="icon-arrow-up"></span> good</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Profit</div>
                            <div class="title pull-right text-success">+9.2%</div>
                        </div>
                        <div class="intval">539,277 <small>usd</small></div>
                        <div class="line">
                            <div class="subtitle">Frofit for the year</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile">
                        <div class="line">
                            <div class="title">Outlay</div>
                            <div class="title pull-right text-success">-12.7%</div>
                        </div>
                        <div class="intval">45,385<small>usd</small></div>
                        <div class="line">
                            <div class="subtitle">Statistic per year</div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
            </ul>

        </div>

        <div class="col-md-6">

            <!-- START LATEST TRANSACTIONS -->
            <div class="block block-condensed">
                <div class="app-heading">
                    <div class="title">
                        <h2>Latest Transactions</h2>
                        <p>Quick information</p>
                    </div>
                    <div class="heading-elements">
                        <button class="btn btn-default btn-icon-fixed"><span class="icon-file-add"></span> All Transactions</button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-clean-paddings margin-bottom-0">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th width="150">Order</th>
                                    <th width="150">Status</th>
                                    <th width="55"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="contact contact-rounded contact-bordered contact-lg">
                                            <img src="assets/images/users/user_2.jpg">
                                            <div class="contact-container">
                                                <a href="#">John Doe</a>
                                                <span>on July 13, 2017</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>SPW-955-21</td>
                                    <td><span class="label label-success label-bordered">Confirmed</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default btn-icon btn-clean dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-cog"></span></button>
                                            <ul class="dropdown-menu dropdown-left">
                                                <li><a href="#"><span class="icon-question-circle text-info"></span> More information</a></li>
                                                <li><a href="#"><span class="icon-arrow-up-circle text-warning"></span> Promote to top</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><span class="icon-cross-circle text-danger"></span> Delete transactions</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="contact contact-rounded contact-bordered contact-lg">
                                            <img src="assets/images/users/user_3.jpg">
                                            <div class="contact-container">
                                                <a href="#">Juan Obrien</a>
                                                <span>on July 12, 2017</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>SPW-955-20</td>
                                    <td><span class="label label-warning label-bordered">Waiting payment</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default btn-icon btn-clean dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-cog"></span></button>
                                            <ul class="dropdown-menu dropdown-left">
                                                <li><a href="#"><span class="icon-question-circle text-info"></span> More information</a></li>
                                                <li><a href="#"><span class="icon-arrow-up-circle text-warning"></span> Promote to top</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><span class="icon-cross-circle text-danger"></span> Delete transactions</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="contact contact-rounded contact-bordered contact-lg">
                                            <img src="assets/images/users/user_4.jpg">
                                            <div class="contact-container">
                                                <a href="#">Erin Stewart</a>
                                                <span>on July 12, 2017</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>SPW-955-18</td>
                                    <td><span class="label label-success label-bordered">Confirmed</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default btn-icon btn-clean dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-cog"></span></button>
                                            <ul class="dropdown-menu dropdown-left">
                                                <li><a href="#"><span class="icon-question-circle text-info"></span> More information</a></li>
                                                <li><a href="#"><span class="icon-arrow-up-circle text-warning"></span> Promote to top</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><span class="icon-cross-circle text-danger"></span> Delete transactions</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="contact contact-rounded contact-bordered contact-lg">
                                            <img src="assets/images/users/user_5.jpg">
                                            <div class="contact-container">
                                                <a href="#">Jeff Kuhn</a>
                                                <span>on July 11, 2017</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>SPW-955-17</td>
                                    <td><span class="label label-danger label-bordered">Payment expired</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default btn-icon btn-clean dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-cog"></span></button>
                                            <ul class="dropdown-menu dropdown-left">
                                                <li><a href="#"><span class="icon-question-circle text-info"></span> More information</a></li>
                                                <li><a href="#"><span class="icon-arrow-up-circle text-warning"></span> Promote to top</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><span class="icon-cross-circle text-danger"></span> Delete transactions</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="contact contact-rounded contact-bordered contact-lg">
                                            <img src="assets/images/users/user_6.jpg">
                                            <div class="contact-container">
                                                <a href="#">Jared Stevens</a>
                                                <span>on July 11, 2017</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>SPW-955-14</td>
                                    <td><span class="label label-primary label-bordered">Delivered</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default btn-icon btn-clean dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-cog"></span></button>
                                            <ul class="dropdown-menu dropdown-left">
                                                <li><a href="#"><span class="icon-question-circle text-info"></span> More information</a></li>
                                                <li><a href="#"><span class="icon-arrow-up-circle text-warning"></span> Promote to top</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><span class="icon-cross-circle text-danger"></span> Delete transactions</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END LATEST TRANSACTIONS -->

        </div>
        <div class="col-md-6">

            <!-- START LATEST TRANSACTIONS -->
            <div class="block block-condensed">
                <div class="app-heading">
                    <div class="title">
                        <h2>Latest Transactions</h2>
                        <p>Quick information</p>
                    </div>
                    <div class="heading-elements">
                        <button class="btn btn-default btn-icon-fixed"><span class="icon-file-add"></span> All Transactions</button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-clean-paddings margin-bottom-0">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th width="150">Order</th>
                                    <th width="150">Status</th>
                                    <th width="55"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="contact contact-rounded contact-bordered contact-lg">
                                            <img src="assets/images/users/user_2.jpg">
                                            <div class="contact-container">
                                                <a href="#">John Doe</a>
                                                <span>on July 13, 2017</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>SPW-955-21</td>
                                    <td><span class="label label-success label-bordered">Confirmed</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default btn-icon btn-clean dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-cog"></span></button>
                                            <ul class="dropdown-menu dropdown-left">
                                                <li><a href="#"><span class="icon-question-circle text-info"></span> More information</a></li>
                                                <li><a href="#"><span class="icon-arrow-up-circle text-warning"></span> Promote to top</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><span class="icon-cross-circle text-danger"></span> Delete transactions</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="contact contact-rounded contact-bordered contact-lg">
                                            <img src="assets/images/users/user_3.jpg">
                                            <div class="contact-container">
                                                <a href="#">Juan Obrien</a>
                                                <span>on July 12, 2017</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>SPW-955-20</td>
                                    <td><span class="label label-warning label-bordered">Waiting payment</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default btn-icon btn-clean dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-cog"></span></button>
                                            <ul class="dropdown-menu dropdown-left">
                                                <li><a href="#"><span class="icon-question-circle text-info"></span> More information</a></li>
                                                <li><a href="#"><span class="icon-arrow-up-circle text-warning"></span> Promote to top</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><span class="icon-cross-circle text-danger"></span> Delete transactions</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="contact contact-rounded contact-bordered contact-lg">
                                            <img src="assets/images/users/user_4.jpg">
                                            <div class="contact-container">
                                                <a href="#">Erin Stewart</a>
                                                <span>on July 12, 2017</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>SPW-955-18</td>
                                    <td><span class="label label-success label-bordered">Confirmed</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default btn-icon btn-clean dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-cog"></span></button>
                                            <ul class="dropdown-menu dropdown-left">
                                                <li><a href="#"><span class="icon-question-circle text-info"></span> More information</a></li>
                                                <li><a href="#"><span class="icon-arrow-up-circle text-warning"></span> Promote to top</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><span class="icon-cross-circle text-danger"></span> Delete transactions</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="contact contact-rounded contact-bordered contact-lg">
                                            <img src="assets/images/users/user_5.jpg">
                                            <div class="contact-container">
                                                <a href="#">Jeff Kuhn</a>
                                                <span>on July 11, 2017</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>SPW-955-17</td>
                                    <td><span class="label label-danger label-bordered">Payment expired</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default btn-icon btn-clean dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-cog"></span></button>
                                            <ul class="dropdown-menu dropdown-left">
                                                <li><a href="#"><span class="icon-question-circle text-info"></span> More information</a></li>
                                                <li><a href="#"><span class="icon-arrow-up-circle text-warning"></span> Promote to top</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><span class="icon-cross-circle text-danger"></span> Delete transactions</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="contact contact-rounded contact-bordered contact-lg">
                                            <img src="assets/images/users/user_6.jpg">
                                            <div class="contact-container">
                                                <a href="#">Jared Stevens</a>
                                                <span>on July 11, 2017</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>SPW-955-14</td>
                                    <td><span class="label label-primary label-bordered">Delivered</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default btn-icon btn-clean dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-cog"></span></button>
                                            <ul class="dropdown-menu dropdown-left">
                                                <li><a href="#"><span class="icon-question-circle text-info"></span> More information</a></li>
                                                <li><a href="#"><span class="icon-arrow-up-circle text-warning"></span> Promote to top</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><span class="icon-cross-circle text-danger"></span> Delete transactions</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END LATEST TRANSACTIONS -->

        </div>
    </div>


@endsection
