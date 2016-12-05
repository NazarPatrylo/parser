
<header class="header-menu">
        <div class="container">
                <div class="row">
                        <div class="col-sm-12 text-center">
                                <h1>zadanie #2</h1>
                                <p>Mechanizm wyszukiwania danych z bazy danych za pomocą procedur.</p>
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
                                <a class="button-v1 first" href="#">first elements</a>
                                <a class="button-v1 first10" href="#">first 10 elements</a>
                                <a class="button-v1 first100" href="#">first 100 elements</a>
                                <a class="button-v1 last" href="#">last elements</a>
                                <a class="button-v1 last10" href="#">last 10 elements</a>
                                <a class="button-v1 last100" href="#">last 100 elements</a>
                                <a class="button-v1 rand" href="#">rand element</a>
                                <a class="button-v1 get_data_interwal" href="#">elements id>600 and id<700</a>
                                <a class="button-v1 count_element" href="#">count elements</a>
                                <a class="button-v1 all_elements" href="#">all elements</a>
                                
                        </div>
                </div>
        </div>
</section>

<script type="text/javascript">
    $(document).ready(function(){

      $('.first').click(function(){ getDataDB('get_first_element','FIRST()') });
      $('.first10').click(function(){ getDataDB('get_first_element','FIRST10()') });
      $('.first100').click(function(){ getDataDB('get_first_element','FIRST100()') });

      $('.last').click(function(){ getDataDB('get_first_element','LAST()') });
      $('.last10').click(function(){ getDataDB('get_first_element','LAST10()') });
      $('.last100').click(function(){ getDataDB('get_first_element','LAST100()') });

      $('.rand').click(function(){ getDataDB('get_first_element','GET_RAND()') });
      $('.get_data_interwal').click(function(){ getDataDB('get_first_element','GET_INTERWAL(600,700)') });
      $('.count_element').click(function(){ getDataDB('get_count','GET_COUNT()') });
      $('.all_elements').click(function(){ getDataDB('get_first_element','ALL_ELEMENT()') });

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
                console.log('error');
            }
        });
      }

    });

</script>



