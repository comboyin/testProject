<?php
class listproductController extends baseController {

	public function index( $arg = array() ){

		if(isset($arg[1])){
			// check $arg[1]
			$idCategory = $arg[1];
			/* @var $modelCategory categoryModel */
			$modelCategory = $this->model->get('category');
			if( ($category = $modelCategory->getCategoryById($idCategory)) != null ){

				$config_pagination = $this->registry->pagination;
				if(isset($arg[2])){
					$config_pagination['current_page'] = $arg[2];
				}
				/* @var $modelProduct productModel */
				$modelProduct = $this->model->get('product');
				// total record
				$config_pagination['total_record'] = $modelProduct->totalProductByCategory($idCategory);
				// link first
				$config_pagination['link_first'] = $this->url(array('module'=>'fronend','controller'=>'listproduct','action' => 'index')) . '/' . $idCategory;
				// link page
				$config_pagination['link_full'] = $this->url(array('module'=>'fronend','controller'=>'listproduct','action' => 'index')) . '/'. $idCategory . '/' . '{page}';

				$pagination = new pagination($config_pagination);

				$configPagiantion = $pagination->getConfig();

				$listProduct = $modelProduct->listProductByCategory( $idCategory,
						array(
							'start' => $configPagiantion['start'],
							'limit' => $configPagiantion['limit']
						));
				// param to view
				$this->getView()->content->category = $category;
				$this->getView()->content->listProduct = $listProduct;
				$this->getView()->content->pagination = $pagination;

			}else{
				$this->redirect( $this->url( array( 'module'=>'error','controller'=>'error404','action' => 'index' ) ) );
			}
		}else{
			$this->redirect( $this->url( array( 'module'=>'error','controller'=>'error404','action' => 'index' ) ) );
		}
	}

	public function productDetail($arg){
		if(isset($arg[1])){
			// check $arg[1]
			$idProduct = $arg[1];
			/* @var $modelProduct productModel */
			$modelProduct = $this->model->get('product');
			if( ($product = $modelProduct->getProductById($idProduct)) != null ){

				/* @var $modelProduct productModel */
				/* @var $modelCategory categoryModel */
				/* @var $modelProductImg productimgModel */
				/* @var $product product */
				$modelProduct = $this->model->get('product');
				$modelCategory = $this->model->get('category');
				$modelProductImg = $this->model->get('productimg');

				// get product
				$product = $modelProduct->getProductById($idProduct);
				// get category

				$category = $modelCategory->getCategoryById($product->category_id);
				$product->category = $category;
				// get productimg
				$productimg = $modelProductImg->getProductimgByProduct($product->id);

				$product->productimg = $productimg;
				$this->getView()->content->product = $product;

			}else{
				$this->redirect( $this->url( array( 'module'=>'error','controller'=>'error404','action' => 'index' ) ) );
			}
		}else{
			$this->redirect( $this->url( array( 'module'=>'error','controller'=>'error404','action' => 'index' ) ) );
		}
	}

