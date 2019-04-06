<?php
/**
 * render pagination with bootstrap
 *
 * @param $pag - Parameters of pages ['first_page' => int, 'current_page' => int, 'last_page' => int, 'count' => int]
 * @param array $param - additional GET parameters
 * @param int $count - counts row at page
 * @return string - HTML div with paginate button
 */
function pagination_render($pag,$param = [],$count = 3)
{
    $html = "<div class=\"pagination row\">";

    $sort = null;

    foreach ($param as $key => $row )
        $sort .= '&'.$key.'='.$row;

    if ($pag['current_page'] - 2 > 1) {
        $html .= "<a href='./?page=1&count=$count$sort' class='btn btn-light'>1</a>";

        if ($pag['current_page'] - 3 > 1) {
            $html .= " &hellip; ";
            $html .= "<a href='./?page=" . ($pag['current_page'] - 1) . "&count=$count$sort' class='btn btn-light'>&laquo;</a>";
            $html .= " . ";
        }
    }
    if (($pag['current_page'] - 2) > 1)
        $n = $pag['current_page'] - 2;
    else
        $n = 1;

    if (($pag['current_page'] + 2) < $pag['last_page'])
        $m = $pag['current_page'] + 3;
    else
        $m = $pag['last_page'] + 1;

    for ($i = $n; $i < $m; $i++) {
        $html .= "<a href='./?page=$i&count=$count$sort' ";
        if ($pag['current_page'] == $i)
            $html .= " class='btn btn-secondary text-light disabled' ";
        else
            $html .= " class='btn btn-light' ";
        $html .= ">$i</a>";
    }

    if ($pag['current_page'] + 2 < $pag['last_page']) {
        if ($pag['current_page'] + 3 < $pag['last_page']) {
            $html .= " . ";
            $html .= "<a href='./?page=" . ($pag['current_page'] + 1) . "&count=$count$sort' class='btn btn-light'>&raquo;</a>";
            $html .= " &hellip; ";
        }
        $html .= "<a href='./?page=" . $pag['last_page'] . "&count=$count$sort' class='btn btn-light'>" . $pag['last_page'] . "</a>";
    }
    $html .= "</div>";
    return $html;
}

