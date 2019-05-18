<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Image
 *
 * @author Игорь
 */
class Image {
    const LIMITBYTES  = 2097152; //1024 * 1024 * 2
   const LIMITWIDTH  = 1280;
   const LIMITHEIGHT = 768;
    private $image;
    private $fi;
    private $filesload;
    private $errors;
    private $extension_file;
    public function __construct($files){
    // Создадим ресурс FileInfo в php.ini должны быть раскомментированы extension=fileinfo.so или же extension=php_fileinfo.dll
    $this->fi=finfo_open(FILEINFO_MIME_TYPE);
    $this->image = new SimpleImage();
    $this->filesload=$files;
    $this->errors=false;
    }
    private function checkExtension($j)
    {
        $this->extension_file=pathinfo($this->filesload['name'][$j])['extension'];
        if($this->extension_file=='jpg'|| $this->extension_file=='jpeg'||$this->extension_file=='png'||$this->extension_file=='gif')
            {
            return true;
            }
        else
            {  
            $this->errors[]='Загрузите файл с изображением';
            return false;
            }
        
    }
    private function checkSize($j)
    {
        $image_params = getimagesize($this->filesload['tmp_name'][$j]);
        if(filesize($this->filesload['tmp_name'][$j])<self::LIMITBYTES && $image_params[0]<self::LIMITWIDTH && $image_params[1]<self::LIMITHEIGHT)
            {
            return true;
            }
        else
            {  
            $this->errors[]='Неверный размер или параметры изображения';
            return false;
            }
        
    }
    private function checkFile($j)
    {
        // Получим MIME-тип
        $mime = (string) finfo_file($this->fi, $this->filesload['tmp_name'][$j]);
        if($this->filesload['error'][$j]==0 && is_uploaded_file($this->filesload['tmp_name'][$j]) && strpos($mime, 'image') !== false)
            {
            return true;
            }
        else
            {  
            $this->errors[]='Не выбраны файлы';
            return false;
            }
        
    }
    public function getError()
    {
        return $this->errors;
    }

    public function loadImage($userId,$pathSave)
    {
            $path=array();
            for($i=0;$i<count($this->filesload['error']);$i++)
            {
                    if($this->checkFile($i) && $this->checkSize($i) && $this->checkExtension($i))
                    {
                        $tmpName=$this->filesload['tmp_name'][$i];
                        $this->image->load($tmpName);
                        $this->image->resize(150, 100);
                        $this->image->save($tmpName);
                            
                        $path[$i]=$pathSave.$userId.'_'.time().$i.'.'. $this->extension_file; 

                            //['extension'] можно заменить константой аргументом PATHINFO_EXTENSION (т.к. ['extension'] будет работать 
                            //только в PHP>5.3
                            if(!move_uploaded_file($tmpName,ROOT.$path[$i]))
                            {
                                $this->errors='Файл не сохранен';
                               return false;
                            }
                    }else  return false;
                

            }
            return $path;
       
    }
    public function workWithTempImage($path)
    {
        //$files= glob('..'.$pathSave.'*');
         $pathes=array();
         $files= glob('upload_temp/*');
         foreach ($files as $file)
         $pathes[]='/'.$file;
            foreach ($pathes as $file)
            {
                 
               if(is_file(ROOT.$file))
               {
                    if(!in_array($file, $path))
                        unlink (ROOT.$file);
                    else
                    {
                        $this->image->load(ROOT.$file);
                        $this->image->resize(200, 100);
                        $this->image->save(ROOT.$file);
                    }
                }
                
            }
         
           
    }
    public static function deleteImage($pathes)
    {
        foreach ($pathes as $file)
            {
                 
               if(is_file(ROOT.$file))
               {
                   unlink (ROOT.$file); 
               }
                
            }
    }
}
