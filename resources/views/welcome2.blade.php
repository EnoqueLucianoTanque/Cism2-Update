<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Boooya - Form Wizard</title>

        <!-- META SECTION -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- END META SECTION -->
        <!-- CSS INCLUDE -->
        <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>

        <!-- APP WRAPPER -->
        <div class="app">

            <!-- START APP CONTAINER -->
            <div class="app-container">
                <!-- START SIDEBAR -->
                <div class="app-sidebar app-navigation app-navigation-fixed scroll app-navigation-style-default app-navigation-open-hover dir-left" data-type="close-other">
                    <a href="index.html" class="app-navigation-logo">
                        Boooya - Revolution Admin Template
                        <button class="app-navigation-logo-button mobile-hidden" data-sidepanel-toggle=".app-sidepanel"><span class="icon-alarm"></span> <span class="app-navigation-logo-button-alert">7</span></button>
                    </a>

                    <nav>
                        <ul>
                            <li class="title">DEMONSTRATION</li>
                            <li>
                                <a href="#"><span class="nav-icon-hexa">Ds</span> Dashboards<span class="label label-success label-bordered label-ghost">new</span></a>
                                <ul>
                                    <li>
                                        <a href="index.html"><span class="nav-icon-hexa">De</span> Default</a>
                                    </li>
                                    <li>
                                        <a href="pages-dashboard-ecommerce.html"><span class="nav-icon-hexa">Ec</span> E-commerce <span class="label label-success label-bordered label-ghost">new</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="nav-icon-hexa">Pg</span> Pages <span class="label label-success label-bordered label-ghost">new</span></a>
                                <ul>
                                    <li>
                                        <a href="#"><span class="nav-icon-hexa">Re</span> Real-estate <span class="label label-success label-bordered label-ghost">new</span></a>
                                        <ul>
                                            <li><a href="pages-real-estate-search.html"><span class="nav-icon-hexa">Sr</span> Search Result</a></li>
                                            <li><a href="pages-real-estate-map.html"><span class="nav-icon-hexa">Mp</span> Map</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><span class="nav-icon-hexa">Ba</span> Bank Application</a>
                                        <ul>
                                            <li><a href="pages-bank-main.html"><span class="nav-icon-hexa">Mn</span> Main</a></li>
                                            <li><a href="pages-bank-cards.html"><span class="nav-icon-hexa">Cs</span> My Cards</a></li>
                                            <li><a href="pages-bank-deposits.html"><span class="nav-icon-hexa">Dp</span> Deposits</a></li>
                                            <li><a href="pages-bank-activity.html"><span class="nav-icon-hexa">Ac</span> Activity</a></li>
                                            <li><a href="pages-bank-settings.html"><span class="nav-icon-hexa">St</span> Settings</a></li>
                                            <li><a href="pages-bank-security.html"><span class="nav-icon-hexa">Sc</span> Security</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>


                        </ul>
                    </nav>
                </div>
                <!-- END SIDEBAR -->

                <!-- START APP CONTENT -->
                <div class="app-content app-sidebar-left">
                    <!-- START APP HEADER -->
                    <div class="app-header app-header-design-default">
                        <ul class="app-header-buttons">
                            <li class="visible-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-toggle=".app-sidebar.dir-left"><span class="icon-menu"></span></a></li>
                            <li class="hidden-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-minimize=".app-sidebar.dir-left"><span class="icon-menu"></span></a></li>
                        </ul>
                        <form class="app-header-search" action="" method="post">
                            <input type="text" name="keyword" placeholder="Search">
                        </form>

                        <ul class="app-header-buttons pull-right">
                            <li>
                                <div class="contact contact-rounded contact-bordered contact-lg contact-ps-controls hidden-xs">
                                    <img src="{{asset('assets/images/user/no-image.png')}}" alt="John Doe">
                                    <div class="contact-container">
                                        <a href="#">@yield('user_role')</a>
                                        <span>@yield('user_name')</span>
                                    </div>
                                    <div class="contact-controls">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-default btn-icon" data-toggle="dropdown"><span class="icon-layers"></span></button>
                                            <ul class="dropdown-menu dropdown-left">
                                                <li><a href="pages-profile-social.html"><span class="icon-users"></span> Account</a></li>
                                                <li><a href="pages-messages-chat.html"><span class="icon-envelope"></span> Messages</a></li>
                                                <li><a href="pages-profile-card.html"><span class="icon-users"></span> Contacts</a></li>
                                                <li class="divider"></li>
                                                <li><a href="pages-email-inbox.html"><span class="icon-envelope"></span> E-mail <span class="label label-danger pull-right">19/2,399</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown">
                                    <button class="btn btn-default btn-icon btn-informer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="icon-alarm"></span><span class="informer informer-danger informer-sm informer-square">+3</span></button>
                                    <ul class="dropdown-menu dropdown-form dropdown-left dropdown-form-wide">
                                        <li class="padding-0">

                                            <div class="app-heading title-only app-heading-bordered-bottom">
                                                <div class="icon">
                                                    <span class="icon-text-align-left"></span>
                                                </div>
                                                <div class="title">
                                                    <h2>Notifications</h2>
                                                </div>
                                                <div class="heading-elements">
                                                    <a href="#" class="btn btn-default btn-icon"><span class="icon-sync"></span></a>
                                                </div>
                                            </div>

                                            <div class="app-timeline scroll app-timeline-simple text-sm" style="height: 240px;">

                                                <div class="app-timeline-item">
                                                    <div class="dot dot-danger"></div>
                                                    <div class="content">
                                                        <div class="title margin-bottom-0"><a href="#">Jasmine Voyer</a> declined order <strong>Project 155</strong></div>
                                                    </div>
                                                </div>

                                            </div>

                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="{{route('auth')}}" class="btn btn-default btn-icon"><span class="icon-power-switch"></span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- END APP HEADER  -->

                    <!-- START PAGE HEADING -->
                    <div class="app-heading app-heading-bordered app-heading-page">
                        <div class="title">
                            <h2>@yield('page_title')</h2>
                            <p>@yield('title_description')</p>
                        </div>
                    </div>
                    <div class="app-heading-container app-heading-bordered bottom">
                        <ul class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Form Elements</a></li>
                            <li class="active">Form Wizard</li>
                        </ul>
                    </div>
                    <!-- END PAGE HEADING -->

                    <!-- START PAGE CONTAINER -->
                    <div class="container">

                        <!-- BASIC EXAMPLE -->
                        <div class="block block-condensed">
                            <div class="app-heading">
                                <div class="title">
                                    <h2>Basic Example</h2>
                                    <p>This is basic example of wizard</p>
                                </div>
                            </div>
                            <div class="block-content">

                                <div class="wizard">
                                    <ul>
                                        <li>
                                            <a href="#step-1">
                                                <span class="stepNumber">1</span>
                                                <span class="stepDesc">Step 1<br /><small>Step 1 description</small></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-2">
                                                <span class="stepNumber">2</span>
                                                <span class="stepDesc">Step 2<br /><small>Step 2 description</small></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-3">
                                                <span class="stepNumber">3</span>
                                                <span class="stepDesc">Step 3<br /><small>Step 3 description</small></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-4">
                                                <span class="stepNumber">4</span>
                                                <span class="stepDesc">Step 4<br /><small>Step 4 description</small></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div id="step-1">
                                        <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>Step 1 Content</span></h4>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p>Praesent semper nisi magna, nec consectetur nulla pretium id. Donec scelerisque leo quis urna aliquet, eget dignissim est rutrum. Sed egestas, lacus a varius mollis, augue eros consequat ligula, scelerisque scelerisque eros lectus sed ante. Aenean ullamcorper dolor nibh, id ullamcorper orci lobortis at. Phasellus dapibus luctus ex, vel aliquet tellus viverra et. Maecenas ut tempus dolor.</p>
                                                <p>In luctus eu lectus eget tincidunt. Aenean dictum metus vel tortor condimentum finibus. Aenean pharetra tempus efficitur. Vivamus nec mi bibendum, congue eros eu, euismod eros. Nulla faucibus pellentesque velit. Cras varius tellus in tellus posuere, vel pretium ipsum molestie.</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Duis ligula turpis, sollicitudin nec vehicula id, porta sit amet augue. Sed justo augue, dapibus non lacus vel, pharetra dapibus dui. Etiam ullamcorper libero ipsum, et condimentum ligula aliquam at. Vestibulum suscipit sodales laoreet. Vivamus lacinia, urna sed consequat bibendum, arcu est commodo diam, quis pulvinar nisl purus eget velit.</p>
                                                <p>Duis ut eros ut ipsum aliquam mattis vel id mauris. Vivamus iaculis purus eget sem ultricies egestas. Nullam et eros ipsum. Sed nec vestibulum nibh, venenatis malesuada leo.In luctus eu lectus eget tincidunt. Aenean dictum metus vel tortor condimentum finibus. Aenean pharetra tempus efficitur.</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Aenean dictum metus vel tortor condimentum finibus. Aenean pharetra tempus efficitur. In luctus eu lectus eget tincidunt. Vivamus nec mi bibendum, congue eros eu, euismod eros. Nulla faucibus pellentesque velit. Cras varius tellus in tellus posuere, vel pretium ipsum molestie.</p>
                                                <p>Praesent semper nisi magna, nec consectetur nulla pretium id. Donec scelerisque leo quis urna aliquet, eget dignissim est rutrum. Sed egestas, lacus a varius mollis, augue eros consequat ligula, scelerisque scelerisque eros lectus sed ante. Aenean ullamcorper dolor nibh, id ullamcorper orci lobortis at. Phasellus dapibus luctus ex, vel aliquet tellus viverra et. Maecenas ut tempus dolor.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="step-2">
                                        <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>Step 2 Content</span></h4>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p>Duis ligula turpis, sollicitudin nec vehicula id, porta sit amet augue. Sed justo augue, dapibus non lacus vel, pharetra dapibus dui. Etiam ullamcorper libero ipsum, et condimentum ligula aliquam at. Vestibulum suscipit sodales laoreet. Vivamus lacinia, urna sed consequat bibendum, arcu est commodo diam, quis pulvinar nisl purus eget velit.</p>
                                                <p>Duis ut eros ut ipsum aliquam mattis vel id mauris. Vivamus iaculis purus eget sem ultricies egestas. Nullam et eros ipsum. Sed nec vestibulum nibh, venenatis malesuada leo.In luctus eu lectus eget tincidunt. Aenean dictum metus vel tortor condimentum finibus. Aenean pharetra tempus efficitur.</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Praesent semper nisi magna, nec consectetur nulla pretium id. Donec scelerisque leo quis urna aliquet, eget dignissim est rutrum. Sed egestas, lacus a varius mollis, augue eros consequat ligula, scelerisque scelerisque eros lectus sed ante. Aenean ullamcorper dolor nibh, id ullamcorper orci lobortis at. Phasellus dapibus luctus ex, vel aliquet tellus viverra et. Maecenas ut tempus dolor.</p>
                                                <p>In luctus eu lectus eget tincidunt. Aenean dictum metus vel tortor condimentum finibus. Aenean pharetra tempus efficitur. Vivamus nec mi bibendum, congue eros eu, euismod eros. Nulla faucibus pellentesque velit. Cras varius tellus in tellus posuere, vel pretium ipsum molestie.</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Aenean dictum metus vel tortor condimentum finibus. Aenean pharetra tempus efficitur. In luctus eu lectus eget tincidunt. Vivamus nec mi bibendum, congue eros eu, euismod eros. Nulla faucibus pellentesque velit. Cras varius tellus in tellus posuere, vel pretium ipsum molestie.</p>
                                                <p>Praesent semper nisi magna, nec consectetur nulla pretium id. Donec scelerisque leo quis urna aliquet, eget dignissim est rutrum. Sed egestas, lacus a varius mollis, augue eros consequat ligula, scelerisque scelerisque eros lectus sed ante. Aenean ullamcorper dolor nibh, id ullamcorper orci lobortis at. Phasellus dapibus luctus ex, vel aliquet tellus viverra et. Maecenas ut tempus dolor.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="step-3">
                                        <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>Step 3 Content</span></h4>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p>Aenean dictum metus vel tortor condimentum finibus. Aenean pharetra tempus efficitur. In luctus eu lectus eget tincidunt. Vivamus nec mi bibendum, congue eros eu, euismod eros. Nulla faucibus pellentesque velit. Cras varius tellus in tellus posuere, vel pretium ipsum molestie.</p>
                                                <p>Praesent semper nisi magna, nec consectetur nulla pretium id. Donec scelerisque leo quis urna aliquet, eget dignissim est rutrum. Sed egestas, lacus a varius mollis, augue eros consequat ligula, scelerisque scelerisque eros lectus sed ante. Aenean ullamcorper dolor nibh, id ullamcorper orci lobortis at. Phasellus dapibus luctus ex, vel aliquet tellus viverra et. Maecenas ut tempus dolor.</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Duis ligula turpis, sollicitudin nec vehicula id, porta sit amet augue. Sed justo augue, dapibus non lacus vel, pharetra dapibus dui. Etiam ullamcorper libero ipsum, et condimentum ligula aliquam at. Vestibulum suscipit sodales laoreet. Vivamus lacinia, urna sed consequat bibendum, arcu est commodo diam, quis pulvinar nisl purus eget velit.</p>
                                                <p>Duis ut eros ut ipsum aliquam mattis vel id mauris. Vivamus iaculis purus eget sem ultricies egestas. Nullam et eros ipsum. Sed nec vestibulum nibh, venenatis malesuada leo.In luctus eu lectus eget tincidunt. Aenean dictum metus vel tortor condimentum finibus. Aenean pharetra tempus efficitur.</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Praesent semper nisi magna, nec consectetur nulla pretium id. Donec scelerisque leo quis urna aliquet, eget dignissim est rutrum. Sed egestas, lacus a varius mollis, augue eros consequat ligula, scelerisque scelerisque eros lectus sed ante. Aenean ullamcorper dolor nibh, id ullamcorper orci lobortis at. Phasellus dapibus luctus ex, vel aliquet tellus viverra et. Maecenas ut tempus dolor.</p>
                                                <p>In luctus eu lectus eget tincidunt. Aenean dictum metus vel tortor condimentum finibus. Aenean pharetra tempus efficitur. Vivamus nec mi bibendum, congue eros eu, euismod eros. Nulla faucibus pellentesque velit. Cras varius tellus in tellus posuere, vel pretium ipsum molestie.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="step-4">
                                        <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>Step 4 Content</span></h4>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p>Aenean dictum metus vel tortor condimentum finibus. Aenean pharetra tempus efficitur. In luctus eu lectus eget tincidunt. Vivamus nec mi bibendum, congue eros eu, euismod eros. Nulla faucibus pellentesque velit. Cras varius tellus in tellus posuere, vel pretium ipsum molestie.</p>
                                                <p>Praesent semper nisi magna, nec consectetur nulla pretium id. Donec scelerisque leo quis urna aliquet, eget dignissim est rutrum. Sed egestas, lacus a varius mollis, augue eros consequat ligula, scelerisque scelerisque eros lectus sed ante. Aenean ullamcorper dolor nibh, id ullamcorper orci lobortis at. Phasellus dapibus luctus ex, vel aliquet tellus viverra et. Maecenas ut tempus dolor.</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Duis ligula turpis, sollicitudin nec vehicula id, porta sit amet augue. Sed justo augue, dapibus non lacus vel, pharetra dapibus dui. Etiam ullamcorper libero ipsum, et condimentum ligula aliquam at. Vestibulum suscipit sodales laoreet. Vivamus lacinia, urna sed consequat bibendum, arcu est commodo diam, quis pulvinar nisl purus eget velit.</p>
                                                <p>Duis ut eros ut ipsum aliquam mattis vel id mauris. Vivamus iaculis purus eget sem ultricies egestas. Nullam et eros ipsum. Sed nec vestibulum nibh, venenatis malesuada leo.In luctus eu lectus eget tincidunt. Aenean dictum metus vel tortor condimentum finibus. Aenean pharetra tempus efficitur.</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Praesent semper nisi magna, nec consectetur nulla pretium id. Donec scelerisque leo quis urna aliquet, eget dignissim est rutrum. Sed egestas, lacus a varius mollis, augue eros consequat ligula, scelerisque scelerisque eros lectus sed ante. Aenean ullamcorper dolor nibh, id ullamcorper orci lobortis at. Phasellus dapibus luctus ex, vel aliquet tellus viverra et. Maecenas ut tempus dolor.</p>
                                                <p>In luctus eu lectus eget tincidunt. Aenean dictum metus vel tortor condimentum finibus. Aenean pharetra tempus efficitur. Vivamus nec mi bibendum, congue eros eu, euismod eros. Nulla faucibus pellentesque velit. Cras varius tellus in tellus posuere, vel pretium ipsum molestie.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- END BASIC EXAMPLE -->

                        <div class="block block-condensed">
                            <!-- START HEADING -->
                            <div class="app-heading app-heading-small">
                                <div class="title">
                                    <h5>Extended Sortable Table</h5>
                                    <p>Add class <code>datatable-extended</code> to get full-featured sortable table.</p>
                                </div>
                            </div>
                            <!-- END HEADING -->

                            <div class="block-content">

                                <table class="table table-striped table-bordered datatable-extended">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>

                </div>
                <!-- END APP CONTENT -->

            </div>
            <!-- END APP CONTAINER -->

            <!-- START APP FOOTER -->
            <div class="app-footer app-footer-default" id="footer">
                <!--
                <div class="alert alert-danger alert-dismissible alert-inside text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="icon-cross"></span></button>
                    We use cookies to offer you the best experience on our website. Continuing browsing, you accept our cookies policy.
                </div>
                -->
                <div class="app-footer-line extended">
                    <div class="row">
                        <div class="col-md-3 col-sm-4">
                            <h3 class="title"><img src="/img/logo-footer.png" alt="boooyah"> Boooya</h3>
                            <p>The innovation in admin template design. You will save hundred hours while working with our template. That is based on latest technologies and understandable for all.</p>
                            <p><strong>How?</strong><br>This template included with thousand of best components, that really help you to build awesome design.</p>
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <h3 class="title"><span class="icon-clipboard-text"></span> About Us</h3>
                            <ul class="list-unstyled">
                                <li><a href="#">About</a></li>
                                <li><a href="#">Team</a></li>
                                <li><a href="#">Why use us?</a></li>
                                <li><a href="#">Careers</a></li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <h3 class="title"><span class="icon-lifebuoy"></span> Need Help?</h3>
                            <ul class="list-unstyled">
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Community</a></li>
                                <li><a href="#">Contacts</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-sm-6 clear-mobile">
                            <h3 class="title"><span class="icon-reading"></span> Latest News</h3>

                            <div class="row app-footer-articles">
                                <div class="col-md-3 col-sm-4">
                                    <img src="/assets/images/preview/img-1.jpg" alt="" class="img-responsive">
                                </div>
                                <div class="col-md-9 col-sm-8">
                                    <a href="#">Best way to increase vocabulary</a>
                                    <p>Quod quam magnum sit fictae veterum fabulae declarant, in quibus tam multis.</p>
                                </div>
                            </div>

                            <div class="row app-footer-articles">
                                <div class="col-md-3 col-sm-4">
                                    <img src="/assets/images/preview/img-2.jpg" alt="" class="img-responsive">
                                </div>
                                <div class="col-md-9 col-sm-8">
                                    <a href="#">Best way to increase vocabulary</a>
                                    <p>In quibus tam multis tamque variis ab ultima antiquitate repetitis tria.</p>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-2 col-sm-6">
                            <h3 class="title"><span class="icon-thumbs-up"></span> Social Media</h3>

                            <a href="#" class="label-icon label-icon-footer label-icon-bordered label-icon-rounded label-icon-lg">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="#" class="label-icon label-icon-footer label-icon-bordered label-icon-rounded label-icon-lg">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="#" class="label-icon label-icon-footer label-icon-bordered label-icon-rounded label-icon-lg">
                                <i class="fa fa-youtube"></i>
                            </a>
                            <a href="#" class="label-icon label-icon-footer label-icon-bordered label-icon-rounded label-icon-lg">
                                <i class="fa fa-google-plus"></i>
                            </a>
                            <a href="#" class="label-icon label-icon-footer label-icon-bordered label-icon-rounded label-icon-lg">
                                <i class="fa fa-feed"></i>
                            </a>

                            <h3 class="title"><span class="icon-paper-plane"></span> Subscribe</h3>

                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="E-mail...">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary">GO</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-footer-line darken">
                    <div class="copyright wide text-center">&copy; 2016-2017 Boooya. All right reserved in the Ukraine and other countries.</div>
                </div>
            </div>
            <!-- END APP FOOTER -->
            <!-- START APP SIDEPANEL -->
            <div class="app-sidepanel scroll" data-overlay="show">
                <div class="container">

                    <div class="app-heading app-heading-condensed app-heading-small padding-left-0">
                        <div class="icon icon-lg">
                            <span class="icon-alarm"></span>
                        </div>
                        <div class="title">
                            <h2>Notifications</h2>
                            <p><strong>7 new</strong>, latest: July 19, 2016 at 10:14:32.</p>
                        </div>
                    </div>

                    <div class="listing margin-bottom-10">
                        <div class="listing-item margin-bottom-10">
                            <strong>Product Delivered</strong> <span class="label label-success pull-right">delivered</span>
                            <p class="margin-0 margin-top-5">#SPW-955-18 to st. StreetName SA, USA.</p>
                            <p class="text-muted">
                                <span class="fa fa-truck margin-right-5"></span> 19/07/2016 10:14:32 AM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>Successful Payment</strong> <span class="label label-success pull-right">success</span>
                            <p class="margin-0 margin-top-5">Payment for order #SPW-955-17: <strong>$145.44</strong>.</p>
                            <p class="text-muted">
                                <span class="fa fa-bank margin-right-5"></span> 19/07/2016 09:55:12 AM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>New Order #SPW-955-17</strong> <span class="label label-warning pull-right">waiting</span>
                            <p class="margin-0 margin-top-5">Added new order, waiting for payment. <a href="#">Order details</a>.</p>
                            <p class="text-muted">
                                <span class="fa fa-bank margin-right-5"></span> 19/07/2016 09:51:55 AM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>Money Back Request</strong> <span class="label label-primary pull-right">return</span>
                            <p class="margin-0 margin-top-5">#SPW-955-17 return requested. <a href="#">Request details</a>.</p>
                            <p class="text-muted">
                                <span class="fa fa-bank margin-right-5"></span> 19/07/2016 08:44:51 AM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>The critical amount of product</strong> <span class="label label-danger pull-right">important</span>
                            <p class="margin-0 margin-top-5">Product: <a href="#">Extra Awesome Product</a> (amount: <span class="text-danger">2</span>). <a href="#">Storehouse</a>.</p>
                            <p class="text-muted">
                                <span class="fa fa-cube margin-right-5"></span> 19/07/2016 08:30:00 AM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>Product Delivery Start</strong> <span class="label label-warning pull-right">delivering</span>
                            <p class="margin-0 margin-top-5">#SPW-955-18 to st. StreetName SA, USA.</p>
                            <p class="text-muted">
                                <span class="fa fa-truck margin-right-5"></span> 18/07/2016 06:14:32 PM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>Critical Server Load</strong> <span class="label label-danger pull-right">server</span>
                            <p class="margin-0 margin-top-5">Disk space: 248.1Gb/250Gb. <a href="#">Control panel</a>.</p>
                            <p class="text-muted">
                                <span class="fa fa-truck margin-right-5"></span> 18/07/2016 06:14:32 PM
                            </p>
                        </div>
                    </div>
                    <div class="row margin-bottom-30">
                        <div class="col-xs-6 col-xs-offset-3">
                            <button class="btn btn-default btn-block">All Notification</button>
                        </div>
                    </div>

                    <div class="app-heading app-heading-condensed app-heading-small margin-bottom-20 padding-left-0">
                        <div class="icon icon-lg">
                            <span class="icon-cog"></span>
                        </div>
                        <div class="title">
                            <h2>Settings</h2>
                            <p>Notification Settings</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_1" checked="" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>Delivery Information</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_2" checked="" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>Product Amount Information</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_3" checked="" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>Order Information</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_4" checked="" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>Server Load</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_5" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>User Registrations</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_6" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>Purchase Information</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END APP SIDEPANEL -->

            <!-- APP OVERLAY -->
            <div class="app-overlay"></div>
            <!-- END APP OVERLAY -->
        </div>
        <!-- END APP WRAPPER -->

        <!--
        <div class="modal fade" id="modal-thanks" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
                <div class="modal-content">
                    <div class="modal-body">
                        <p class="text-center margin-bottom-20">
                            <img src="assets/images/smile.png" alt="Thank you" style="width: 100px;">
                        </p>
                        <h3 id="modal-thanks-heading" class="text-uppercase text-bold text-lg heading-line-below heading-line-below-short text-center"></h3>
                        <p class="text-muted text-center margin-bottom-10">Thank you so much for likes</p>
                        <p class="text-muted text-center">We will do our best to make<br> Boooya template perfect</p>
                        <p class="text-center"><button class="btn btn-success btn-clean" data-dismiss="modal">Continue</button></p>
                    </div>
                </div>
            </div>
        </div>-->

        <!-- IMPORTANT SCRIPTS -->
        <script type="text/javascript" src="{{asset('assets/js/vendor/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/jquery/jquery-ui.min.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/bootstrap/bootstrap.min.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/moment/moment.min.js')}} "></script>

        <script type="text/javascript" src=" {{asset('assets/js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/bootstrap-select/bootstrap-select.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/select2/select2.full.min.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js')}} "></script>

        <script type="text/javascript" src=" {{asset('assets/js/vendor/maskedinput/jquery.maskedinput.min.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/form-validator/jquery.form-validator.min.js')}} "></script>

        <script type="text/javascript" src=" {{asset('assets/js/vendor/noty/jquery.noty.packaged.js')}} "></script>

        <script type="text/javascript" src=" {{asset('assets/js/vendor/datatables/jquery.dataTables.min.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/datatables/dataTables.bootstrap.min.js')}} "></script>

        <script type="text/javascript" src=" {{asset('assets/js/vendor/sweetalert/sweetalert.min.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/knob/jquery.knob.min.js')}} "></script>

        <script type="text/javascript" src=" {{asset('assets/js/vendor/jvectormap/jquery-jvectormap.min.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/jvectormap/jquery-jvectormap-world-mill-en.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/jvectormap/jquery-jvectormap-us-aea-en.js')}} "></script>

        <script type="text/javascript" src=" {{asset('assets/js/vendor/sparkline/jquery.sparkline.min.js')}} "></script>

        <script type="text/javascript" src=" {{asset('assets/js/vendor/morris/raphael.min.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/morris/morris.min.js')}} "></script>

        <script type="text/javascript" src=" {{asset('assets/js/vendor/rickshaw/d3.v3.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/rickshaw/rickshaw.min.js')}} "></script>

        <script type="text/javascript" src=" {{asset('assets/js/vendor/isotope/isotope.pkgd.min.js')}} "></script>

        <script type="text/javascript" src=" {{asset('assets/js/vendor/dropzone/dropzone.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/nestable/jquery.nestable.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/cropper/cropper.min.js')}} "></script>

        <script type="text/javascript" src=" {{asset('assets/js/vendor/tableexport/tableExport.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/tableexport/jquery.base64.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/tableexport/html2canvas.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/tableexport/jspdf/libs/sprintf.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/tableexport/jspdf/jspdf.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/tableexport/jspdf/libs/base64.js')}} "></script>

        <script type="text/javascript" src=" {{asset('assets/js/vendor/bootstrap-daterange/daterangepicker.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/bootstrap-tour/bootstrap-tour.min.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/fullcalendar/fullcalendar.js')}} "></script>
        <script type="text/javascript" src=" {{asset('assets/js/vendor/smartwizard/jquery.smartWizard.js')}} "></script>

        <script type="text/javascript" src="{{asset('assets/js/app.js')}} "></script>
        <script type="text/javascript" src="{{asset('assets/js/app_plugins.js')}} "></script>
        <script type="text/javascript" src="{{asset('js/app_demo.js')}} "></script>
        @yield('scripts')
        <!-- END APP SCRIPTS -->
    </body>
</html>
