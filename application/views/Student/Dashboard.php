<div class="cell auto-size padding10 bg-white" onload="checkemail();" id="cell-content-dashboard">
    <div class="cell auto-size padding20 bg-white" id="cell-content">  
        <div class="flex-grid">
            <div class="row padding10 colspan12">
            <div class="slideshow-container">
            <?php
                foreach ($slider as $value) {
                    echo '<div class="mySlides fade"><div class="numbertext">' . $value['title'] . '</div>'
                    . '<img src="' . base_url('' . $value['background'] . '') . '" style="width:800px;height:280px;"><div class="textcs">' . $value['description'] . '</div><br><div class="textcsw">' . $value['subtitle'] . '</div></div>';
                }
                echo '<div class="textcss" style="text-align:center">';
                foreach ($slider as $value) {
                    echo '<span class="dot"></span>';
                }
                ?>
</div> 
</div>

                
    </div>
            
            <div class="row">&nbsp;</div>
            <div class="row">
                <div class="cell colspan1">&nbsp;</div>
                <div class="padding20 box bg-lightBlue" data-role="input" style="width: 100%;">
                    <div class="cell colspan10">
                        <form action="<?php echo site_url('ElibrarySystem/booklist')?>" method="post" style="width: 100%;">
                        <div class="input-control text margin20" style="width: 60%;">
                            <label style="color: #e4cf37;"><b>Search:</b></label>
                            <input type="text" name="search" id="search" placeholder="Search Title\Book\Material...">
                        </div>
                        <div class="input-control select" style="width: 30%;">
                            <label style="color: #e4cf37;"><b>Category:</b></label>
                            <select name="category">
                        <option>- Book -</option>
                        <option>- Material -</option>
                    </select>
                    </div>
                    <button class="button button-search">
                        <span class="mif-search"></span>
                        </button>
                        </form>
                        </div>
                </div>
                <div class="cell colspan1">&nbsp;</div>
    
                 </div>
                </div>
            <!--<div class="row">&nbsp;</div>-->
            <div class="row">
                <div class="cell">&nbsp;</div>
               <div class="cell colspan4 padding10 ">
                <h4>Announcements</h4>
                    
                <?php foreach ($announce as $value) {
                $event = array(
                    'title' => $value->title,
                    'description' => $value->description,
                    'date' => $value->date);
                    echo '<div class="blogBox moreBox" style="display: none;"><div class="item"><div class="blogTxt">
          <div class="blogCategory"><h6>&nbsp;<span class="mif-books mif-ani-shuttle"></span>&nbsp;'.$event['title'].'</h6>
                    <div class="cell padding10"><span style="font-family:Arial;font-size:12px;font-weight:12px; line-height: 20px;">'.$event['description'].'</span></div>
                    <div class="cell padding10">&emsp; - <span style="font-family: Arial;font-size:9px">'.$event['date'].'</span></div></div></div></div></div>';}
                    ?>
                    <div id="loadMore" style="">
      <a href="#">Load More</a>
    </div>        
               </div> 

               <div class="cell">&nbsp;</div>
               <div class="cell colspan4 padding10">
                <h4>News</h4>
                <?php foreach ($news as $value) {
                $nevent = array(
                    'title' => $value->title,
                    'description' => $value->description,
                    'date' => $value->date);
                    echo '<div class="blogBox2 moreBox2" style="display: none;"><div class="item2"><div class="blogTxt2"><div class="blogCategory2"><h6>&nbsp;<span class="mif-books mif-ani-shuttle"></span>&nbsp;'.$nevent['title'].'</h6>
                    <div class="cell padding10"><pre style="font-family: Arial;font-size: 10pt;">'.$nevent['description'].'</pre></div>
                    <div class="cell padding10">&emsp; - <span style="font-family: Arial; font-size:9px">'.$nevent['date'].'</span></div></div></div></div></div>';
                }?>
            <div id="loadMore2" style="">
      <a href="#">Load More</a>
    </div>          
            </div>

        </div>

    </div>
</div>
</div>
</div>  

