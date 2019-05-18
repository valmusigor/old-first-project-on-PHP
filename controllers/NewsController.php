<?php
class NewsController
{
    public function actionIndex()
    {
        $newsList=array();
        $newslist=News::getNewsList();
        echo '<pre>';
        print_r($newslist);
        echo '</pre>';
        require_once ROOT.'/views/news/index.php';
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
}

