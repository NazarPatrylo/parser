
<header class="header-menu">
        <div class="container">
                <div class="row">
                        <div class="col-sm-12 text-center">
                                <h1>zadanie #1</h1>
                                <p>Mechanizm wyszukiwania danych i wprowadzenie ich do bazy danych.</p>
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
                                <a class="button-v1 pars"  href="#">Wyszukiwanie produktów</a>
                                <a class="button-v1 prod" href="#">Dodawanie produktów do bazy danych</a>
                                <br>

                                <div class="main text-left">

                                </div>

                        </div>
                </div>
        </div>
</section>

<script type="text/javascript">
    $(document).ready(function(){

        $('.pars').click(function(){
            alert('start search');
          for (var i = 2; i < 100; i++) {
             getData(i);
          }
         getData(25);
        });

        function getData(i){
          var url = 'http://rozetka.com.ua/notebooks/c80004/filter/page='+i+'/';
          var elem = 'div.g-i-tile-catalog .g-i-tile-i-image>.responsive-img';
          $.ajax({
          type:"POST",
          url:"get_link",
          data: {
              url: url,
              elem: elem
          },
          dataType:"json",
              success: function(data){
                  for (var k = 0; k < data.length; k++) {
                    $('.main').append('<a href="'+data[k]+'">'+data[k]+'</a><br>');
                  }
              },
              error: function(){
                  console.log('error');
              }
          });
        }

        $('.prod').click(function(){
          alert('start add to DB');
          var links = $('.main a');
          $('.main a').remove();
          $('.main br').remove();
          for (var i = 0; i < links.length; i++) {
            console.log(links[i].href);
            var url = links[i].href;
            $('.main').append('<p><a href="'+links[i]+'">'+links[i]+'</a> add to DB - OK</p>');
            var elem = 'section.detail-tabs-i dl.detail-chars-l dd.detail-chars-l-i-field';
            $.ajax({
            type:"POST",
            url:"get_produkt",
            data: {
                url: url,
                elem: elem
            },
            dataType:"json",
                success: function(data){
                  console.log(data);

                },
                error: function(){
                    console.log('error');
                }
            });
          }
        });
    });

</script>
