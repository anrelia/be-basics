<?php


class CategoryModel implements SimulatorInterface

{
    private $query;

    // sql statement
    public function __construct()
    {
        $this->query = "SELECT id, name FROM product_types ORDER BY name;";
    }

    // Url erzeugen
    public function getUrl()
    {
        $url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?action=listProductsByTypeId&typeId=";
        return $url;

    }

    // Datenbankabfrage
    public function getQueryResult($database)
    {
        $result = [];
        $url = $this->getUrl();

        foreach ($database->query($this->query) as $row) {

            // id in Variable speichern
            $productTypeId = $row["id"];
            // Daten zu einer Produktkategorie abfragen und in Array schreiben
            $workingArray = array("productType" => $row["name"], "url" => $url.$productTypeId);
            // Produktkategorie in eine Liste einfügen
            array_push($result , $workingArray);

        }
        return $result;
    }
}