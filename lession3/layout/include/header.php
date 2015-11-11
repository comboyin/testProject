<section id="topline" class="grey_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <span>
                        <i class="fa fa-envelope-o"></i> <a href="mailto:comboyin1@gmail.com">comboyin1@gmail.com</a>
                    </span>
                    <span>
                        <i class="fa fa-phone"></i> +1 (900) 12345-123
                    </span>
                </div>
            </div>
        </div>
    </section>


    <section id="topinfo" class="action_section table_section light_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <a href="<?php echo __FOLDER . 'user/'?>" class="navbar-brand"> N<span>BOOK</span></a>
                </div>

                <div class="col-sm-5 text-right">
					    <div class="widget widget_search">
                            <form role="search" method="get" id="searchform" class="searchform form-inline" action="<?php echo __FOLDER . 'user/index/searchUser'?>">
                                <div class="form-group">
                                    <label class="screen-reader-text" for="search">Search for:</label>
                                    <input type="text" value="" name="KeyWord" id="search" class="form-control" placeholder="Search...">
                                </div>
                                <button type="submit" id="searchsubmit" class="theme_button">Search</button>

                            </form>
                        </div>
                </div>
                <div class="col-sm-3 text-right">
					    <h3> Hi ! <?php echo $user->getUsername()?></h3>
                </div>
            </div>
        </div>
    </section>

    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <span id="toggle_mobile_menu"></span>
                    <nav id="mainmenu_wrapper">
                        <ul id="mainmenu" class="nav nav-justified sf-menu">
                        <?php /* @var $router router */ ?>
	                        <?php 
	                        	$module 	= $router->module;
	                        	$controller = $router->controller;
	                        	$action 	= $router->action;
	                        	
	                        ?>
                            <li class="<?php echo ( $module == 'user' && $controller == 'index' && $action == 'index' ) ? 'active' : ''?>" >
                                <a href="<?php echo __FOLDER . 'user/'?>"><i class="rt-icon-home" ></i> Home</a>
                            </li>
                            <li class="<?php echo ( $module == 'user' && $controller == 'index' && $action == 'friendrequest' ) ? 'active' : ''?>">
                                <a href="<?php echo __FOLDER . 'user/index/friendRequest'?>"><i class="rt-icon-comment"></i> Friend request <span class="number-request"></span></a>
                            </li>

                            <li class="<?php echo ( $module == 'user' && $controller == 'index' && $action == 'followlist' ) ? 'active' : ''?>">
                                <a href="<?php echo __FOLDER . 'user/index/followList'?>"><i class="rt-icon-list"></i> Follow list <span class="number-follow"></span></a>
                            </li>
								
							<li class="<?php echo ( $module == 'user' && $controller == 'index' && $action == 'suggestionlist' ) ? 'active' : ''?>">
                                <a href="<?php echo __FOLDER . 'user/index/suggestionList'?>"><i class="rt-icon-list"></i> Suggestion Friend</a>
                            </li>
                            
                            <li>
                                <a href="<?php echo $router->url( array( 'module'=>'login','controller'=>'index','action' => 'logout' ) )?>"><i class="rt-icon-share"></i> Logout</a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </header>