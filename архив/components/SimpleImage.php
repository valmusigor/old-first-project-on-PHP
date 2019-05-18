<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SimpleImage
 *
 * @author Игорь
 */
class SimpleImage {
   var $image;
   var $image_type;
 /**
  * создает новое изображение из файла и сохраняет его в поле image
  * @param string $filename
  */
   function load($filename) {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   /**
    * Сохраняем переменную в $filename
    * @param type $filename-куда будем сохранять
    * @param type $image_type
    * @param type $compression(качество)
    * @param type $permissions(права)
    */
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   
   }
   /**
    * Вывод изображения в браузер без сохранения
    * @param type $image_type
    */
   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }
   }
   /**
    * 
    * @return int width
    */
   function getWidth() {
      return imagesx($this->image);
   }
   /**
    * 
    * @return int height
    */
   function getHeight() {
      return imagesy($this->image);
   }
   /**Изменение размера высоты (ширину сценарий подгонит)
    * 
    * @param int $height
    */
   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   /**Изменение размера ширины (высоту сценарий подгонит)
    * 
    * @param int $width
    */
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   /**
    * уменьшение размера картинки в процентном соотношении
    * @param int $scale
    */
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
   /**
    * Изменяем размеры изображения по заднным параметрам ширины и высоты
    * @param int $width
    * @param int $height
    */
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }
}
