<?php


class ProductModel implements SimulatorInterface
{
    private $query;

    // sql statement
    public function __construct($productTypeId)
    {
        $this->query = "SELECT t.name AS productTypeName, p.name AS prodcutName FROM product_types t JOIN products p ON t.id = p.id_product_types WHERE t.id = {$productTypeId};";
    }

    // Url erzeugen
    public function getUrl (){

        $url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?action=listTypes";
        return $url;

    }

    // Datenbankabfrage
    public function getQueryResult($database)
    {
        $url = $this->getUrl();
        $result = [];

        foreach ($database->query($this->query) as $row) {

            // Produktkategorie in Variable speichern
            $productType = $row["productTypeName"];
            // Array für Produktkategorie vorbereiten
            $result = array("productType" => $productType, "products" => [], "url" => $url);

            foreach ($database->query($this->query) as $row) {

                // Produkte je Produktkategorie in Array schreiben
                $Products = array("name" => $row[1]);
                // Produkte in "products" einfügen
                array_push($result["products"], $Products);
            }
        }

        return $result;

    }
}