@section('side_bar')
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
                  <img src="{{asset('assets/images/users/user_1.jpg')}}" alt="John Doe">
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
              <a href="{{route('login')}}" class="btn btn-default btn-icon"><span class="icon-power-switch"></span></a>
          </li>
      </ul>
  </div>
@endsection