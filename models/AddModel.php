<?php


class AddModel
{
    private $articleId;

    public function __construct($articleId)
    {
        $this->articleId = $articleId;
    }

    // Url erzeugen
    public function getUrl()
    {
        $url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?action=addArticle&articleId=";
        return $url;

    }


    public function addArticle (){

        session_start();
        $this->articleId = $_SESSION['id'];

        if ($_SESSION['amount'] >= 0) {
            $_SESSION['amount'] = $_SESSION['amount'] + 1;
            $result = array("state" => "OK");
        } else {
            $result = array("state" => "ERROR");
        }

        return $result;
    }


}