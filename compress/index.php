<?php
ini_set('memory_limit', '-1');
require ("JavascriptMinifier.phpclass") ;
require ("CssMinifier.phpclass") ;
include_once("minifier.php");
$minifiercss = new CssMinifier();

function recursiveGlob($pattern,$type="{jpg,png,gif}",$out=array())
{
    $dirs = glob($pattern . '/*', GLOB_ONLYDIR);
    $files = glob($pattern."/*.".$type, GLOB_BRACE);
    foreach ($dirs as $dir) {
        if(!$out || $out && !in_array(explode("/",$dir)[count(explode("/",$dir))-1],$out)){
        $subDirList = recursiveGlob($dir,$type);
        $files = array_merge($files, $subDirList);
        }
    }

    return $files;
}
function minifyCss($css) {
  // some of the following functions to minimize the css-output are directly taken
  // from the awesome CSS JS Booster: https://github.com/Schepp/CSS-JS-Booster
  // all credits to Christian Schaefer: http://twitter.com/derSchepp
  // remove comments
  $css = file_get_contents($css);
  $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
  // backup values within single or double quotes
  preg_match_all('/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER);
  for ($i=0; $i < count($hit[1]); $i++) {
    $css = str_replace($hit[1][$i], '##########' . $i . '##########', $css);
  }
  // remove traling semicolon of selector's last property
  $css = preg_replace('/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css);
  // remove any whitespace between semicolon and property-name
  $css = preg_replace('/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css);
  // remove any whitespace surrounding property-colon
  $css = preg_replace('/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css);
  // remove any whitespace surrounding selector-comma
  $css = preg_replace('/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css);
  // remove any whitespace surrounding opening parenthesis
  $css = preg_replace('/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css);
  // remove any whitespace between numbers and units
  $css = preg_replace('/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css);
  // shorten zero-values
  $css = preg_replace('/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css);
  // constrain multiple whitespaces
  $css = preg_replace('/\p{Zs}+/ims',' ', $css);
  // remove newlines
  $css = str_replace(array("\r\n", "\r", "\n"), '', $css);
  // Restore backupped values within single or double quotes
  for ($i=0; $i < count($hit[1]); $i++) {
    $css = str_replace('##########' . $i . '##########', $hit[1][$i], $css);
  }
  return $css;
}
function compress($source, $destination, $quality) {
    $info = getimagesize($source);
    if(!$info)
    return null;
    if ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);
    else
     $image = imagecreatefromjpeg($source);
    imagejpeg($image, $destination, $quality);
    return $image;
}
$uploads_dir = dirname(__FILE__) . '';
$dir   = explode((strpos($uploads_dir,"\\")?"\\":"/"),$uploads_dir);
unset($dir[count($dir)-1]);
$dir = join((strpos($uploads_dir,"\\")?"\\":"/"),$dir);
$files = recursiveGlob($dir,"{jpg,jpeg,css,js}",array("admin","html"));
$minified_contents = "";
$filessize = 0;
$filescss = 0;
$filesjs = 0;
$filesimage = 0;
$nfilessize = 0;
$index = 0;
 foreach($files as $file){
  $ext = pathinfo($file, PATHINFO_EXTENSION);
  $filesize = filesize($file);
  switch($ext){
  case "css":
    //$minified_contents	=  $minifiercss -> MinifyFrom ($file);
    $minified_contents	= minifyCss($file);
    if($minified_contents)
    $filescss++;
    file_put_contents($file,$minified_contents);
   break;
   case "js":
    $js = file_get_contents($file);
    $minified_contents = \JShrink\Minifier::minify($js,array('flaggedComments' => false));
    if($minified_contents)
    $filesjs++;
    file_put_contents($file,$minified_contents);
   break;
   default:
      $minified_contents = compress($file,$file,20);
       if($minified_contents)
    $filesimage++;
   break;
  }

    if($minified_contents){
      clearstatcache();
      $nfilesize = filesize($file);
      $filessize +=  $filesize;
      $nfilessize +=  $nfilesize;
      echo "#".($index+1)." ".$file." / Before: ".$filesize." After: ".$nfilesize." Minified: ".($filesize-$nfilesize).'<br>';
    }
    $index++;
      $minified_contents = "";
 }
echo "<br><br><strong>All Minified Files:(".($filescss+$filesjs+$filesimage).") Css:(".$filescss.") Js:(".$filesjs.") Image:(".$filesimage.")  Size:(".$filessize.") To (".$nfilessize.") .</strong>" ;
 ?>