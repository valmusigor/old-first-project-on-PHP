<?php
class RentController
{
    public function actionIndex()
    {
        $rentList=Rent::getRentList(9);
        require_once ROOT.'/views/rent/index.php';
        return true;
    }
    public function actionView($id)
    {
        if($id){
            $newsItem=News::getNewsItemById($id);
            echo '<pre>';
            print_r($newsItem);
            echo '</pre>';
        }
        return true;
    }
    public function actionPage($page=1)
    {
        $show_item=3;
        
        $countList=Rent::geListCount();
        foreach ($countList as $countList1)
            foreach ($countList1 as $key => $value) {
                $countList2=$value;
            }
           $max_count_list= ceil($countList2/$show_item);
           if($page>=$max_count_list)$page=$max_count_list;
        $rentList=Rent::getRentList($show_item,$page);
        require_once ROOT.'/views/rent/index.php';
        return true;
    }
}