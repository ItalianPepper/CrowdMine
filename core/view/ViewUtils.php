<?php


/**
 * @param int $currentPage current visited page
 * @param int $numPages complete pagination size
 * @param int $maxButtons = '6' maximum number of buttons allowed, including ellipsis buttons (max number must be >3)
 */
function showPaginationButtons($currentPage, $numPages, $maxButtons=6)
{

    //maxButtons max number of buttons - [...] included

    //start/end indices for buttons
    $is = 1;
    $ie = $numPages;

    //ellipsis enabled for buttons after currentPage
    $nextEllipsis = false;

    /*Previous button*/
    if ($currentPage < 2) {
        echo "<li class='disabled'><a aria-label='Previous'>
                <span aria-hidden='true'>&laquo;</span>
              </a></li>";
    } else {
        echo "<li><a href='?page=" . ($currentPage - 1) . "' aria-label='Previous'>
                <span aria-hidden='true'>&laquo;</span>
             </a></li>";
    }

    //starting point for the index, half back, half-1 front
    $is = $currentPage - floor($maxButtons/2);
    $ie = $currentPage + ceil($maxButtons/2)-1;

    //boundaries for indices, $is must be greater than 1
    if($is<1){
        //number of buttons lost now return by the other index
        $ie+=1-$is;
        $is=1;
    }

    //$ie always before numPages
    if($ie>$numPages){
        //number of buttons lost now return by the other index
        $is+=$numPages-$ie;
        $ie=$numPages;
    }

    //clean carries
    if($is<1) $is=1;

    //enabling ellipsis for the buttons after currentPage
    if ($ie < $numPages) {
        $nextEllipsis = true;
        $ie -= 1;
    }
    //ellipsis for the buttons before current page
    if ($is > 1) {
        echo "<li><a>...</a></li>";
        $is += 1;
    }


    /*Numbered buttons*/
    for ($i = $is; $i < $currentPage; $i++) {
        echo "<li><a href='?page=" . $i . "'>" . $i . "</a></li>";
    }

    echo "<li class='active'><a>" . $currentPage . "</a></li>";

    for ($i = $currentPage + 1; $i <= $ie; $i++) {
        echo "<li><a href='?page=" . $i . "'>" . $i . "</a></li>";
    }

    if ($nextEllipsis == true)
        echo "<li><a>...</a></li>";


    /*Next button*/
    if ($currentPage >= $numPages) {
        echo "<li class='disabled'><a aria-label='Next'>
                <span aria-hidden='true'>&raquo;</span>
              </a></li>";
    } else {
        echo "<li><a href='?page=" . ($currentPage + 1) . "' aria-label='Next'>
               <span aria-hidden='true'>&raquo;</span>
              </a></li>";
    }
}


/**
 * generate random color based on hash string
 *
 * @param $hash
 * @param float $lumCap maximum luminance value (default 0.82)
 * @return string
 */
function colorByHash($hash, $lumCap=0.82){


    $f = 255; //luminance scale factor

    mt_srand(crc32($hash));

    $r = mt_rand(0,255)/255;
    $g = mt_rand(0,255)/255;
    $b = mt_rand(0,255)/255;

    $luminance = 0.2126*$r + 0.7152*$g + 0.0722*$b;

    //reducing by same percentage of lumCap (darker colors)
    if($luminance>$lumCap)
        $f=$lumCap*255;

    $r*=$f;
    $g*=$f;
    $b*=$f;

    return sprintf('#%02X%02X%02X', $r,$g,$b);
}

/**
 * print a label with random generated background color
 * @param String $hash seed for random generator
 * @param String $content text content
 */
function randomColorLabel($hash, $content){
    echo "<span class='label label-primary' style='background-color:".colorByHash($hash)."';>".$content."</span>";
}

?>