<?php


class cartModel
{

    public function __construct()
    {
    }

    // Url erzeugen
    public function getUrl()
    {
        $url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?action=listCart";
        return $url;

    }

    public function getQueryResult($database)
    {

    }

    function getCartList (){

        $string = null;
        $amount = null;

        $cartResult = array();

        for ($i = 0; $i == $amount; $i++){

            $cartResult[0] = "card";
            $cartResult[0] = array();
            $workingArray = array("articleName" => $string, "amount" => $amount);
            array_push($cartResult[0], $workingArray);

        }

        return $cartResult;

    }




}