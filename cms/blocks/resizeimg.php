<?

function resizeimg($big, $small, $width, $height,$folder,$sfolder) {
    // имя файла с маштабируемым изображением
    $big = $folder.$big;
 
    // имя файла с уменьшенной копией
    $small  = $sfolder.$small;
 
    //определиям коэфицент сжатия генерируемого изображения
    $ratio = $width/$height;
 
    // получаем размеры исходного изображения
    $size_img = getimagesize($big);
    list($width_src, $height_src) = getimagesize($big);
 
    // если размеры меньше, то маштабирование не нужно
    if(($width_src<$width) && ($height_src<$height)) {
        copy($big, $small);
        return true;
    }
 
    // получаем коэфицент сжатия исходного изображения
    $src_ratio = $width_src/$height_src;
 
    // вычисляем размеры уменьшенной копии, чтобы при мащтабировании сохранились пропорции исходного изображения
    if ($ratio<$src_ratio) {
        $height = $width/$src_ratio;
    }
    else {
        $width = $height*$src_ratio;
    }
    // создаем пустое изображение п заданным размерам
    $dest_img = imagecreatetruecolor($width,$height);
    $white    = imagecolorallocate($dest_img, 255, 255, 255);
    if ($size_img[2] == 2)      $src_img = imagecreatefromjpeg($big);
    else if ($size_img[2] == 1) $src_img = imagecreatefromgif($big);
    else if ($size_img[2] == 3) $src_img = imagecreatefrompng($big);
 
    // маштабируем изображение функцией imagecopysapled()
    // $dest_img - уменьшенная копия
    // $src_img  - исходное изображение
    // $width    - ширина уменьшенной копии
    // $height   - высота уменьшенной копии
    // $size_img[0] - ширина исходного изображения
    // $srze_img[1] - высота исходного изображения
 
    imagecopyresampled($dest_img,
                       $src_img,
                       0,
                       0,
                       0,
                       0,
                       $width,
                       $height,
                       $width_src,
                       $height_src);
 
    // сохраняем уменьшенную копию в файл
    if ($size_img[2]==2) imagejpeg($dest_img,$small);
    else if ($size_img[2]==1) imagegif($dest_img,$small);
    else if ($size_img[2]==3) imagepng($dest_img,$small);
    // очищаем память от созданных изображений
    imagedestroy($dest_img);
    imagedestroy($src_img);
    return true;
}

?>