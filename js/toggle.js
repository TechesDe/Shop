function transToogle(pos,val,prefix){
  let input=document.getElementById(prefix+"Input");
  input.setAttribute("value",val);
  let find=false;
  let nonactive=document.getElementsByClassName("non-active circle");
  for(let i=0;i<nonactive.length;i++){
    if((nonactive[i].getAttribute('pos')==pos)&&(nonactive[i].getAttribute("id").includes(prefix))){
      nonactive=nonactive[i];
      find=true;
      break;
    }
  }
  if(!find)
    return;
  let action=document.getElementById(prefix+"active");
  let margin=window.getComputedStyle(document.getElementsByClassName('circle')[0],null).getPropertyValue("margin-top");
  let top=((pos-action.getAttribute('currntpos')))*(2*parseInt(margin) + nonactive.offsetHeight);
  action.setAttribute("style","top:"+top+"px;");
  top=((action.getAttribute('pos')-nonactive.getAttribute('currntpos')))*(2*parseInt(margin) + nonactive.offsetHeight);
  nonactive.setAttribute("style","top:"+top+"px;");
  nonactive.setAttribute("pos",action.getAttribute('pos'));
  action.setAttribute('pos', pos);
  action.style.display="block";
}

function clearToggle(prefix){
  let nonactive=document.getElementsByClassName("non-active circle");
  for(let i=0;i<nonactive.length;i++){
    nonactive[i].setAttribute('pos',nonactive[i].getAttribute('currntpos'));
    nonactive[i].setAttribute("style","top: 0px;");
  }
  let action=document.getElementById(prefix+"active");
  action.setAttribute('pos',action.getAttribute('currntpos'));
  action.setAttribute("style","top: 0px;");
  let input=document.getElementById(prefix+"Input");
  input.setAttribute("value","");
}
