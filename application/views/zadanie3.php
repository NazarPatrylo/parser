
<header class="header-menu">
        <div class="container">
                <div class="row">
                        <div class="col-sm-12 text-center">
                                <h1>zadanie #3</h1>
                                <p>Bezpieczne wyszukiwania danych z bazy danych za pomocą procedur.</p>
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
                                <br>
                                <br>
                                <a class="button-v1 first" href="#" data-procedura="FIRST()" data-url="get_first_element_Z3"  >first elements</a>
                                <a class="button-v1 first10" href="#" data-procedura="FIRST10()" data-url="get_first_element_Z3">first 10 elements</a>
                                <a class="button-v1 first100" href="#" data-procedura="FIRST100()" data-url="get_first_element_Z3">first 100 elements</a>
                                <a class="button-v1 last" href="#" data-procedura="LAST()" data-url="get_first_element_Z3">last elements</a>
                                <a class="button-v1 last10" href="#" data-procedura="LAST10()" data-url="get_first_element_Z3">last 10 elements</a>
                                <a class="button-v1 last100" href="#" data-procedura="LAST100()" data-url="get_first_element_Z3">last 100 elements</a>
                                <a class="button-v1 rand" href="#" data-procedura="RAND()" data-url="get_first_element_Z3">rand element</a>
                                <a class="button-v1 get_data_interwal" href="#" data-procedura="GET_INTERWAL(600,700)" data-url="get_first_element_Z3">elements id>600 and id<700</a>
                                <a class="button-v1 count_element" href="#" data-procedura="GET_COUNT()" data-url="get_count_Z3">count elements</a>
                                <a class="button-v1 all_elements" href="#" data-procedura="ALL_ELEMENT()" data-url="get_first_element_Z3">all elements</a>

                                
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
  
        $.ajax({
        type:"POST",
        url: url,
        data: {
          procedura:procedura
        },
        dataType:"json",
            success: function(data){
                window.location = "files/"+data;                  
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



