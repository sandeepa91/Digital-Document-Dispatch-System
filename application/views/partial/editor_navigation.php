<nav class="navbar-default navbar-static-side " role="navigation"   >
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" style="margin-left: -10px; margin-top: -20px; margin-bottom: -15px" width="150px" class="img-responsive" src="<?php echo base_url('assets'); ?>/img/logo9.png" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">
                                    <!--                                        --> 
                                </strong>
                            </span> <span class="text-muted text-xs block">
                                <!--                                    --> <!-- -->
                                <!--                                    --> <!-- -->
                                <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInUp m-t-xs">
                        <li><a href="<?php echo base_url() ?>index.php/Users/profile" target="_blank">Profile</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    NWSDB
                </div>
            </li>

            <li>
                <a href="<?php echo base_url() ?>index.php/dashboard"><i class="fa fa-th-large"></i> <span
                        class="nav-label">Dashboard</span></a>
            </li>

            <li  >
                <a href="index.html"><i class="fa fa-book"></i> <span class="nav-label">Document  </span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li ><a href="<?php echo base_url() ?>index.php/Document">Create Document</a></li>
                    <li ><a href="<?php echo base_url() ?>index.php/Reports/Employee_report/index" target="_blank">Receive Document</a></li>
                </ul>
            </li>    
        </ul>

    </div>
</nav>
