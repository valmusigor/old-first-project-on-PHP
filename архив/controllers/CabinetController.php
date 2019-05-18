<?php

/**
 * Description of CabinetController
 *
 * @author Игорь
 */
class CabinetController {
   
   public function actionIndex()
    {
        $userId=User::checkLogged();
        $countRents=Rent::getRentCountItemByUserId($userId);
        $userItem= User::getUserItemById($userId);
        foreach($userItem as $userItem1)
            $userItem2=$userItem1;
        require_once ROOT.'/views/cabinet/index.php';
        return true;
    }
    public function actionEdit() {
        $userId=User::checkLogged();
        $countRents=Rent::getRentCountItemByUserId($userId);
        $userItem= User::getUserItemById($userId);
        foreach($userItem as $userItem1)
            $userItem2=$userItem1;
        $login=$userItem2['login'];
        $email=$userItem2['email'];
        $password1=$userItem2['password'];
        $password2=$userItem2['password'];
        if(count($_POST)>0)
        {
            $loginPost= htmlspecialchars(trim($_POST['login']));
            $emailPost=htmlspecialchars(trim($_POST['email']));
            $password1=htmlspecialchars(trim($_POST['password1']));
            $password2=htmlspecialchars(trim($_POST['password2']));
            $errors=false;
            if(!User::checkName($loginPost))
                $errors[]='Логин должен быть не короче 2-x символов';
            if(!User::checkEmail($emailPost))
                $errors[]='Не правильно введен e-mail';
            if(User::checkExist(array('email'=>$emailPost)) && $email!=$emailPost)
                $errors[]='Этот е-mail уже используется';
            if(User::checkExist(array('login'=>$loginPost)) && $login!=$loginPost)
                $errors[]='Этот login уже используется';
            if(!User::checkPassword($password1, $password2))
                $errors[]='Пароли не совпадают';
            else if(User::checkPassword($password1, $password2)==1)
                 $errors[]='Введите пароль более 6 символов';
                if(count($errors)>0)
                print_r ($errors);
                if($errors==false)
                {
                   $result= User::edit($userId,$loginPost,$emailPost,$password1);
                }
              
                
        }
        require_once ROOT.'/views/cabinet/edit.php';
    }
    public function actionRents() {
        $userId=User::checkLogged();
        $userItem= User::getUserItemById($userId);
        $countRents=Rent::getRentCountItemByUserId($userId);
        $result=FALSE;
        $result= Rent::getRentItemByUserId($userId);
        require_once ROOT.'/views/cabinet/rents.php';
    }
    public function actionAddrents(){
        $userId=User::checkLogged();
        $userItem= User::getUserItemById($userId);
        $countRents=Rent::getRentCountItemByUserId($userId);
        if(count($_POST)>0)
        {
            $short_content= htmlspecialchars(trim($_POST['short_content']));
            $type_tc=$_POST['type_tc'];
            $address=$_POST['address'];
            
            $content=htmlspecialchars(trim($_POST['content']));
            $price=htmlspecialchars(trim($_POST['price']));
            $square=htmlspecialchars(trim($_POST['square']));
            if(isset($_POST['main_image']))
                $main_image=$_POST['main_image'];
            else $main_image=0;
          
            $errors=false;
            if(!Rent::checkShortContent($short_content))
                $errors[]='Заголовок должен быть не менее 2-х и не более 104 симоволов';
            if(!Rent::checkChoose($type_tc))
                $errors[]='Не выбрано товарищество собственников';
            if(!Rent::checkChoose($address))
                $errors[]='Не выбран адрес помещения';
            if(!Rent::checkShortContent($content))
                $errors[]='Текст объявления должен быть не менее 2-х и не более 250 симоволов';
            if(!Rent::checkPrice($price))
                $errors[]='Некорректно задана цена(при задании дробной цены используйте символ .)';
            if(!Rent::checkSquare($square))
                $errors[]='Некорректно задана площадь(при задании дробной площади используйте символ .)'; 
           
        if($errors==false && !empty($_FILES['file']['tmp_name'][0]))
        {
            $images=new Image($_FILES['file']);
                $path=$images->loadImage($userId);
                if(!$path)
                    print_r ($images->getError());
           /* $path=array();
            // Создадим ресурс FileInfo в php.ini должны быть раскомментированы extension=fileinfo.so или же extension=php_fileinfo.dll
            $fi = finfo_open(FILEINFO_MIME_TYPE);
            $image = new SimpleImage();
            for($i=0;$i<count($_FILES['file']['error']);$i++)
            {
                 // Получим MIME-тип
                $mime = (string) finfo_file($fi, $_FILES['file']['tmp_name'][$i]);
                $image_params = getimagesize($_FILES['file']['tmp_name'][$i]);
                if($_FILES['file']['error'][$i]==0 && is_uploaded_file($_FILES['file']['tmp_name'][$i]) && strpos($mime, 'image') !== false)
                    {
                      if(filesize($_FILES['file']['tmp_name'][$i])<self::LIMITBYTES && $image_params[0]<self::LIMITWIDTH && $image_params[1]<self::LIMITHEIGHT)
                      {   
                      
                        $extension_file=pathinfo($_FILES['file']['name'][$i])['extension'];
                        if($extension_file=='jpg'|| $extension_file=='jpeg'||$extension_file=='png'||$extension_file=='gif')
                        {

                            $tmpName=$_FILES['file']['tmp_name'][$i];
                            
                            $image->load($tmpName);
                            $image->resize(150, 100);
                            $image->save($tmpName);
                            
                        $path[$i]='/upload/'.$userId.'_'.time().$i.'.'. $extension_file; 

                            //['extension'] можно заменить константой аргументом PATHINFO_EXTENSION (т.к. ['extension'] будет работать 
                            //только в PHP>5.3
                            if(!move_uploaded_file($tmpName,ROOT.$path[$i]))
                            {
                                $errors[]='Файл не сохранен';
                                break;
                            }
                          

                         }
                        else {$errors[]='Загрузите файл с изображением';break;}
                      }
                      else {$errors[]='Неверный размер или параметры изображения';
                      break;}
                    }
                else 
                {
                    $errors[]='Не выбраны файлы';
                    break;
                }

            }*/
        }
        
        else $errors[]='Ошибка загрузки файла';
            if(count($errors)>0)
            print_r ($errors);
            if($errors==false)
                {
                
                    if(Rent::addRent($short_content,$main_image,$path,$square,$price,$content,$userId,$type_tc,$address))
                    {
                        header("Location: /cabinet/rents/");
                    }
                    else 
                    {
                        echo "Ошибка! Попробуйте еще раз!";
                        require_once (ROOT.'/views/cabinet/add-rents.php');
                    }
                }
             else require_once (ROOT.'/views/cabinet/add-rents.php');
        } 
        else require_once ROOT.'/views/cabinet/add-rents.php';
         return true;
    }
    /**
     * удаление объявления из списка объявлений
     * params int $rent_id
     */
    public function actionDeleterents(){
        $userId=User::checkLogged();
        header('Content-Type: application/json; charset=utf-8');//так как мы решили что сервер будет отвечать в формате json
        $response= array();
        $rent_id=$_POST['id'];
        $result=false;
        $result=Rent::getRentItemById($rent_id);
       if($result)
        {
           $path_images= unserialize($result[0]['path_images']);
           foreach ($path_images as $path_image)
           {
           if(file_exists(ROOT.$path_image))
           unlink(ROOT.$path_image);
           }
         if(Rent::deleteRent($rent_id))
        $response['status']='ok';
        else $response['status']='bad';
           
        }
        echo json_encode($response);
    }
    public function actionEditrents(){
        
        $userId=User::checkLogged();
        $userItem= User::getUserItemById($userId);
        $countRents=Rent::getRentCountItemByUserId($userId);
   if(count($_POST)>0)
        {
            $errors=false;
            if(isset($_POST['rent_id_edit'][0]))
            {
            $rent_id_edit=htmlspecialchars(trim($_POST['rent_id_edit'][0]));
            $rent_edit= Rent::getRentItemById($rent_id_edit);
            $short_content=$rent_edit[0]['short_content'];
            $type_tc=$rent_edit[0]['type_tc'];
            $address=$rent_edit[0]['address'];
            $content=$rent_edit[0]['content'];
            $price=$rent_edit[0]['price'];
            $square=$rent_edit[0]['square'];
            $path_images=unserialize($rent_edit[0]['path_images']);
            }
            else {
            $short_content= htmlspecialchars(trim($_POST['short_content']));
            $rent_id= htmlspecialchars(trim($_POST['rent_id']));
            $type_tc=$_POST['type_tc'];
            $address=$_POST['address'];
             if(isset($_POST['main_image']))
                $main_image=$_POST['main_image'];
            else $main_image=0;
            $content=htmlspecialchars(trim($_POST['content']));
            $price=htmlspecialchars(trim($_POST['price']));
            $square=htmlspecialchars(trim($_POST['square']));
            $errors=false;
            if(!Rent::checkShortContent($short_content))
                $errors[]='Заголовок должен быть не менее 2-х и не более 104 симоволов';
            if(!Rent::checkChoose($type_tc))
                $errors[]='Не выбрано товарищество собственников';
            if(!Rent::checkChoose($address))
                $errors[]='Не выбран адрес помещения';
            if(!Rent::checkShortContent($content))
                $errors[]='Текст объявления должен быть не менее 2-х и не более 250 симоволов';
            if(!Rent::checkPrice($price))
                $errors[]='Некорректно задана цена(при задании дробной цены используйте символ .)';
            if(!Rent::checkSquare($square))
                $errors[]='Некорректно задана площадь(при задании дробной площади используйте символ .)'; 
            }
            
            
            
           
        if($errors==false) 
        {     
             $path=array();
            if(!empty($_FILES['file']['tmp_name'][0]))
            {
                $images=new Image($_FILES['file']);
                $path=$images->loadImage($userId);
                if(!$path)
                    print_r ($images->getError());
                    
                /*
            
            $path=array();
            // Создадим ресурс FileInfo в php.ini должны быть раскомментированы extension=fileinfo.so или же extension=php_fileinfo.dll
            $fi = finfo_open(FILEINFO_MIME_TYPE);
            $image = new SimpleImage();
            for($i=0;$i<count($_FILES['file']['error']);$i++)
            {
                 // Получим MIME-тип
                $mime = (string) finfo_file($fi, $_FILES['file']['tmp_name'][$i]);
                $image_params = getimagesize($_FILES['file']['tmp_name'][$i]);
                if($_FILES['file']['error'][$i]==0 && is_uploaded_file($_FILES['file']['tmp_name'][$i]) && strpos($mime, 'image') !== false)
                    {
                      if(filesize($_FILES['file']['tmp_name'][$i])<self::LIMITBYTES && $image_params[0]<self::LIMITWIDTH && $image_params[1]<self::LIMITHEIGHT)
                      {   
                      
                        $extension_file=pathinfo($_FILES['file']['name'][$i])['extension'];
                        if($extension_file=='jpg'|| $extension_file=='jpeg'||$extension_file=='png'||$extension_file=='gif')
                        {

                            $tmpName=$_FILES['file']['tmp_name'][$i];
                            
                            $image->load($tmpName);
                            $image->resize(150, 100);
                            $image->save($tmpName);
                            
                        $path[$i]='/upload/'.$userId.'_'.time().$i.'.'. $extension_file; 

                            //['extension'] можно заменить константой аргументом PATHINFO_EXTENSION (т.к. ['extension'] будет работать 
                            //только в PHP>5.3
                            if(!move_uploaded_file($tmpName,ROOT.$path[$i]))
                            {
                                $errors[]='Файл не сохранен';
                                break;
                            }
                          

                         }
                        else {$errors[]='Загрузите файл с изображением';break;}
                      }
                      else {$errors[]='Неверный размер или параметры изображения';
                      break;}
                    }
                else 
                {
                    $errors[]='Не выбраны файлы';
                    break;
                }

            }
        */}
        else 
        {
            $path=array();
            if(isset($rent_id))
            {$rent_edit= Rent::getRentItemById($rent_id);
            $path=unserialize($rent_edit[0]['path_images']);
            }
            else
            $path=$path_images;
        }
      }
       
       
        if(count($errors)>0)
            print_r ($errors);
            if($errors==false && !isset($_POST['rent_id_edit'][0]))
                {
                
                    if(Rent::editRent($rent_id,$short_content,$main_image,$path,$square,$price,$content,$userId,$type_tc,$address))
                    {
                        header("Location: /cabinet/rents/");
                    }
                    else 
                    {
                        echo "Ошибка! Попробуйте еще раз!";
                        require_once (ROOT.'/views/cabinet/add-rents.php');
                    }
                }
             else require_once (ROOT.'/views/cabinet/add-rents.php');
        } 
        else require_once ROOT.'/views/cabinet/add-rents.php';
         return true;
    }
        
}

