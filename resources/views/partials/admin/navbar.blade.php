<nav class="navbar navbar-expand-lg bg-primary">
              <div class="container">
                <div class="navbar-translate">
                  <a class="navbar-brand" href="/admin/announcements">{{ trans('panel.site_title') }}</a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#example-navbar-danger" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                  </button>
                </div>
                <div class="collapse navbar-collapse" id="example-navbar-danger">
                  <ul class="navbar-nav ml-auto">
                  @if(request()->is('email/verify'))

                  @else
                    @if (Auth::user())
                       <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/announcements') || request()->is('admin/announcements/*') ? 'active' : '' }}" href="/admin/announcements">
                            <p>Announcements</p>
                          </a>
                        </li>
                    
                      @can('client_access')
                        <li class="nav-item">
                          <a class="nav-link {{ request()->is('finder_clinic') || request()->is('finder_clinic/*') ? 'active' : '' }}" href="/finder_clinic">
                            <p>FINDER CLINIC</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/appointment') || request()->is('admin/appointment/*') ? 'active' : '' }}" href="/admin/appointment">
                            <p>APPOINTMENTS</p>
                          </a>
                        </li>
                      @endcan
                      @can('clinic_access')
                        <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/clinic/appointments') || request()->is('admin/clinic/appointments/*') ? 'active' : '' }}" href="/admin/clinic/appointments">
                            <p>MANAGE APPOINTMENTS</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/clinic/doctors') || request()->is('admin/clinic/doctors/*') ? 'active' : '' }}" href="/admin/clinic/doctors">
                            <p>MANAGE DOCTORS</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/clinic/services') || request()->is('admin/clinic/services/*') ? 'active' : '' }}" href="/admin/clinic/services">
                            <p>MANAGE SERVICES</p>
                          </a>
                        </li>
                      @endcan
                      @can('admin_access')
                        <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/appointments') || request()->is('admin/appointments/*') ? 'active' : '' }}" href="/admin/appointments">
                            <p>ALL APPOINTMENTS</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/clinics') || request()->is('admin/clinics/*') ? 'active' : '' }}" href="/admin/clinics">
                            <p>ALL ClINICS</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link {{ request()->is('admin/clients') || request()->is('admin/clients/*') ? 'active' : '' }}" href="/admin/clients">
                            <p>ALL ClIENTS</p>
                          </a>
                        </li>
                       
                      @endcan
                    
                    @else
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') || request()->is('login/*') ? 'active' : '' }}" href="/login">
                          <p>Login</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('register') || request()->is('register/*') ? 'active' : '' }}" href="/register?user_type=Client">
                          <p>Register</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('finder_clinic') || request()->is('finder_clinic/*') ? 'active' : '' }}" href="/finder_clinic">
                          <p>FINDER CLINIC</p>
                        </a>
                      </li>
                    @endif
                    
                      
                      @if (Auth::user())
                        <li class="nav-item dropdown ml-4">
                          <a href="#" class="nav-link dropdown-toggle font-weight-bold" id="navbarDropdownMenuLink" data-toggle="dropdown">
                           {{Auth::user()->client->name ?? Auth::user()->clinic->name ?? 'ADMIN'}}
                            <i class="now-ui-icons ui-1_settings-gear-63" aria-hidden="true"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                          @if (Auth::user()->roles()->pluck('id')->implode(', ') == 1)
                           <a class="dropdown-item" href="/admin/accounts">ADD ADMIN</a>
                          @else
                            <a class="dropdown-item" href="/admin/edit_account">Edit Account</a>
                          @endif
                            <a class="dropdown-item" href="/admin/change_password">Change Password?</a>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</a>
                          </div>
                        </li>
                      @endif
                  @endif   
                  </ul>
                </div>
              </div>
            </nav>