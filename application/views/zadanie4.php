
<header class="header-menu">
        <div class="container">
                <div class="row">
                        <div class="col-sm-12 text-center">
                                <h1>zadanie #4</h1>
                                <p>Aplikacja ma dawać możliwość zapisu danych do formatów: XML, YAML, OGDL, JSON </p>
                                <p>Projekt aplikacji ma zawierać testy jednostkowe sprawdzające poprawność realizacji kodu</p>
                                <p>Porjekt aplikacji ma być tworzony z użyciem narzędzia do analizy bezpieczeństwa, wydajności i poprawności kodu				</p>
                                <br>
                                <p>DataBase:</p>
                                <p>link: http://indigo.elastictech.org/phpmyadmin/?pma_username=u464_parser</p>
                                <p>user db: u464_parser</p>
                                <p>pass db: 111111</p>

                        </div>
                </div>
        </div>
</header>

<section class="section-1-1">
        <div class="container">
                <div class="row">
                        <div class="col-sm-12 text-center">
                                <a class="button-v2 " href="/">Strona główna</a>

                                <p>format pobierania danych:</p>
                                <form id="radio">
                                  <input type="radio" name="format" value="XML" id="radio0" checked> XML
                                  <input type="radio" name="format" value="JSON" id="radio1"> JSON
                                  <input type="radio" name="format" value="YAML" id="radio2"> YAML
                                  <input type="radio" name="format" value="OGDL" id="radio3"> OGDL
                                </form>
                                <br>
                                <a class="button-v1 first" href="#" data-procedura="FIRST()" data-url="get_first_element_Z4"  >first elements</a>
                                <a class="button-v1 first10" href="#" data-procedura="FIRST10()" data-url="get_first_element_Z4">first 10 elements</a>
                                <a class="button-v1 first100" href="#" data-procedura="FIRST100()" data-url="get_first_element_Z4">first 100 elements</a>
                                <a class="button-v1 last" href="#" data-procedura="LAST()" data-url="get_first_element_Z4">last elements</a>
                                <a class="button-v1 last10" href="#" data-procedura="LAST10()" data-url="get_first_element_Z4">last 10 elements</a>
                                <a class="button-v1 last100" href="#" data-procedura="LAST100()" data-url="get_first_element_Z4">last 100 elements</a>
                                <a class="button-v1 rand" href="#" data-procedura="RAND()" data-url="get_first_element_Z4">rand element</a>
                                <a class="button-v1 get_data_interwal" href="#" data-procedura="GET_INTERWAL(600,700)" data-url="get_first_element_Z4">elements id>600 and id<700</a>
                                <a class="button-v1 count_element" href="#" data-procedura="GET_COUNT()" data-url="get_count_Z4">count elements</a>
                                <a class="button-v1 all_elements" href="#" data-procedura="ALL_ELEMENT()" data-url="get_first_element_Z4">all elements</a>


                        </div>
                </div>
        </div>
</section>


<!-- Modal -->
<div id="check" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрити</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        <input type="text" class="val1" >
        <label>+</label>
        <input type="text" class="val2" >
        <label>=</label>
        <input type="text" class="res" >
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-primary check-sum">get data</button>
      </div>
    </div>
  </div>
</div>
<?php
/*
$addr = array(
    "given" => "Chris",
    "family"=> "Dumars",
    "address"=> array(
        "lines"=> "458 Walkman Dr.
        Suite #292",
        "city"=> "Royal Oak",
        "state"=> "MI",
        "postal"=> 48046,
      ),
  );
$invoice = array (
    "invoice"=> 34843,
    "date"=> "2001-01-23",
    "bill-to"=> $addr,
    "ship-to"=> $addr,
    "product"=> array(
        array(
            "sku"=> "BL394D",
            "quantity"=> 4,
            "description"=> "Basketball",
            "price"=> 450,
          ),
        array(
            "sku"=> "BL4438H",
            "quantity"=> 1,
            "description"=> "Super Hoop",
            "price"=> 2392,
          ),
      ),
    "tax"=> 251.42,
    "total"=> 4443.52,
    "comments"=> "Late afternoon is best. Backup contact is Nancy Billsmer @ 338-4338.",
    );

// создание YAML-представления заказа
$yaml = yaml_emit($invoice);
var_dump($yaml);

// преобразование YAML обратно в PHP-переменную
$parsed = yaml_parse($yaml);

// проверка на соответствие оригинала и результата конвертации в YAML и обратно
var_dump($parsed == $invoice);
?>

*/
?>


<script type="text/javascript">
    $(document).ready(function(){

      $('.button-v1').click(function(){

        $('#check').modal('show');
        $('.val1').val(randomInteger(1,5));
        $('.val2').val(randomInteger(1, 5));

        var attr1 = $(this).attr('data-procedura');
        var attr2 = $(this).attr('data-url');
        //alert(attr2);

        $('.check-sum').attr('data-url', attr2);
        $('.check-sum').attr('data-procedura', attr1);

      });

      function randomInteger(min, max) {
        var rand = min + Math.random() * (max - min)
        rand = Math.round(rand);
        return rand;
      }

      function getDataDB(url, procedura){

      var radio = $('#radio input');
      var format ='';
      for (var i = 0; i < radio.length; i++) {
        if($('#radio'+i).prop("checked")){
          format = $('#radio'+i).val();
        }
      }


        $.ajax({
        type:"POST",
        url: url,
        data: {
          procedura:procedura,
          format:format
        },
        dataType:"json",
            success: function(data){
              window.location = "files/"+data;
              /*
              console.log(data['format']);
              if(data['format']=='XML'){
                  window.location = "files/"+data['name'];
              }else{

              }
              */
            },
            error: function(){
                alert('skończył się limit zapytań dla jednego użytkownika');
            }
        });


      }
      $('.check-sum').click(function(){
          var val1 = $('.val1').val();
          var val2 = $('.val2').val();
          var sum = $('.res').val();
          var a = Number(val1) + Number(val2);

          if(Number(a) == Number(sum)){
              $('#check').modal('hide');
              var procedura = $('.check-sum').attr('data-procedura');
              var url = $('.check-sum').attr('data-url');
              getDataDB(url, procedura);
          }else{
              var val1 = $('.val1').val('');
              var val2 = $('.val2').val('');
              var sum = $('.res').val('');
              $('#check').modal('hide');

          }

      });


    });

</script>
