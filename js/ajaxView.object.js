class ajaxView{

    constructor()
    {
        this.$table = $('#output-table');
    }

    // Events

    initGUIEvents(){
        let self = this;

        $('#trigger-request').on("click", function(){
            self.getCategories();
            //console.error("test");

        });

        $('#output-table').on("click", '.trigger-products', function(event){
            event.preventDefault();
            let url = $(this).data('url');
            let id = $(this).data('id');
            self.getProducts(url, id);

        });

    }


    // Ajax Methoden

    getCategories(){

        let self = this;

        $.ajax({
            url: "http://localhost:8080/_FE/04/index.php?action=listTypes",
            method: "GET",

            success: function(response){
                self.fillCategories(response);
            },
            error: function(error){
                self.displayError(error);
            }
        });
    }


    getProducts(url, id){

        let self = this;

        $.ajax({
            url: url,
            method: "GET",

            success: function(response){
                self.fillProducts(response, id);
            },
            error: function(error){
                self.displayError(error);
            }
        });
    }

    // Content Methoden

    fillCategories(data) {

        for (let i = 0; i < data.length; i++) {

            let row = $('<tr></tr>');
            let categories = "<td>" + data[i]["productType"] + "</td>";
            let url = data[i]["url"];
            let array = url.split('=');
            let productId = array[2];
            let button = "<td id ='products-"+ productId +"' > <button type='button' data-id= 'products-" + productId + "' data-url= 'http://" + url + "' class='btn btn-primary btn-sm trigger-products' >Produkte anzeigen </button> <br></td>";

            row.append(categories + button);
            this.$table.find("tbody").append(row);
            
        }
    }


    fillProducts(data, id){

        for (let i = 0; i < data["products"].length; i++) {

            let row = $('<tr></tr>');
            let button = "<button type=\"button\" class=\"btn btn-primary btn-sm\" >Kaufen </button>";
            let products = data["products"][i]["name"] + "<br>";

            row.append(products + button);
            this.$table.find("#" + id).append(row);

        }

    }


    displayError(error){
        console.log(error);
    }
}
