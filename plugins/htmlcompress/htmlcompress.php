<?php
/*
Plugin Name: Html Compress
Plugin URI: https://github.com/Vtrois/Dobby/tree/master/plugins
Description: Used to compress the page size and improve loading speed.
Version: 1.0.9
Author: Vtrois
Author URI: https://www.vtrois.com/
License: GNU General Public License v3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

add_action('get_header', 'dobby_compress_html');

function dobby_compress_html(){
    function dobby_compress_html_main ($buffer){
        $initial=strlen($buffer);
        $buffer=explode("<!--Dobby-Compress-html-->", $buffer);
        $count=count ($buffer);
        for ($i = 0; $i <= $count; $i++){
            if (stristr($buffer[$i], '<!--Dobby-Compress-html-no-compression-->')) {
                $buffer[$i]=(str_replace("<!--Dobby-Compress-html-no-compression-->", " ", $buffer[$i]));
            } else {
                $buffer[$i]=(str_replace("\t", " ", $buffer[$i]));
                $buffer[$i]=(str_replace("\n\n", "\n", $buffer[$i]));
                $buffer[$i]=(str_replace("\n", "", $buffer[$i]));
                $buffer[$i]=(str_replace("\r", "", $buffer[$i]));
                while (stristr($buffer[$i], '  ')) {
                    $buffer[$i]=(str_replace("  ", " ", $buffer[$i]));
                }
            }
            $buffer_out.=$buffer[$i];
        }
        $final=strlen($buffer_out);   
        $savings=($initial-$final)/$initial*100;   
        $savings=round($savings, 2);   
        $buffer_out.="\n<!-- Initial: $initial bytes; Final: $final bytes; Reduce：$savings% :D -->";   
    return $buffer_out;
}
	ob_start("dobby_compress_html_main");
}

add_filter( "the_content", "dobby_unCompress");

function dobby_unCompress($content) {
    if(preg_match_all('/(crayon-|<\/pre>)/i', $content, $matches)) {
        $content = '<!--Dobby-Compress-html--><!--Dobby-Compress-html-no-compression-->'.$content;
        $content.= '<!--Dobby-Compress-html-no-compression--><!--Dobby-Compress-html-->';
    }
    return $content;
}