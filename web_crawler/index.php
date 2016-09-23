<?php

function webCrawler($link,$depth) {

    if($depth<0) {

     return $jsonlinks;

    }

    $html = file_get_contents($link);

    $dom = new DOMDocument;

    @$dom->loadHTML($html);

    $links = $dom->getElementsByTagName('a');

    $imgfind=$dom->getElementsByTagName('img');
    
    echo '<ul>';

    foreach ($links as $link){

       echo '<li>Title:'.$dom->getElementsByTagName('title')->item(0)->textContent.'</li>';

       echo '<li>Link:'.$link->getAttribute('href').'.</li>';

               foreach($imgfind as $im) {
                     echo '<li>'."<img src='".$im->getAttribute('src')."'/>".'</li>';
               }

        $depth=$depth-1;

       return webCrawler($link->getAttribute('href'),$depth);
    }
    echo '</ul>';
}

$output=webCrawler('page1.html',3);

echo $output;

?>