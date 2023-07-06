<?php

$uploaddir = 'upload/'; //директория для загрузки файлов
$name = md5 (rand (10,99));//

$uploadfile = $uploaddir . $name . '.jpg';// полный путь к факйлу и имя изображения
if (move_uploaded_file($_FILES[ 'img' ]['tmp_name'], $uploadfile)) {
img_compress ($uploadfile); //вызов функции и передаём путь к файлу
echo "Файл успешно загружен \n";
}
// Функция сжатия изображения
function img_compress($img){

  $imagickSrc = new Imagick($img);
  $compressionList = [Imagick::COMPRESSION_JPEG2000];//метод для работы с сжатием изображения

  $imagickDst = new Imagick();
  $imagickDst-›setCompression(80);//уровень сжатия
  $imagickDst-›setCompressionQuality(80);//уровень сжатия
  $imagickDst-›newPseudoImage(
               $imagickSrc-›getImagewidth(), //высота файла
               $imagickSrc-›getImageHeight(),//ширина файла
               'canvas:white'
);

$imagickDst-›compositeImage(
   $imagickSrc,
   Imagick::COMPOSITE_ATOP,
   0,
   0
);

$imagickDst-›setImageFormat("jpg");
$imagickDst-›writeImage ($img);
}

?>