  <?php
$url=".";
header("Content-type: text/html; charset=utf-8");
include("functions.php");
if($_GET['url']) {$url = $_GET['url']; }
echo 'Текущая директория: &nbsp;'.$url.'<br/>';

echo '<a href="/index.php?url=.">Домой</a>&nbsp;&nbsp;';
echo '<a href="index.php?url='.updir($url).'">Вверх</a>&nbsp;&nbsp;';
echo '<a href="index.php?mkdir=1&url='.$url.'">Создать папку</a><br/><br/>';
  if(listing($url,1)) {
foreach(listing($url,1) as $f) {
echo '<a href="index.php?rename=1&url='.$url.'&fname='.$f.'">Переименовать  </a>';
echo '<a href="index.php?rmdir=1&url='.$url.'&fname='.$f.'">Удалить  </a>&nbsp;';
echo 'Directory:<a href="index.php?url='.$url."/".$f.'&oldurl='.$url.'">'.$f.'</a><br/>';
}}
if(listing($url,0)) {
foreach(listing($url,0) as $f) {
echo '<a href="index.php?rename=1&url='.$url.'&fname='.$f.'">Переименовать файл   |</a>';
echo '<a href="index.php?rmfile=1&url='.$url.'&fname='.$f.'" >Удалить файл  </a>&nbsp;';
echo ''.$f.' - '.fsize($url."/".$f).'Кб<br/>';
}}
if($_GET['mkdir'])
{
	if(!$_POST['add']) {
echo '<br/><form name="" action="?mkdir=1" method="post">';
echo 'Имя новой папки:<br/>';
echo '<input name="ndir" type="text" value="" maxleight="25">';
echo '<input name="url" type="hidden" value="'.$_GET['url'].'"><br/>';
echo '<input type="submit" name="add" value="создать"></form>'; }
   else {
      if(makedir($_POST['url']."/".$_POST['ndir'])!== FALSE) {
      header("location:index.php?url=".$_POST['url']); 	}
                   else {echo 'Ошибка <br/>';}
                   }}
if($_GET['rmdir']){
    if(removedir($_GET['url']."/".$_GET['fname']) !== FALSE) {
	header("location:index.php?url=".$_GET['url']);
	} }
if($_GET['rmfile']){
    if(removefile($_GET['url']."/".$_GET['fname']) !== FALSE) {
	header("location:index.php?url=".$_GET['url']);
 	  } }
if($_GET['rename'])
{
	if(!$_POST['rename']) {
echo '<br/><form name="" action="?rename=1" method="post">';
echo 'Новое имя:<br/>';
echo '<input name="nname" type="text" value="'.$_GET['fname'].'" maxleight="25">';
echo '<input name="url" type="hidden" value="'.$_GET['url'].'"><br/>';
echo '<input name="oldname" type="hidden" value="'.$_GET['fname'].'">';
echo '<input type="submit" name="rename" value="ok"></form>'; }
   else {
      if(frename($_POST['url'],$_POST['oldname'],$_POST['nname'])!== FALSE) {
      header("location:index.php?url=".$_POST['url']); 	}
                   else {echo 'Ошибка <br/>';}
                   }
                   }


 ?>