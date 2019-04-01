<?php

$html = "<div class=\"pagination row\">";

$count = 3;
$sort = null;

if (!empty($task['order']['field']))
$sort='&sort='.$task['order']['field'].'&dir='.$task['order']['dir'];

$pag=$task['pagination'];


if ($pag['current_page']-3>1){
    $html.="<a href='./?page=1&count=$count$sort' class='btn btn-light'>1</a>";

        if ($pag['current_page']-4>1) {
            $html.=" &hellip; ";
            $html.="<a href='./?page=".($pag['current_page']-1)."&count=$count$sort' class='btn btn-light'>&laquo;</a>";
            $html.=" . ";
        }
    }
if (($pag['current_page']-3)>1)
    $n= $pag['current_page']-3;
else
    $n=1;

if (($pag['current_page']+3)<$pag['last_page'])
    $m = $pag['current_page']+4;
else
    $m=$pag['last_page']+1;

for($i = $n; $i < $m; $i++){
    $html.="<a href='./?page=$i&count=$count$sort' ";
     if ($pag['current_page']==$i)
         $html.= " class='btn btn-secondary text-light disabled' ";
     else
         $html.= " class='btn btn-light' ";
     $html.= ">$i</a>";
    }

if ($pag['current_page']+3<$pag['last_page']) {
    if ($pag['current_page'] + 4 < $pag['last_page']) {
        $html .= " . ";
        $html .= "<a href='./?page=" . ($pag['current_page'] + 1) . "&count=$count$sort' class='btn btn-light'>&raquo;</a>";
        $html .= " &hellip; ";
    }
    $html .= "<a href='./?page=" . $pag['last_page'] . "&count=$count$sort' class='btn btn-light'>" . $pag['last_page'] . "</a>";
}
$html.= "</div>";
return $html;
?>