	public function search(){
	    // rt=fronend/listproduct/search/{page} & submit_search= & category=0 & keyword=abc & priceMin=150 & priceMax=260
	    // get param
	    $error = null;
	    $listProduct = null;
	    $pagination = null;
	    $search = array();
	    /*
	     * array (size=6)
          'rt' => string 'fronend/listproduct/search' (length=26)
          'keyword' => string '' (length=0)
          'category' => string '0' (length=1)
          'priceMin' => string '' (length=0)
          'priceMax' => string '' (length=0)
          'submit_search' => string 'Tìm kiếm' (length=11)
	     *
	     *   */
        $keyword = isset( $_GET['keyword'] ) ? $_GET['keyword'] : '';
        $category_id = isset( $_GET['category'] ) ? $_GET['category'] : null;
        $priceMin = isset( $_GET['priceMin'] ) ? $_GET['priceMin'] : '';
        $priceMax = isset( $_GET['priceMax'] ) ? $_GET['priceMax'] : '';
        $submit_search = isset( $_GET['submit_search'] ) ? $_GET['submit_search'] : null;
        $currentPage = isset( $_GET['page'] ) ? $_GET['page'] : 1;

        if( $submit_search != null && $category_id != null ){
            // ======= validation =======
            // price is numberic
                 // price Min
                if( $priceMin != '' ){
                    if( !is_numeric($priceMin) ){
                        utility::pushArrayToArray($error['priceMin'], array( 'Giá tiền phải là số.' ));
                    }else if( $priceMin < 1000 || $priceMin > 5000000){
                        utility::pushArrayToArray($error['priceMin'], array( 'Giá tiền phải lớn hơn 1.000 VND và bé hơn 5.000.000 VND' ));
                    }
                }
                // price Max
                if( $priceMax != '' ){
                    if( !is_numeric($priceMax) ){
                        utility::pushArrayToArray($error['priceMax'], array( 'Giá tiền phải là số.' ));
                    }else if( $priceMax < 1000 ){
                        utility::pushArrayToArray($error['priceMax'], array( 'Giá tiền phải lớn hơn 1000 VND và bé hơn 5.000.000 VND.' ));
                    }
                }

            // category not exist.

                if( $category_id != 0 ){
                    /* @var $modelCategory categoryModel */
                    $modelCategory = $this->model->get('category');
                    if( $modelCategory->getCategoryById( $category_id ) == null ){
                        utility::pushArrayToArray($error['category'], array( 'Không tìm thấy danh mục.' ));
                    }
                }

            // keywork

                if( $keyword != '' ){
                    if( strlen( $keyword ) > 50 ){
                        utility::pushArrayToArray($error['keyword'], array( 'Tên sản phẩm phải lớn hơn 50 kí tự.' ));
                    }
                }

            // ======= validation =======

            // validation success
            if( $error == null ){
				/* @var $accountCurrent account */
            	// create session
				$accountCurrent = $_SESSION['acl']['account'];
				$searchTemp = array();
				$searchTemp[ 'keyword' ] = $keyword;
				$searchTemp[ 'priceMax' ] = $priceMax;
				$searchTemp[ 'priceMin' ] = $priceMin;
				$searchTemp[ 'category_id' ] = $category_id;
				$accountCurrent->search = $searchTemp;
                // create string where
                $stringWhere = array();


                if( $keyword != ''){
                   $stringWhere[] = " product.name LIKE '%$keyword%' ";
                }

                if( $priceMax != ''){
                    $stringWhere[] = " product.price <= $priceMax  ";
                }

                if( $priceMin != ''){
                    $stringWhere[] = " product.price >= $priceMin  ";
                }

                if( $category_id != 0 ){
                    $stringWhere[] = " product.category_id = $category_id ";
                }



                // pagination
                $config_pagination = $this->registry->pagination;

                $config_pagination['current_page'] = $currentPage;

                /* @var $modelProduct productModel */
                $modelProduct = $this->model->get('product');
                // total record
                $config_pagination['total_record'] = $modelProduct->totalProductByWhere( $stringWhere );
                // link first
                $queryString = "keyword=$keyword&category=$category_id&priceMin=$priceMin&priceMax=$priceMax&submit_search=$submit_search";
                $config_pagination['link_first'] = $this->url(
                    array('module'=>'fronend','controller'=>'listproduct','action' => 'search')) . '&' . $queryString;

                // link page
                $config_pagination['link_full'] = $this->url(
                    array('module'=>'fronend','controller'=>'listproduct','action' => 'search')) . '&'. $queryString . '&' . 'page={page}';

                $pagination = new pagination($config_pagination);

                $configPagiantion = $pagination->getConfig();

                $listProduct = $modelProduct->listProductByWhere( $stringWhere,
                    array(
                        'start' => $configPagiantion['start'],
                        'limit' => $configPagiantion['limit']
                    ));

                // param to view


            }

            $this->getView()->content->listProduct = $listProduct;
            $this->getView()->content->pagination = $pagination;
            $this->getView()->content->error = $error;

        }else{
            $this->redirect( $this->url( array( 'module'=>'error','controller'=>'error404','action' => 'index' ) ) );
        }
	}
}