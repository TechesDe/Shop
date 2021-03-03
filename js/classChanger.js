function setUniqueClass(id,name,defaultClassName,formid){
  let self=document.getElementById(id);
  let form=document.getElementById(formid);
  while(document.getElementsByClassName('name').length>0){
    if(document.getElementsByClassName('name')[0]==self){
        from.submit();
    }
    else{
      document.getElementsByClassName('name')[0].classList.add(defaultClassName);
      document.getElementsByClassName('name')[0].classList.remove(name);
    }
  }
self.className=name;
from.submit();
}

function al(){
  alert(this);
}
