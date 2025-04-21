<script type="text/javascript">
        try {
            ace.settings.loadState('main-container')
        } catch (e) {}
    </script>

    <div id="sidebar" class="sidebar responsive ace-save-state">
        <script type="text/javascript">
            try {
                ace.settings.loadState('sidebar')
            } catch (e) {}
        </script>

        <ul class="nav nav-list">
            <li class="active">
                <a href="<?= base_url('dashboard'); ?>">
                    <i class="menu-icon fa fa-home"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>

                <b class="arrow"></b>
            </li>

            <?php 
            $session = session();

            if ($session->get('role') === 'Admin') : ?>
                <li class="">
                    <a href="<?= base_url('user_management'); ?>">
                        <i class="menu-icon fa fa-users"></i>
                        <span class="menu-text"> User Management </span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="<?= base_url('feedback'); ?>">
                        <i class="menu-icon fa fa-star"></i>
                        <span class="menu-text"> Feedbacks </span>
                    </a>

                    <b class="arrow"></b>
                </li>

            <?php endif; ?>

            
            <?php 
            $session = session();

            if ($session->get('role') === 'Facility Manager') : ?>
                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-home"></i>
                        <span class="menu-text"> Fac. Management </span>

                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu nav-hide" style="display: none;">
                        <li class="">
                            <a href="<?= base_url('building');?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Building
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="<?= base_url('facility');?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Facility
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>

                <li class="">
                    <a href="<?= base_url('reservation'); ?>">
                        <i class="menu-icon fa fa-shopping-bag"></i>
                        <span class="menu-text"> Reservation </span>
                    </a>

                    <b class="arrow"></b>
                </li>
                
                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-cog"></i>
                        <span class="menu-text"> Settings </span>

                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu nav-hide" style="display: none;">
                        <li class="">
                            <a href="<?= base_url('facilities_type');?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Facilities Type
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
                

            <?php endif; ?>

            <?php 
            $session = session();

            if ($session->get('role') === 'Regular User') : ?>
                <li class="">
                    <a href="<?= base_url('reservation'); ?>">
                        <i class="menu-icon fa fa-shopping-bag"></i>
                        <span class="menu-text"> Reservation </span>
                    </a>

                    <b class="arrow"></b>
                </li>
            
            <?php endif; ?>

            <?php 
            $session = session();

            if ($session->get('role') === 'Super Admin') : ?>

                <li class="">
                    <a href="<?= base_url('user_management'); ?>">
                        <i class="menu-icon fa fa-users"></i>
                        <span class="menu-text"> User Management </span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-home"></i>
                        <span class="menu-text"> Fac. Management </span>

                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu nav-hide" style="display: none;">
                        <li class="">
                            <a href="<?= base_url('building');?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Building
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="<?= base_url('facility');?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Facility
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>

                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-cog"></i>
                        <span class="menu-text"> Settings </span>

                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu nav-hide" style="display: none;">
                        <li class="">
                            <a href="<?= base_url('facilities_type');?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Facilities Type
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>

                <li class="">
                    <a href="<?= base_url('reservation'); ?>">
                        <i class="menu-icon fa fa-shopping-bag"></i>
                        <span class="menu-text"> Reservation </span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="<?= base_url('feedback'); ?>">
                        <i class="menu-icon fa fa-star"></i>
                        <span class="menu-text"> Feedbacks </span>
                    </a>

                    <b class="arrow"></b>
                </li>



            <?php endif; ?>


        </ul><!-- /.nav-list -->

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
                data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
    </div>

    