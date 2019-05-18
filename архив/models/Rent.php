<?php
/**
 * Description of Product
 *
 * @author Игорь
 */
class Rent {
    const SHOW_BYDEFAULT=8;
    /*
     * Returns single news item with specified id
     * @param integer $id
     */
   public static function getRentItemById($id)
   {
       return SQL::Instance()->select("SELECT * FROM rent WHERE id=$id");
   }
   /*
    * Returns an array of news item
    */
   public static  function getRentList($count=self::SHOW_BYDEFAULT,$page=1)
   {
       $offset=($page-1)*$count;
       return SQL::Instance()->select('SELECT * FROM rent ORDER BY date DESC LIMIT '.$count.' OFFSET '.$offset);
   }
   public static  function geListCount()
   {

       return SQL::Instance()->select('SELECT COUNT(id) FROM rent');
   }
   public static function getRentItemByUserId($userId)
   {
       return SQL::Instance()->select("SELECT * FROM rent WHERE user_id=$userId");
   }
   public static function getRentCountItemByUserId($userId)
   {
       $counts=SQL::Instance()->select("SELECT COUNT(*) FROM rent WHERE user_id=$userId");
       foreach ($counts as $count)
           $counts=$count;
       foreach ($counts as $count)
           $counts=$count;
       return $counts;
   }
   public static function checkShortContent($short_content){
        if(strlen($short_content)>2 && strlen($short_content)<104)
            return true;
        else      return false;
    }
     public static function checkContent($content){
        if(strlen($shor_content)>2 && strlen($short_content)<250)
            return true;
        else      return false;
    }
    public static function checkChoose($arg){
        if($arg=='0')
            return false;
        else      return true;
    }
    public static function checkPrice($price){
       if(preg_match("~^([0-9]{1,4})(\.[0-9]{0,2}){0,1}$~", $price))
            return true;
        else      return false;
    }
    public static function checkSquare($square){
       if(preg_match("~^([0-9]{2,5})(\.[0-9]{0,1}){0,1}$~", $square))
            return true;
        else      return false;
    }
    public static function addRent($short_content,$main_image,$path,$square,$price,$content,$userId,$type_tc,$address){
        $path_images= serialize($path);
        if($main_image==0)
        $array=array('path_short_image'=>$path[0],'short_content'=>$short_content,'square'=>$square,'price'=>$price,'content'=>$content,'path_images'=>$path_images,'user_id'=>$userId,'type_tc'=>$type_tc,'address'=>$address);
        else
        $array=array('path_short_image'=>$path[$main_image],'short_content'=>$short_content,'square'=>$square,'price'=>$price,'content'=>$content,'path_images'=>$path_images,'user_id'=>$userId,'type_tc'=>$type_tc,'address'=>$address);    
        return SQL::Instance()->insert('rent',$array);
    }
    public static function editRent($id,$short_content,$main_image,$path,$square,$price,$content,$userId,$type_tc,$address){
        $path_images= serialize($path);
        if($main_image==0)
        $array=array('path_short_image'=>$path[0],'short_content'=>$short_content,'square'=>$square,'price'=>$price,'content'=>$content,'path_images'=>$path_images,'user_id'=>$userId,'type_tc'=>$type_tc,'address'=>$address);
        else
        $array=array('path_short_image'=>$path[$main_image],'short_content'=>$short_content,'square'=>$square,'price'=>$price,'content'=>$content,'path_images'=>$path_images,'user_id'=>$userId,'type_tc'=>$type_tc,'address'=>$address);    
       
        $where='id='.$id;
        return SQL::Instance()->update('rent',$array,$where);
    }
    public static function deleteRent($rent_id){
        $where=array('id'=>$rent_id);
        return SQL::Instance()->delete('rent',$where);
    }
}