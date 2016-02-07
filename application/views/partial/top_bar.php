<nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-success " href="#"><i class="fa fa-bars"></i>
        </a>

    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li>
            <span class="m-r-sm text-muted welcome-message">Digital Document Dispatch System</span>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope"></i> <span class="label label-warning"><div id="inbox-count">0</div> </span>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                <div id="mail-notification">
                </div>
            </ul>
        </li>
        <li>
            <a href="<?php echo base_url() ?>index.php/users/logout">
                <i class="fa fa-sign-out"></i> Log out
            </a>
        </li>
    </ul>
</nav>