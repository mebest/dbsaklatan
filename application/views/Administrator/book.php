<div class="cell auto-size padding10 bg-white" id="cell-content">
    <h1 class="text-light"><a href="Catalog">&lt;</a>Book<span class="mif-apps place-right"></span></h1>
    <hr class="thin bg-grayLighter">
    <div class="cell auto-size padding20 bg-white" id="cell-content">  
       
       
        <div class="flex-grid">
            <div class="row cells3">
                <div class="cell colspan3 box padding10">
                    <img alt="Book Cover" src="<?=base_url()?><?=$book_info['bookcover']?>" style="height: 500px; width: 400px;">
                </div>&emsp;&emsp;
                <div class="flex-grid">
                     
                <div class="tabcontrol2" data-role="tabcontrol">
                    <ul class="tabs">
                        <li><a href="#Add">Book Details</a></li>
                        <li><a href="#Update" onclick="return updatedetails();">Update Details</a></li>
                    </ul>
                    <div class="frames">
                        <div class="frame" id="Add">
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>Call No.:</h6><?=$book_info['callno']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Accession No.:</h6><?=$book_info['accession']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Title:</h6><?=$book_info['title']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Location:</h6><?=$book_info['location']?>
                </div>

            </div>
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>ISBN:</h6><?=$book_info['isbn']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Author:</h6><?=$book_info['author']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Copyright:</h6><?=$book_info['copyright']?>
                </div>
            </div>
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>Publisher:</h6><?=$book_info['publisher']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Series:</h6><?=$book_info['series']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Volume:</h6><?=$book_info['volume']?>
                </div>
            </div>
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>Edition:</h6><?=$book_info['edition']?>
                </div>
                            <div class="cell padding10 colspan3">
                    <h6>Description:</h6><?=$book_info['description']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Category:</h6><?php if($book_info['classification'] == 0){
                        echo "Fiction";
                    }elseif($book_info['classification'] == 1){
                        echo "Non-Fiction";
                    }?>
                </div>
                
            </div>
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>Subject:</h6><?=$book_info['subject']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Available Copies:</h6><?=$book_info['copies']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Status:</h6><?php if($book_info['copies'] == 0){
                echo '<span class="tag bg-lightBlue fg-white">Onloan</span>';
            }else{
                echo '<span class="tag bg-lightGreen fg-white">Available</span>';
            }?>
                </div>
            </div>
            <div class="row">
                <div class="cell colspan7 padding10">
            </div>
            <div class="cell colspan3 padding10">
                Encode/Upload By: </br><?=$book_info['createdby']?>
            </div>
        </div>
            </div>
                <div class="frame" id="Update">
                    <form action="<?php echo site_url('ElibrarySystem/updatebook?access='.$book_info['access'].'') ?>" method="post" enctype="multipart/form-data">

                    <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>Call No.:</h6><input name="callno" id="callno" value="<?=$book_info['callno']?>">
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Accession:</h6><input type="text" id="uaccession" name="uaccession">
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Title:</h6><input type="text" id="utitle" name="utitle">
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Location:</h6><select id="ulocation" name="ulocation">
                        <option default>-</option>
                        <option value="Easy Reading Section">Easy Reading Section</option>
                        <option value="Fil/Fic Section">Fil/Fic Section</option>
                        <option value="Fiction Section">Fiction Section</option>
                        <option value="Grade School Section">Grade School Section</option>
                        <option value="High School Section">High School Section</option>
                        <option value="Filipiniana Section">Filipiniana Section</option>
                        <option value="SHS Library">SHS Library</option>
                        <option value="Main Library-Gen. Reference">Main Library-Gen. Reference</option>
                        <option value="Teacher's Collection">Teacher's Collection</option>
                        <option value="Salesianity Corner">Salesianity Corner</option>
                    </select>
                </div>
                
            </div>
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>ISBN:</h6><input type="text" id="uisbn" name="uisbn">
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Author:</h6><input type="text" id="uauthor" name="uauthor">
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Copyright:</h6><input type="text" id="ucopyright" name="ucopyright">
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Status:</h6><?php if($book_info['copies'] == 0){
                echo '<span class="tag bg-lightRed fg-white">Unavailable</span>';
            }else{
                echo '<span class="tag bg-lightGreen fg-white">Available</span>';
            }?>
                </div>
            </div>
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>Publisher:</h6><input type="text" id="upublisher" name="upublisher">
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Series:</h6><input type="text" id="useries" name="useries">
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Volume:</h6><input type="text" id="uvolume" name="uvolume">
                </div>
            </div>
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>Edition:</h6><input type="text" id="uedition" name="uedition">
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Subject:</h6>
                    <textarea type="text" id="usubject" name="usubject" style="margin: 0px; width: 150px; height: 25px;"></textarea>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Available Copies:</h6><input type="number" id="ucopies" name="ucopies">
                </div>
                 
            </div>
            <div class="row">
                <div class="cell padding10 colspan3">
                    <h6>Description:</h6><textarea type="text" id="udescription" name="udescription" style="margin: 0px; width: 171px; height: 34px;"></textarea>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Category:</h6>
                    <select name="uclassification">
                        <?php
                        $select = 'selected="selected"'; 
                        if($book_info['classification'] == 0){
                        echo '<option value="0" '.$select.'>Fiction</option>
                        <option value="1">Non-Fiction</option>';
                    }elseif($book_info['classification'] == 1){
                        echo '<option value="0" >Fiction</option>
                        <option value="1" '.$select.'>Non-Fiction</option>';
                    }?>
                    </select>
                    
                </div>
                <div class="cell padding10">
                <label class="fg-white">Book Cover:</label>
                <input type="file" id="ucoveradd" name="ucoveradd" size="33" />
            </div>
            <div class="cell padding10" style="text-align: right;">

                    <h6>&nbsp;</h6>
                    
                    <button class="btn btn-success" onclick="showSwal('success-message')">Update</button>
                </div>
            </div>
        </form>
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>  
</body>
