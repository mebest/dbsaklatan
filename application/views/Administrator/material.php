<div class="cell auto-size padding10 bg-white" id="cell-content">
    <h1 class="text-light"><a href="Catalog">&lt;</a>Material<span class="mif-apps place-right"></span></h1>
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
                        <li><a href="#Update" onclick="return updatedetailsm();">Update Details</a></li>
                    </ul>
                    <div class="frames">
                        <div class="frame" id="Add">
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>Accession No.:</h6><?=$book_info['accession']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Equipment ID:</h6><?=$book_info['equipment_id']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Date of Purchase:</h6><?=$book_info['dop']?>
                </div>

            </div>
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>Manufacture:</h6><?=$book_info['manufacture']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Description:</h6><?=$book_info['description']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Format:</h6><?=$book_info['format']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Quantity:</h6><?=$book_info['quantity']?>
                </div>
                
            </div>
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>Status:</h6><?php if($book_info['quantity'] == 0){
                echo '<span class="tag bg-lightRed fg-white">Onloan</span>';
            }else{
                echo '<span class="tag bg-lightGreen fg-white">Available</span>';
            }?>
                </div>
                </div>
            <div class="row">
                <div class="cell colspan7 padding10">
            </div>
            <div class="cell colspan2 padding10">
                Encode/Upload By: <?=$book_info['upload']?>
            </div>
        </div>
            </div>
                <div class="frame" id="Update">
                    <form action="<?php echo site_url('ElibrarySystem/updatematerial?access='.$book_info['access'].'') ?>" method="post" enctype="multipart/form-data">

                    <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <label>Accession No:</label>
                <div class="input-control text">
                            <input type="text" name="accession" id="maccession">
                </div>
                </div>
                <div class="cell padding10 colspan3">
                    <label>Equipment ID:</label>
                <div class="input-control text">
                            <input type="text" name="equipment_id" id="mequipment_id">
                </div>
                </div>
                <div class="cell padding10 colspan3">
                <label>Date Of Purchase:</label>
                <div class="input-control text" data-role="datepicker" data-date="1972-12-21" data-format="mmmm d, yyyy">
                            <input type="text" name="dop" id="mdop">
                            <button class="button buttons-excel"><span class="mif-calendar"></span></button>
            </div>
                </div>
                <div class="cell padding10 colspan3">
                    <label>Status:</label>
                <div class="input-control text">
                           <?php if($book_info['quantity'] == 0){
                echo '<span class="tag bg-lightRed fg-white">Onloan</span>';
            }else{
                echo '<span class="tag bg-lightGreen fg-white">Available</span>';
            }?>
                </div>
                </div>
            </div>
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <label>Manufacture:</label>
                <div class="input-control text">
                            <input type="text" name="manufacture" id="mmanufacture">
                </div>
                </div>
                <div class="cell padding10 colspan3">
                    <label>Description:</label>
                <div class="input-control text">
                            <input type="text" name="description" id="mdescription">
                </div>
                </div>
                <div class="cell padding10 colspan3">
                    <label>Format:</label>
                <div class="input-control text">
                            <input type="text" name="format" id="mformat">
                </div>
            </div>
            <div class="cell padding10 colspan3">
                    <label>Quantity:</label>
                <div class="input-control text">
                            <input type="text" name="quantity" id="mquantity">
                </div>
            </div>
           
                </div>
                <div class="row cells4">
                     <div class="cell padding10">
                <label class="fg-white">Cover Image:</label>
                <input type="file" id="mcoveradde" name="imageadd" size="33" />
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
</body>
