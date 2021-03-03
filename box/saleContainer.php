<link rel="stylesheet" href="/css/sale.css">
<script type="text/javascript" src="/js/cssRedactor.js"></script>
<script>
var moveLine=setInterval(
  function movePromo(){
    let c=document.getElementsByClassName('salesLine')[0].children.length;
    for(let i=0; i<c+1;i++){
      let firstprom=document.getElementsByClassName('salesLine')[0].firstElementChild;
      document.getElementsByClassName('salesLine')[0].firstElementChild.remove();
      document.getElementsByClassName('salesLine')[0].firstElementChild.style.display="none";
      document.getElementsByClassName('salesLine')[0].append(firstprom);
    }
    if(c>1){
      document.getElementsByClassName('salesLine')[0].children[0].style.display="";
      document.getElementsByClassName('salesLine')[0].children[1].style.display="";
    }
  },
  15000
);

/*
for(let i=0; i<c+1;i++){
  let firstprom=document.getElementsByClassName('line')[document.getElementsByClassName('line').length-1];
  document.getElementsByClassName('line')[document.getElementsByClassName('line').length-1].remove();
  document.getElementsByClassName('salesLine')[0].prepend(firstprom);
}
*/
</script>
<div class="saleBlock">



  <div class="salesLine">

    <div class="center" style="">
      <div class="promo">
        <h2>Приветсвенная открытка</h2>
        <h3>Скидка на <b>ВСЕ</b></h3>
        <p>-5% на любой товар заказаный на сайте</p>

      </div>
    </div>

    <div class="center" style="">
      <div class="promo">
        <h2>Заходи на чай</h2>
        <p>С новыми чайниками Centeck</p>
        <p>Любой вечер теплее</p>
      </div>
    </div>

    <div class="center" style="display: none">
      <div class="promo">
        <p>-15% на любой холодильник</p>
      </div>
      <div class="promo"><p>Some sale here 2</p></div>
    </div>

    <div class="center" style="display: none">
      <div class="promo">
        <h2>Весна на горизонте</h2>
        <p>В городе негде сажать?!</p>
        <p>Мини огорд поместится везде!</p>
      </div>
    </div>
  </div>
</div>
