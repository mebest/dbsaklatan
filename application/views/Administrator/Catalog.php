<!--Add Physical Book-->
<div data-role="dialog" id="addCatalog" class="padding20" data-close-button="true" data-overlay="true" data-background="bg-darkBlue" data-overlay-click-close="true">
    <div class="grid padding20">
        <form action="<?php echo site_url('ElibrarySystem/insert_catalog?type=Phys.B') ?>" method="post" enctype="multipart/form-data">
            <div class="row cells3">
                <div class="cell">
                <label class="fg-white">Call No:</label>
                <div class="input-control text full-size">
                    <input type="text" name="callno">
                </div>
            </div>
            <div class="cell">
                <label class="fg-white">Location:</label>
                <div class="input-control text full-size">
                    <select name="location">
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
            <div class="cell">
                <label class="fg-white">Description:</label>
                <div class="text full-size">
                    <textarea type="text" id="description" name="description" style="margin: 0px; width: 209px; height: 39px;"></textarea>
                </div>
            </div>    
            </div>
            <div class="row cells3">
                <div class="cell">
                <label class="fg-white">Title:</label>
                <div class="input-control text full-size">
                    <input type="text" name="title">
                </div>
            </div>
             <div class="cell">
                <label class="fg-white">Author:</label>
                <div class="input-control text full-size">
                    <input type="text" name="author">
                </div>
            </div>
            <div class="cell">
                <label class="fg-white">Copies:</label>
                <div class="input-control text full-size">
                    <input type="text" name="copies">
                </div>
            </div> 
            </div> 
            <div class="row cells3">
                <div class="cell">
                <label class="fg-white">Accession:</label>
                <div class="input-control text full-size">
                    <input type="text" name="accession">
                </div>
            </div>
            <div class="cell">
                <label class="fg-white">Publisher:</label>
                <div class="input-control text full-size">
                    <input type="text" name="publisher">
                </div>
            </div>
            <div class="cell">
                <label class="fg-white">Category:</label>
                <div class="input-control text full-size">
                    <select name="classification">
                        <option value="0" '.$select.'>Fiction</option>
                        <option value="1">Non-Fiction</option>
                    </select>
                </div>
            </div>    
            </div>
            <div class="row cells3">
                <div class="cell">
                <label class="fg-white">ISBN:</label>
                <div class="input-control text full-size">
                    <input type="text" name="isbn" style="text-transform:uppercase">
                </div>
            </div>
            <div class="cell">
                    <label class="fg-white">Copyright:</label>
                <div class="input-control text full-size">
                    <input type="text" name="copyright">
                </div>
                </div>
                <div class="cell padding10">
                <label class="fg-white">Book Cover:</label>
                <input type="file" id="coveradd" name="coveradd" size="33" />
            </div> 
                
            </div>
            <div class="row cells3">
                <div class="cell">
                <label class="fg-white">Volume:</label>
                <div class="input-control text full-size">
                    <input type="text" name="volume">
                </div>
            </div>
                <div class="cell">
                <label class="fg-white">Series:</label>
                <div class="input-control text full-size">
                    <input type="text" name="series">
                </div>
            </div>
            <div class="cell" style="text-align: right;">
                    <button class="btn btn-success" onclick="showSwal('insert-message')">Add</button>
                </div>
            </div>
            <div class="row cells3">
            <div class="cell">
                <label class="fg-white">Edition:</label>
                <div class="input-control text full-size">
                    <input type="text" name="Edition">
                </div>
            </div>
            <div class="cell">
                <label class="fg-white">Subject:</label>
                <div class="text full-size">
                    <textarea type="text" id="subject" name="subject" style="margin: 0px; width: 209px; height: 39px;"></textarea>
                </div>
            </div>        
            </div>
        </form>
    </div>
</div>

