<?php
$youtube_id=$_GET['video_id'];
if(!file_exists("img_convert/".$youtube_id.".jpg"))
{
$stamp = imagecreatefrompng('logo/YouTube-Logo32.png');
$img=@file_get_contents("https://i.ytimg.com/vi/$youtube_id/hqdefault.jpg");
if($http_response_header[0]=='HTTP/1.0 200 OK')
{$im = imagecreatefromstring($img);
// 设置水印图像的外边距，并且获取水印图像的尺寸
$marge_right = 10;
$marge_bottom = 1;
$sx = imagesx($stamp);
$sy = imagesy($stamp);
//裁剪原图片
$sourceW = imagesx($im);
$sourceH = imagesy($im);
$newIm = imagecreatetruecolor(270, 270);
imagealphablending($newIm, true);
imagecopy($newIm, $im, -(imagesx($im)-270)/2, -45, 0, 0, $sourceW, $sourceH);
$im=$newIm;
// 利用图像的宽度和水印的外边距计算位置，并且将水印复制到图像上
imagecopy($im, $stamp, (imagesx($im)-imagesx($stamp))/2, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
// 输出图像并释放内存
header('Content-type: image/jpeg');
imagejpeg($im,"img_convert/".$youtube_id.".jpg");
readfile("img_convert/".$youtube_id.".jpg");
imagedestroy($im);
}else
{
header('Content-type: image/jpeg');
readfile("logo/404.jpg");
}
}else
{
header('Content-type: image/jpeg');
readfile("img_convert/".$youtube_id.".jpg");
}