<?php

return array(
    //'news/77'=>'news/view',//первые два правила выше потому как, если расположить
   // 'news/15'=>'news/view',//3 правило  первым до первых двух не дойдет обработка
   // 'news/([a-z]+)/([0-9]+)'=>'news/view/$1/$2',
    ''=>'site/index',//actionIndex в SiteController
    'admin'=>'admin/index',
    'contact'=>'site/contact',
    'cabinet/edit'=>'cabinet/edit',
    'cabinet'=>'cabinet/index',//actionIndex в NewsController
    'cabinet/rents'=>'cabinet/rents',
    'cabinet/addrents'=>'cabinet/addrents',
    'cabinet/deleterents'=>'cabinet/deleterents',
    'cabinet/editrents'=>'cabinet/editrents',
    'rent/page-([0-9]+)'=>'rent/page/$1',
    'rent'=>'rent/index',//actionIndex в NewsController
    'user/login'=>'user/login',
    'user/logout'=>'user/logout',
    'user/register'=>'user/register',
    'news/([0-9]+)'=>'news/view/$1',
    'news'=>'news/index',//actionIndex в NewsController
    'products'=>'product/list',//actionList в ProductController
);

