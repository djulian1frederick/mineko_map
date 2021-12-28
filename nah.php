<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="js/jquery.tinyTips.js"></script>
<script type="text/javascript" src="js/func.js"></script>

<input id="search" size="20" />
<p></p>
<ul id="search-items">
  <li>Помидор</li>
  <li>Огурец</li>
  <li>Свекла</li>
  <li>Капуста</li>
  <li>Баклажан</li>
  <li>Лук</li>
</ul>


<script>
	$(function(){
  $('input#search').on('input', function(){
    var str = $(this).val().toLowerCase();
    if (str.length <= 2){
      $('ul#search-items li').show();
      $('p').text('Введите не менее 3 символов');
    }
    else {
      $('ul#search-items li').each(function(){
        if ($(this).text().toLowerCase().indexOf(str) < 0){
          $(this).hide();
        }
      });  
    }    
  });
});
</script>