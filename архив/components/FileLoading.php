<?php

header('Content-Type: application/json; charset=utf-8');//так как мы решили что сервер будет отвечать в формате json
$response= array();
include_once 'SimpleImage.php';

if(!empty($_FILES['file']['tmp_name'][0]))
        {
    
            $path=array();
            // Создадим ресурс FileInfo в php.ini должны быть раскомментированы extension=fileinfo.so или же extension=php_fileinfo.dll
            $fi = finfo_open(FILEINFO_MIME_TYPE);
            
            for($i=0;$i<count($_FILES['file']['error']);$i++)
            {
                 // Получим MIME-тип
                $mime = (string) finfo_file($fi, $_FILES['file']['tmp_name'][$i]);
                $image_params = getimagesize($_FILES['file']['tmp_name'][$i]);
                if($_FILES['file']['error'][$i]==0 && is_uploaded_file($_FILES['file']['tmp_name'][$i]) && strpos($mime, 'image') !== false)
                    {
                      if(filesize($_FILES['file']['tmp_name'][$i])<2097152 && $image_params[0]<1280 && $image_params[1]<768)
                      {   
                      
                        $extension_file=pathinfo($_FILES['file']['name'][$i])['extension'];
                        if($extension_file=='jpg'|| $extension_file=='jpeg'||$extension_file=='png'||$extension_file=='gif')
                        {

                        $tmpName=$_FILES['file']['tmp_name'][$i];
                            $path[$i]='../upload_temp/'.time().$i.'.'. $extension_file; 

                            //['extension'] можно заменить константой аргументом PATHINFO_EXTENSION (т.к. ['extension'] будет работать 
                            //только в PHP>5.3
                           
                            if(!move_uploaded_file($tmpName,$path[$i]))
                            {
                                $response['status']='bad';
                                break;
                            }
                          $response['status']='ok';

                         }
                        else {$response['status']='bad';break;}
                      }
                      else {$response['status']='bad'; break;}
                    }
                else 
                {
                    $response['status']='bad';
                    break;
                }

            }
        }
        else $response['status']='bad';

      
        if($response['status']=='ok')
        {
            $files= glob('../upload_temp/*');
            foreach ($files as $file){
                if(is_file($file)){
                    if(!in_array($file, $path))
                        unlink ($file);
                    else{
                        $image = new SimpleImage();
                        $image->load($file);
                        
                        $image->resize(150, 100);
                        $image->save($file);
                    }
                }
            }
           $i=0;
            foreach ($path as $paths)
            {$response['path'][$i]=$paths;
            $i++;}
        }

echo json_encode($response);