<!--Add E-book Book-->
<div data-role="dialog" id="addCatalogE" class="padding20" data-close-button="true" data-overlay="true" data-background="bg-darkBlue" data-overlay-click-close="true">
    <div class="grid padding20">
        <form action="<?php echo site_url('ElibrarySystem/insert_catalog?type=E-Book') ?>" method="post" enctype="multipart/form-data">
            <div class="row cells3">
                <div class="cell">
                <label class="fg-white">Call No:</label>
                <div class="input-control text full-size">
                    <input type="text" name="callno">
                </div>
            </div>
            <div class="cell">
                <label class="fg-white">Location:</label>
                <div class="input-control text full-size">
                    <select name="location">
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
            <div class="cell">
                <label class="fg-white">Description:</label>
                <div class=" text full-size">
                    <textarea type="text" id="description" name="description" style="margin: 0px; width: 209px; height: 39px;"></textarea>
                </div>
            </div>    
            </div>
            <div class="row cells3">
                <div class="cell">
                <label class="fg-white">Title:</label>
                <div class="input-control text full-size">
                    <input type="text" name="title">
                </div>
            </div>
             <div class="cell">
                <label class="fg-white">Author:</label>
                <div class="input-control text full-size">
                    <input type="text" name="author">
                </div>
            </div>
            <div class="cell">
                <label class="fg-white">Copies:</label>
                <div class="input-control text full-size">
                    <input type="text" name="copies">
                </div>
            </div> 
            </div> 
            <div class="row cells3">
                <div class="cell">
                <label class="fg-white">Accession:</label>
                <div class="input-control text full-size">
                    <input type="text" name="accession">
                </div>
            </div>
            <div class="cell">
                <label class="fg-white">Publisher:</label>
                <div class="input-control text full-size">
                    <input type="text" name="publisher">
                </div>
            </div>
               <div class="cell">
                <label class="fg-white">Category:</label>
                <div class="input-control text full-size">
                    <select name="classification">
                        <option value="0" >Fiction</option>
                        <option value="1">Non-Fiction</option>
        
                    </select>
                </div>
            </div> 
            </div>
            <div class="row cells3">
                <div class="cell">
                <label class="fg-white">ISBN:</label>
                <div class="input-control text full-size">
                    <input type="text" name="isbn" style="text-transform:uppercase">
                </div>
            </div>
            <div class="cell">
                    <label class="fg-white">Copyright:</label>
                <div class="input-control text full-size">
                    <input type="text" name="copyright">
                </div>
                </div>
                <div class="cell padding10">
                <label class="fg-white">Book Cover:</label>
                <input type="file" id="coveradde" name="coveradde" size="33" />
            </div>
            </div>
            <div class="row cells3">
                <div class="cell">
                <label class="fg-white">Series:</label>
                <div class="input-control text full-size">
                    <input type="text" name="series">
                </div>
            </div>
            <div class="cell">
                <label class="fg-white">Volume:</label>
                <div class="input-control text full-size">
                    <input type="text" name="volume">
                </div>
            </div>
             <div class="cell" style="text-align: right;">
                    <button class="btn btn-success" onclick="showSwal('insert-message')">Add</button>
                </div>   
            </div>
            <div class="row cells3">
            <div class="cell">
                <label class="fg-white">Edition:</label>
                <div class="input-control text full-size">
                    <input type="text" name="edition">
                </div>
            </div>
            <div class="cell">
                <label class="fg-white">Subject:</label>
                <div class=" text full-size">
                    <textarea type="text" id="subject" name="subject" style="margin: 0px; width: 209px; height: 39px;"></textarea>
                </div>
            </div>        
            </div>
        </form>
    </div>
</div>

<!--Add AV Material-->
<div data-role="dialog" id="addCatalogAV" class="padding20" data-close-button="true" data-overlay="true" data-background="bg-darkBlue" data-overlay-click-close="true">
    <div class="grid padding20">
        <form action="<?php echo site_url('ElibrarySystem/insert_material') ?>" method="post" enctype="multipart/form-data">
            <div class="row cells2">
                <div class="cell">
                <label class="fg-white">Accession #:</label>
                <div class="input-control text full-size">
                    <input type="text" name="accession">
                </div>
            </div>
            <div class="cell">
                <label class="fg-white">Equipment ID:</label>
                <div class="input-control text full-size">
                    <input type="text" name="equipmentid">
                </div>
            </div>
            </div>
            <div class="row cells2">
                <div class="cell">
                <label class="fg-white">Date Of Purchase:</label>
                <div class="input-control text" data-role="datepicker" data-date="1972-12-21" data-format="mmmm d, yyyy">
                            <input type="text" name="dpurchase">
                            <button class="button buttons-excel"><span class="mif-calendar"></span></button>
                        </div>
            </div>
                <div class="cell">
                <label class="fg-white">Brand:</label>
                <div class="input-control text full-size">
                    <input type="text" name="manufacturer">
                </div>
            </div>
             
            </div> 
            
            <div class="row cells2">
                <div class="cell">
                <label class="fg-white">Description:</label>
                <div class=" text full-size">
                    <textarea type="text" id="description" name="description" style="margin: 0px; width: 209px; height: 39px;"></textarea>
                </div>
            </div> 
            <div class="cell">
                <label class="fg-white">Format/Type:</label>
                <div class="input-control text full-size">
                    <input type="text" name="format">
                </div>
            </div> 
            </div>
            <div class="row cells2">
                <div class="cell">
                <label class="fg-white">Quantity:</label>
                <div class="input-control text full-size">
                    <input type="text" name="quantity">
                </div>
            </div>     
            <div class="cell padding10">
                <label class="fg-white">Cover Image:</label>
                <input type="file" id="coveradde" name="imageadd" size="33" />
            </div>
            <div class="cell padding10">
                <button class="btn btn-success" onclick="showSwal('insert-message')">Add</button>
            </div>
            </div>
        </form>
    </div>
