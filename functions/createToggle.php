<link rel="stylesheet" href="/css/toggle.css">
<script>
    function transToogle(idfrom,prefix){
        let from=document.getElementById(idfrom);
        let input=document.getElementById(prefix+"Input");
        let action=document.getElementById(prefix+"active");
        let margin=window.getComputedStyle(from,null).getPropertyValue("margin-top");
        let pos=from.getAttribute("pos");
        let pos2=action.getAttribute("pos");
        let currentpos=from.getAttribute("currntpos");
        let currentpo2=action.getAttribute("currntpos");
        let val1=from.getAttribute("val");
        let val2=action.getAttribute("val");
        let top=((pos-currentpo2))*(2*parseInt(margin) + from.offsetHeight);
        action.setAttribute("style","top:"+top+"px;");
        //action.style.top=top;
        action.setAttribute("pos",pos);
        action.setAttribute("val",val1);
        top=((pos2-currentpos))*(2*parseInt(margin) + from.offsetHeight);
        from.setAttribute("style","top:"+top+"px;");
        //from.style.top=top;
        from.setAttribute("pos",pos2);
        from.setAttribute("val",val2);
        action.style.display="block";
        input.setAttribute("value",action.getAttribute("val"));
        if(from.getAttribute("val")==""){
            from.style.opacity=.0;
        }
    }
</script>

<?php


function createToggleFromMassive($massive,$prefix,$name){
    $toggle='
    <div class="toggle">
        <input id="'.$prefix.'Input" style="display:none" type="text" name="'.$name.'" value="">';
    for($i=0;$i<count($massive);$i++){
        $toggle=$toggle.'
        <div class="opt">
            <div id="'.$prefix.$i.'" onclick="transToogle(\''.$prefix.$i.'\',\''.$prefix.'\')" class="non-active circle" pos="'.$i.'" val="'.$massive[$i].'" currntpos="'.$i.'" style="top:0px; opacity:1"></div>
            <p class="option">'.$massive[$i].'</p>
        </div>';
    }
    $toggle=$toggle.'
    </div>
    <div id="'.$prefix.'active"class="active circle" val="" pos="'.count($massive).'" currntpos="'.count($massive).'" style="top:0px; display:none"></div>
    ';
    return $toggle;
}
?>
