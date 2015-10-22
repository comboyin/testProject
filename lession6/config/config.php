<?php
$config = array (
		// database config
		'database' => array (

				'db_servername' => "172.16.100.3",
				'db_username' => 'btwn2',
				'db_password' => 'btwn2',
				'db_dbname' => 'minh_nhut'


		       /*  'db_servername' => "localhost",
				'db_username' => 'root',
				'db_password' => '',
				'db_dbname' => 'minh_nhut2' */
		),
		// layout config
		'layout' => array (
				// == = = = =  = = = = = fronend = = = = ============== = = =
				// controller index
				'fronend/index' => array(
					'actions'=>array(
						'test'=>'layout/backendLayout'
					),
					'default'=>'layout/defaultLayout'
				),
				// listproduct Controller
				'fronend/listproduct' => array(
					'actions'=>array(
						'test'=>'layout/backendLayout'
					),
					'default'=>'layout/defaultLayout'
				),
				// controller login
				'fronend/login' => array(
						'actions'=>array(
						),
						'default' => 'layout/loginLayout'
				),
				// controller login
				'fronend/cart' => array(
					'actions'=>array(
					),
					'default' => 'layout/defaultLayout'
				),
				// = = = = = =   === error ========= = =============
				// error404Controller
				'error/error404' => array(
						'actions'=>array(
						),
						'default' => 'layout/error404Layout'
				),
				// error404Controller
				'error/deny' => array(
						'actions'=>array(
						),
						'default' => 'layout/denyLayout'
				)
				,
				// ======= ==== === = =  = =module backend= == =  = = == = = = = = =
				// product Controller
				'backend/product' => array(
						'actions'=>array(
						),
						'default' => 'layout/backendLayout'
				),

				// controller index
				'backend/index' => array(
					'actions'=>array(
					),
					'default' => 'layout/backendLayout'
				),

    		    // controller index
    		    'backend/account' => array(
    		        'actions'=>array(
    		        ),
    		        'default' => 'layout/backendLayout'
    		    ),

				// controller cart
				'backend/cart' => array(
						'actions'=>array(

						),
						'default' => 'layout/backendLayout'
				)
		),
		// access controll list config
		'acl'=> array(
			// admin=>1 || user=>0 || guest=>-1
			//allow config
			"allow"=>array(
				"backend" => array(
					"product" => array(
						"all" => array(1,0) // allow 1(admin) 0(user) action in controller product
					),
					"index" => array(
						"all" => array(1,0) // allow 1(admin) 0(user) action in controller product
					),
					"account" => array(
						"all" => array(1) // allow 1(admin) 0(user) action in controller product
					),
					'cart' => array(
						"all" => array(1,0)
					)
				),
				"fronend" => array(
					"index" => array(
						"all" => "all" // allow all action in controller.
					),
					"login" => array(
						"all" => "all"
					),
					"listproduct" => array(
						"all" => "all"
					),
					"cart" => array(
						"all" => "all"
					)
				),
				"error" => array(
					"error404" => array(
						"all" => "all"
					),
					"deny" => array(
						"all" => "all"
					)
				)
			),
			// deny config
			"deny" => array(
				"fronend" => array(
					"index" => array(
						"test" => array(-1) // allow all action in controller.
					)
				),
			)
		),
        // pagination config
        'pagination' => array(
            'current_page' => 1,
            'total_record' => 1, // total record
            'total_page' => 1, // total page
            'limit' => 9, // limit record
            'start' => 0, // start record
            'link_full' => '', // link full: domain/page/{page}
            'link_first' => '', // link first page
            'range' => 9, // total button display
            'min' => 0, // Tham so min
            'max' => 0
        ),
		'Product' => array(
        	'maxProductImg' => 4,
				'size'   => 500000
        )
);