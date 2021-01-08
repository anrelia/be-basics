<?php


class Controller
{
    private $jsonView;
    private $Database;


    public function __construct()
    {
        $this->jsonView = new jsonView();
        $this->Database = new DatabaseService();

    }


    public function route(){

        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
        $typeId = filter_input(INPUT_GET, 'typeId', FILTER_SANITIZE_SPECIAL_CHARS);
        $articleId = filter_input(INPUT_GET, 'articleId', FILTER_SANITIZE_SPECIAL_CHARS);


        $creationSuccessfull = $this->getSimulationResult($action, $typeId, $articleId);

        if($creationSuccessfull){

            $outputData = $this->getSimulationResult($action, $typeId, $articleId);
            $this->jsonView->streamOutput($outputData);

        } else {
            $errorData = array(
                "ERROR" => "Simulator Type ".$action." not found."
            );
            $this->jsonView->streamOutput($errorData);
        }
    }


    function getSimulationResult($action, $typeId, $articleId)

    {
        switch ( strtolower( $action)) {
            case "listtypes":
                $categoryModel = new CategoryModel();
                $result = $categoryModel->getQueryResult($this->Database->getDatabase());
                return $result;
                break;

            case "listproductsbytypeid":
                $productModel = new ProductModel($typeId);
                $result = $productModel->getQueryResult($this->Database->getDatabase());
                return $result;
                break;

            case "addarticle":
                $addModel = new AddModel($articleId);
                $result = $addModel->addArticle();
                return $result;
                break;

            case "removearticle":
                $removeModel = new RemoveModel($articleId);
                $result = $removeModel->removeArticle();
                return $result;
                break;

            case "listCart":
                $cartModel = new CartModel();
                $result = $cartModel->getCartList();
                return $result;
                break;

        }

    }


  }