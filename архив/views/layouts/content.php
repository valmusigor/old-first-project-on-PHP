<div class="container-fluid">    
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <?php foreach($rentList as $rentCard):?>
                <div class="col-lg-4 card_pad d-flex">
                    <div class="card" style="width: 100%;box-shadow: 10px 10px 10px rgba(19,101,159,0.5);" >
                        <div class="card bg-dark text-white">
                            <img class="card-img-top" src="<?php echo $rentCard['path_short_image'];?>" alt="Card image cap">
                            <div class="card-img-overlay">
                                <p class="card-text  card_update" style="color:white;">Last updated 3 mins ago</p>
                                <p class="card-text" style="position: absolute; bottom: 0; right: 0; background: red; "><?php echo $rentCard['price'].'$';?></p>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?php echo $rentCard['short_content'];?></p>
                         
                        </div>
                        <div class="card-footer">
                            <a href="rent/<?php echo $rentCard['id'];?>/" class="btn btn-outline-primary btn-sm">Подробнее>></a>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                </div>
            <div class="row">
                <?php if(!isset($newsList)):?>
                <nav aria-label="..." class="nav-list" data-max="<?php echo $max_count_list;?>">
                    <ul class="pagination">
                        <?php if($page==1){$firstPage=$page;$secondPage=$page+1;$thirdPage=$page+2;} 
                        else if($page>=$max_count_list && $max_count_list>2 ){$firstPage=$max_count_list-2;$secondPage=$max_count_list-1;$thirdPage=$max_count_list;} 
                        else {$firstPage=$page-1;$secondPage=$page;$thirdPage=$page+1;} 
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="/rent/page-<?php $prev_page=$firstPage-1; if($prev_page!=0) echo $prev_page;
                            else echo 1;?>"  aria-disabled="true">&laquo;</a>
                        </li>
                        
                        <li class="page-item  active"><a class="page-link" href="/rent/page-<?php echo $firstPage;?>"><?php echo $firstPage;?></a></li>
                        <?php if($max_count_list>1):?>
                        <li class="page-item" aria-current="page">
                            <a class="page-link" href="/rent/page-<?php echo $secondPage;?>"><?php echo $secondPage;?><span class="sr-only">(current)</span> </a>
                        </li>
                        <?php endif;?>
                        <?php if($max_count_list>2):?>
                         <li class="page-item"><a class="page-link" href="/rent/page-<?php echo $thirdPage;?>"><?php echo $thirdPage;?></a></li>
                        <?php endif;?>
                         <li class="page-item">
                        <a class="page-link" href="/rent/page-<?php echo $thirdPage+1;?>">&raquo;</a>
                        </li>
                    </ul>
                </nav>
                <?php endif;?>
            </div>
        </div>
        <div class="col-lg-3">
          <?php if (isset($newsList)): ?>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Новости</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Объявления</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="list-group">
                        <?php foreach($newsList as $newsCard):?>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                              <h5 class="mb-1"><?php echo $newsCard['title'];?></h5>
                              <small>3 days ago</small>
                            </div>
                            <p class="mb-1"><?php echo $newsCard['short_content'];?></p>
                            <small>Author</small>
                        </a>
                        <?php endforeach;?>
                    </div>
                </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
            </div>
           <?php else:?>
            <form style="color:white;">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress">Address</label>
              <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
              <label for="inputAddress2">Address 2</label>
              <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity">
              </div>
              <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select id="inputState" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip">
              </div>
            </div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                  Check me out
                </label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
          </form>
           <?php endif;?>
        </div>
    </div>
</div>
