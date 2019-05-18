$(document).ready(function(){
 //paginator
    var list_uri=window.location.pathname;//получаем из URI только путь
    var str=/\/rent\/page-[0-9]+/;//в js /-это разделитель, поэтому если использовать не как разделитель нужно ставить перед ними \
    if(str.test(list_uri))
    {
        var list_numb=list_uri.split('-');//разделяем по знаку -
        var list=$('.nav-list .pagination');
        var list_page=+list_numb[1];//приведение к int
        var max_count_list=+$('.nav-list').data('max');//получаем из атрибута data-max общее количество листов
        if(max_count_list>1)
        {
            if(list_numb[1]!='1')
            {  
                list.find('li:nth-child(2)').removeClass('active');
               list.find('li:nth-child(3)').addClass('active');
              
               if (list_page>=max_count_list)
                {
                    if(max_count_list==2)
                    list_page=max_count_list+1;
                  else list_page=4;
                    list.find('li:nth-child(3)').removeClass('active');
                    list.find('li:nth-child('+list_page+')').addClass('active');
                    
                    list.find('li:nth-child(5)').addClass('disabled');


                }
            } 
            if (list_numb[1]=='1' || list_numb[1]=='2' )  list.find('li:nth-child(1)').addClass('disabled');
            else  list.find('li:nth-child(1)').removeClass('disabled');
        }
    }   
                    $(".nav-list").find("a").click(function(){
                    // удаляем у старого элемента, класс   activeClass 

                  //  $(".nav-list .active").removeClass("active");

                    // добавляем к ссылки по которой щёлкнули класс activeClass
                   // $(this).closest(".page-item").addClass("active");
                  });
//выбор товарищества
             $("#choosetc").change(function(){
                 if($("option:selected", this).html()=='Борвиха')
                 {
                     $("#chooseaddress").empty();
                     $("#chooseaddress").append( $('<option value="1">40 лет Победы 27/1</option>'));
                     $("#chooseaddress").append( $('<option value="2">40 лет Победы 27/2</option>'));
                     $("#chooseaddress").append( $('<option value="3">40 лет Победы 27/4</option>'));
                     $("#chooseaddress").append( $('<option value="4">40 лет Победы 27/5</option>'));
                     $("#chooseaddress").removeAttr("disabled");
                 }
                 else if ($("option:selected", this).html()=='Борвиха плюс')
                 {
                     $("#chooseaddress").empty();
                     $("#chooseaddress").append( $('<option value="5">40 лет Победы 23А</option>'));
                     $("#chooseaddress").removeAttr("disabled");
                 }
                 else
                 {
                     $("#chooseaddress").empty();
                     $("#chooseaddress").append( $('<option value="0" selected>Выберите товарищество собственников</option>'));
                     $("#chooseaddress").attr('disabled','');
                 }
             });
             $("#upload_file").change(function(){
                var formData=new FormData();
                var form=$('#myform');
              
                 if(($(this)[0].files).length!=0)
                {
                  console.log(($(this)[0].files));
                  $.each($(this)[0].files,function(i,file){
                      formData.append("file["+i+"]",file);
                      
                  });
                }
                
                else {
                    alert('файлы не выбраны');
                    return false;
                }
               
                //complete отработает всегда даже если badrequest
                $.ajax({
                   type:"POST",
                   url:"../../components/FileLoading.php",
                   data: formData,
                   cache:false,
                   dataType:"json",
                   contentType:false,
                   processData:false,
                   beforeSend:function(){
                       console.log('Запрос начат');
                       form.find('input').prop("disabled",true);
                       $('div#add-image-card').remove();
                   },
                   success:function(data){
                      
                       if(data.status=='ok'){
                         //$("#upload_file").val('');  
                          console.log('все ок');
                          console.log(data.path[0]); 
                          
                          for(var i=0;i<data.path.length;i++)
                          $('#add-image').prepend('<div class="col-lg-4 col-sm-6 col-md-4" id="add-image-card"><div class="card bg-dark" style="color:red; margin-bottom: 15px;">\n\
                          <img src="../'+data.path[i]+'" /><div class="card-img-overlay d-flex justify-content-between" style="padding:0 5px;">\n\
                           <div><input type="radio" name="main_image" value="'+i+'" class="form-radio-input" id="check_main_image" >\n\
                           <label class="form-check-label" for="check_main_image">Главная</label></div><div>Удалить</div></div></div></div> ');
                        }
                        else
                            alert('c загрузкой что то не так');
               },
                   complete:function(){
                       console.log('запрос окончен');
                       form.find('input').prop("disabled",false);
                   }
                });
             });
             $("small#delete_item").click(function(){
                     
                        var id=$(this).children("input").val();
                        
                        rent_id=$(this);
                       $.confirm({
                        title: 'Удалить объявление?',
                        content: 'This dialog will automatically trigger \'cancel\' in 6 seconds if you don\'t respond.',
                        autoClose: 'cancelAction|8000',
                        buttons: {
                            deleteUser: {
                                btnClass: 'btn-dark',
                                text: 'Удалить обявление',
                                action: function () {
                                    $.ajax({
                                        type:"POST",
                                        url:'/cabinet/deleterents/',
                                        data: {id: id},
                                        cache:false,
                                        dataType:"json",
                                        
                                        beforeSend:function(){
                                            console.log('Запрос начат');
                                           // form.find('input').prop("disabled",true);
                                           // $('#add-image img').remove();
                                        },
                                        success:function(data){
                                            //console.log('все ок');
                                                 if(data['status']=='ok')
                                           {
                                            rent_id.parents('.my-rents').remove();//удаляем элемент из DOM
                                            var count=$(".count-rents").html();//уменьшаем количество объявление в правой колонке
                                            count--;
                                            $(".count-rents").html(count); 
                                            }
                                           /* if(data.status=='ok'){
                                              //$("#upload_file").val('');  
                                               console.log('все ок');
                                               console.log(data.path[0]); 
                                               for(var i=0;i<data.path.length;i++)
                                            
                                             }
                                             else
                                                 alert('c загрузкой что то не так');*/
                                    },
                                        complete:function(){
                                            console.log('запрос окончен');
                                            
                                           // form.find('input').prop("disabled",false);
                                        }
                                     });
                                    
                                   // $.alert('Объявление удалено!');
                               }
                            },
                            cancelAction:{ 
                             btnClass: 'btn-dark',
                             text:'Отмена',      
                             action: function () {
                                $.alert('Удаление отменено');
                            }
                        }
                        }
                    });
             });
             
   $(".rent_id_edit").click(function(){
      $(this).next(".edit-rents").trigger("click");
   });    
   $("#button_select_file").click(function(){
   $("#upload_file").trigger('click');
   });
    
    if($("#add-image img").length!=0)
       { 
         // let mas=[];
         // let i=0;
          // $("#add-image img").each(function(){
         //      mas[i]=this.src;
          //     i++;
         //  });
         //  
        // console.log($("#add-image img").attr('title'));
          // for(i=0;i<$("#add-image img").length;i++)
           //($("#upload_file")[0].files)=mas[i];
       
      // $.each($(this)[0].files,function(i,file){
        //              formData.append("file["+i+"]",file);
                      
                 
           
          // $("#add-image img").attr('src');
           //
             // console.log(mas);
           //console.log($("#add-image img").length);
         // console.log($("#upload_file")[0].files);
       //    alert($("#label_upload_file").html());
       
       }
             

});

/*	var images=document.querySelectorAll('.slider img');
	
	document.getElementById('arrowleft').onclick=function()
	{
	 for(var i=0;i<3;i++)
	 {
		 if(images[i].className=='left')
			 images[i].className='right';
		 else  if(images[i].className=='right')
			 images[i].className='center';
		  else if(images[i].className=='center')
			 images[i].className='left';
		
	 }
	}
	document.getElementById('arrowright').onclick=function()
	{
	 for(var i=0;i<3;i++)
	 {
		 if(images[i].className=='left')
			 images[i].className='center';
		 else  if(images[i].className=='right')
			 images[i].className='left';
		  else if(images[i].className=='center')
			 images[i].className='right';
		
	 }
	}*/