</div>

<!--Add Non-Print-->
<div data-role="dialog" id="addNonPrint" class="padding20" data-close-button="true" data-overlay="true" data-background="bg-darkBlue" data-overlay-click-close="true">
    <div class="grid padding20">
        <form action="<?php echo site_url('ElibrarySystem/insert_material') ?>" method="post" enctype="multipart/form-data">
            <div class="row cells2">
                <div class="cell">
                <label class="fg-white">Call #:</label>
                <div class="input-control text full-size">
                    <input type="text" name="callno">
                </div>
            </div>
            <div class="cell">
                <label class="fg-white">Title:</label>
                <div class="input-control text full-size">
                    <input type="text" name="title">
                </div>
            </div>
            </div>
            <div class="row cells2">
                <div class="cell">
                <label class="fg-white">Date Of Purchase:</label>
                <div class="input-control text" data-role="datepicker" data-date="1972-12-21" data-format="mmmm d, yyyy">
                            <input type="text" name="dpurchase">
                            <button class="button buttons-excel"><span class="mif-calendar"></span></button>
                        </div>
            </div>
                <div class="cell">
                <label class="fg-white">Manufacturer:</label>
                <div class="input-control text full-size">
                    <input type="text" name="manufacturer">
                </div>
            </div>
             
            </div> 
            
            <div class="row cells2">
                <div class="cell">
                <label class="fg-white">Description:</label>
                <div class=" text full-size">
                    <textarea type="text" id="description" name="description" style="margin: 0px; width: 209px; height: 39px;"></textarea>
                </div>
            </div> 
            <div class="cell">
                <label class="fg-white">Format:</label>
                <div class="input-control text full-size">
                    <input type="text" name="format">
                </div>
            </div> 
            </div>
            <div class="row cells2">
            <div class="cell padding10">
                <label class="fg-white">Cover Image:</label>
                <input type="file" id="coveradde" name="imageadd" size="33" />
            </div>
            <div class="cell padding10">
                <button class="btn btn-success" onclick="showSwal('insert-message')">Add</button>
            </div>
            </div>
        </form>
    </div>
</div>

<div class="cell auto-size padding10 bg-white" id="cell-content">
    <h1 class="text-light">Catalog<span class="mif-apps place-right"></span></h1>
    <hr class="thin bg-grayLighter">
    <div class="cell box auto-size padding20 bg-white" id="cell-content">  
        <div class="flex-grid">
            <div class="row">
                <div class="cell">
                    <button class="button box bg-lightBlue fg-white" onclick="metroDialog.toggle('#addCatalogAV')">AV Materials</button>
                </div>&emsp;
                <div class="cell">
                    <button class="button box bg-teal fg-white" onclick="metroDialog.toggle('#addCatalog')">&emsp;Book&emsp;</button>
                </div>&emsp;
                <div class="cell">
                    <button class="button box bg-olive fg-white" onclick="metroDialog.toggle('#addNonPrint')">Non-Print Materials</button>
                </div>&emsp;
                <div class="cell">
                    <button class="button box bg-taupe fg-white" onclick="metroDialog.toggle('')">Continuing Resource</button>
                </div>&emsp;
                <div class="cell">
                    <button class="button box bg-mauve fg-white" onclick="metroDialog.toggle('#addCatalogE')">E-Book</button>
                </div>&emsp;

                <div class="cell colspan4">
                <?php echo validation_errors(); ?>
            </div>
            </div>
            </br>
            </br>
            <div class="row">
                <div class="cell colspan12">
                    <div class="tabcontrol2" data-role="tabcontrol">
                            <ul class="tabs">
                                <li><a href="#Book">Books</a></li>
                                <li><a href="#Material">Materials</a></li>
                                <li><a href="#Equipment">Equipment</a></li>
                            </ul>
                            <div class="frames">
                                <div class="frame" id="Book">
                                    <table id="catalog" class="dataTables_wrapper no-footer hovered border bordered dataTable" data-searching="true" style="width: 100%;">
                                <thead>
                                    <tr>    
                                        <th>Id</th>
                                        <th>Book Cover</th>
                                        <th>Call no.</th>
                                        <th>Acc no.</th>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Author</th>
                                        <th>Edition</th>
                                        <th>Copies</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                            </table>
                                    </div>
                                    <div class="frame" id="Material">
                                        <table id="material" class="dataTables_wrapper no-footer hovered border bordered dataTable" data-searching="true" style="width: 100%;">
                                <thead>
                                    <tr>    
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Acc no.</th>
                                        <th>Equipment ID</th>
                                        <th>Date of Purchase</th>
                                        <th>Brand</th>
                                        <th>Description</th>
                                        <th>Format/Type</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                                    </div>
                                    </div>
                                    </div>
                </div>
                
            </div>
        </div> 
    </div>
</div> 
</body>