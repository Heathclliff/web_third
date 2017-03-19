
<?php
header("Content-type: text/html; charset=utf-8");
function listing ($url,$mode) {
if (is_dir($url)) {
    if ($dir = opendir($url)) {
        while ($file = readdir($dir)) {
                   if ($file != "." && $file != "..") {
                     if(is_dir($url."/".$file)) {
                     	$folders[] = $file;
                     }
                     else {$files[] = $file;}
                       }
          }
        }
        closedir($dir);
}
   if($mode == 1) {return $folders;}
   if($mode == 0) {return $files;}
}


function makedir ($url){
                   $url = trim(htmlspecialchars($url));
                   if(@mkdir($url)){return TRUE;}
                   else{return FALSE;} }
function frename ($url,$oldname,$nname){
                   $nname = trim(htmlspecialchars($nname));
                   $oldname = trim(htmlspecialchars($oldname));
                   $url = trim(htmlspecialchars($url));
                   if(@rename($url."/".$oldname,$url."/".$nname)) {return TRUE; }
                   else {return FALSE; } }
function removedir ($directory) {
  $dir = opendir($directory);
  while(($file = readdir($dir)))
  {
    if ( is_file ($directory."/".$file))
    {
      unlink ($directory."/".$file);
    }
    else if ( is_dir ($directory."/".$file) &&
             ($file != ".") && ($file != ".."))
    {
      removedir ($directory."/".$file);
    }
  }
  closedir ($dir);
  rmdir ($directory);

  return TRUE;
  }
function removefile ($path) {
         if(unlink($path)) { return TRUE; }
         else {	return FALSE; } }
function updir( $path ){
$last = strrchr( $path, "/" );
$n1 = strlen( $last );
$n2 = strlen( $path );
return substr( $path, 0, $n2-$n1 ); }

function fsize($path) {
                   return substr(filesize($path)/1024, 0, 4);
                           }
?>
