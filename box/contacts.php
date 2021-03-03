<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Play&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/calls.css">
<script type='text/javascript' src='/js/cssRedactor.js'></script>

<div class="calls">
  <div class="wrapper"><span id="callsInner" class="orange-btm" onclick="showAndHideCalls()">❮ Показать контакты</span></div>
  <div class="hidden">
    <div class="infoCalls">
      <div class="phone">+7(900)-000-##-##</div>
      <div class="email">some@email.net</div>
    </div>
  </div>
</div>

<script>
let callsState=false;
function showAndHideCalls(){
  if(!callsState){
    cssCorrect('calls','.infoCalls','right','0%');
    callsState=true;
    document.getElementById('callsInner').innerHTML="❯ Спрятать контакты";
  }
  else {
    cssCorrect('calls','.infoCalls','right','-100%');
    callsState=false;
    document.getElementById('callsInner').innerHTML="❮ Показать контакты";
  }
}
</script>
