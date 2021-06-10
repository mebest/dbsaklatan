<div data-role="dialog" id="addCatalog" class="padding20" data-close-button="true" data-overlay="true" data-background="bg-darkBlue" data-overlay-click-close="true">
    <div class="grid padding20 fg-white">
        <form action="<?php echo site_url('ElibrarySystem/insert_catalog?type=Phys.B') ?>" method="post" enctype="multipart/form-data">
            <div class="row cells3">
                <div class="cell">
                <label>Call No:</label>
                <div class="input-control text full-size">
                    <input type="text" name="callno">
                </div>
            </div>
            <div class="cell">
                <label>Location:</label>
                <div class="input-control text full-size">
                    <input type="text" name="location">
                </div>
            </div>
            <div class="cell">
                <label>Description:</label>
                <div class="input-control text full-size">
                    <input type="text" name="description">
                </div>
            </div>    
            </div>
            <div class="row cells3">
                <div class="cell">
                <label>Title:</label>
                <div class="input-control text full-size">
                    <input type="text" name="title">
                </div>
            </div>
             <div class="cell">
                <label>Author:</label>
                <div class="input-control text full-size">
                    <input type="text" name="author">
                </div>
            </div>
            <div class="cell">
                <label>Copies:</label>
                <div class="input-control text full-size">
                    <input type="number" name="copies">
                </div>
            </div> 
            </div> 
            <div class="row cells3">
                <div class="cell">
                <label>Accession:</label>
                <div class="input-control text full-size">
                    <input type="text" name="accession">
                </div>
            </div>
            <div class="cell">
                <label>Publisher:</label>
                <div class="input-control text full-size">
                    <input type="text" name="publisher">
                </div>
            </div>
            <div class="cell padding10">
                <label>Book Cover:</label>
                <input type="file" id="cover" name="cover" size="33" />
            </div>     
            </div>
            <div class="row cells3">
                <div class="cell">
                <label>Isbn:</label>
                <div class="input-control text full-size">
                    <input type="text" name="isbn">
                </div>
            </div>
            <div class="cell">
                    <label>Copyright:</label>
                <div class="input-control text full-size">
                    <input type="text" name="copyright">
                </div>
                </div>
            <div class="cell" style="text-align: right;">
                    <input type="submit" class="button success" value="Add Item">
                </div>    
            </div>
            <div class="row cells3">
                <div class="cell">
                <label>Volume:</label>
                <div class="input-control text full-size">
                    <input type="text" name="volume">
                </div>
            </div>
                <div class="cell">
                <label>Series:</label>
                <div class="input-control text full-size">
                    <input type="text" name="series">
                </div>
            </div>
            </div>
            <div class="row cells3">
            <div class="cell">
                <label>Edition:</label>
                <div class="input-control text full-size">
                    <input type="number" name="copies">
                </div>
            </div>
            <div class="cell">
                <label>Subject:</label>
                <div class="input-control text full-size">
                    <input type="text" name="subject">
                </div>
            </div>        
            </div>
        </form>
    </div>
</div>
<div data-role="dialog" id="addCatalogE" class="padding20" data-close-button="true" data-overlay="true" data-background="bg-darkBlue" data-overlay-click-close="true">
    <div class="grid padding20 fg-white">
        <form action="<?php echo site_url('ElibrarySystem/insert_catalog?type=E-Book') ?>" method="post" enctype="multipart/form-data">
            <div class="row cells3">
                <div class="cell">
                <label>Call No:</label>
                <div class="input-control text full-size">
                    <input type="text" name="callno">
                </div>
            </div>
            <div class="cell">
                <label>Location:</label>
                <div class="input-control text full-size">
                    <input type="text" name="location">
                </div>
            </div>
            <div class="cell">
                <label>Description:</label>
                <div class="input-control text full-size">
                    <input type="text" name="description">
                </div>
            </div>    
            </div>
            <div class="row cells3">
                <div class="cell">
                <label>Title:</label>
                <div class="input-control text full-size">
                    <input type="text" name="title">
                </div>
            </div>
             <div class="cell">
                <label>Author:</label>
                <div class="input-control text full-size">
                    <input type="text" name="author">
                </div>
            </div>
            <div class="cell">
                <label>Copies:</label>
                <div class="input-control text full-size">
                    <input type="number" name="copies">
                </div>
            </div> 
            </div> 
            <div class="row cells3">
                <div class="cell">
                <label>Accession:</label>
                <div class="input-control text full-size">
                    <input type="text" name="accession">
                </div>
            </div>
            <div class="cell">
                <label>Publisher:</label>
                <div class="input-control text full-size">
                    <input type="text" name="publisher">
                </div>
            </div>
            <div class="cell padding10">
                <label>Book Cover:</label>
                <input type="file" id="cover" name="cover" size="33" />
            </div>     
            </div>
            <div class="row cells3">
                <div class="cell">
                <label>Isbn:</label>
                <div class="input-control text full-size">
                    <input type="text" name="isbn">
                </div>
            </div>
            <div class="cell">
                    <label>Copyright:</label>
                <div class="input-control text full-size">
                    <input type="text" name="copyright">
                </div>
                </div>
            <div class="cell" style="text-align: right;">
                    <input type="submit" class="button success" value="Add Item">
                </div>    
            </div>
            <div class="row cells3">
                <div class="cell">
                <label>Volume:</label>
                <div class="input-control text full-size">
                    <input type="text" name="volume">
                </div>
            </div>
                <div class="cell">
                <label>Series:</label>
                <div class="input-control text full-size">
                    <input type="text" name="series">
                </div>
            </div>
            </div>
            <div class="row cells3">
            <div class="cell">
                <label>Edition:</label>
                <div class="input-control text full-size">
                    <input type="number" name="copies">
                </div>
            </div>
            <div class="cell">
                <label>Subject:</label>
                <div class="input-control text full-size">
                    <input type="text" name="subject">
                </div>
            </div>        
            </div>
        </form>
    </div>
</div>

<div class="cell auto-size padding10 bg-white" id="cell-content">
    <h1 class="text-light">Request<span class="mif-apps place-right"></span></h1>
    <hr class="thin bg-grayLighter">
    <div class="cell box auto-size padding20 bg-white" id="cell-content">  
        <div class="flex-grid">
            <div class="row">
                <div class="cell colspan12">
                    <table id="reservelist" class="dataTables_wrapper no-footer hovered border bordered dataTable" data-searching="true" style="width: 100%;">
                                <thead>
                                    <tr>    
                                        <th>Id</th>
                                        <th>R.Date</th>
                                        <th>Name</th>
                                        <th>Grade</th>
                                        <th>Subject Area</th>
                                        <th>Section/Track</th>
                                        <th>Callno.</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                </div>
            </div>
            <br>
            <br> 
    </div>
</div> 
</body>