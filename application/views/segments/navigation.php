<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">BUET CSE Inventory Management</a>
            </div>
            <!-- /.navbar-header -->

<?php $this->load->view('segments/notification_bar');?>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!--<li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                             /input-group 
                        </li>
                        -->
                        
                        <li >
                            <a class="active" href="<?=site_url('welcome');?>"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                        </li>
                        <li>
                            <a href="<?=site_url('locations');?>"><i class="fa fa-table fa-fw"></i> Manage Locations</a>
                        </li>
                        <li>
                            <a href="<?=site_url('types');?>"><i class="fa fa-table fa-fw"></i> Manage Types</a>
                        </li>
                        
                        <li>
                            <a href="<?=site_url('items');?>"><i class="fa fa-table fa-fw"></i> Show All Items</a>
                        </li>
                        <li>
                            <a href="<?=site_url('unassigned_items');?>"><i class="fa fa-table fa-fw"></i> Show Unassigned Items</a>
                        </li>
                        <li>
                            <a href="<?=site_url('items_location');?>"><i class="fa fa-table fa-fw"></i> Items Per Location</a>
                        </li>
                     
                        <li>
                            <a href="<?=site_url('item_entry');?>"><i class="fa fa-table fa-fw"></i> Entry Item</a>
                        </li>
                        
                        <li>
                            <a href="<?=site_url('assign_location');?>"><i class="fa fa-table fa-fw"></i> Assign Location to Item</a>
                        </li>
                        
                        <li>
                            <a href="<?=site_url('process_relocation_request');?>"><i class="fa fa-table fa-fw"></i> Process Relocation Request</a>
                        </li>
                        
                        <li>
                            <a href="<?=site_url('persons');?>"><i class="fa fa-table fa-fw"></i> Manage Persons</a>
                        </li>
                        
						<li>
                            <a href="<?=site_url('login/logout');?>"><i class="fa fa-table fa-fw"></i> Log Out</a>
                        </li>
                        
                        
					
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
