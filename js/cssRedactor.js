
function cssCorrect(file,selector,property,value){
  //alert('start');
  let styleSheet=null;
  let cssText=null;
  let numSheet=-1;
  let numProrerty=-1;
  for(let i=0;i<document.styleSheets.length;i++)
    if(document.styleSheets[i].href.indexOf(file+'.css')!=-1){
      styleSheet=document.styleSheets[i];
      numSheet=i;
      break;
    }
  if(styleSheet!=null){

    for(let i=0;i<styleSheet.cssRules.length;i++){
      css=styleSheet.cssRules[i].cssText;
      css=css.replace(/\s+/g, '');
      cssSelector=css.slice(0,css.indexOf(('{')));
      selector=selector.replace(/\s+/g, '');

      if(selector==cssSelector){
        cssText=styleSheet.cssRules[i].cssText;
        numProrerty=i;


        if(cssText.includes(property+':')){
          startpos=cssText.indexOf(property+':');
          endpos=cssText.indexOf(';',startpos);
          strtoReplace=cssText.slice(startpos,endpos);
          cssText=cssText.replace(strtoReplace,property+':'+value);
        }
        else{
          cssText=cssText.slice(0,cssText.length-2);
          cssText=cssText+property+':'+value+';}';
        }
        document.styleSheets[numSheet].deleteRule(numProrerty);
        document.styleSheets[numSheet].insertRule(cssText);
        break;
        }
      }
    }
}

function showAllCss(file){
  let cssText='';
  for(let i=0;i<document.styleSheets.length;i++)
    if(document.styleSheets[i].href.indexOf(file+'.css')!=-1){
      for(let j=0;j<document.styleSheets[i].cssRules.length;j++){
        cssText=cssText+document.styleSheets[i].cssRules[j].cssText;
      }
      break;
    }
  alert(cssText);
}
