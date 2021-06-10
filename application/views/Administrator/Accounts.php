<div data-role="dialog" id="addCatalog" class="padding20" data-close-button="true" data-overlay="true" data-background="bg-darkBlue" data-overlay-click-close="true">
    <div class="grid padding20 fg-white">
        <h1>Excel import thousand row data in second's</h1>
    <form method="post" action="<?php echo site_url('ElibrarySystem/upload')?>" id="upload" enctype="multipart/form-data">
            <p>
            <input type="file" name="file"/></p>
            <br />
            <input type="submit" name="import" value="Import" class="btn btn-info" />
        </form>
    </div>
</div>


<div class="cell auto-size padding10 bg-white" id="cell-content">
    <h1 class="text-light">Accounts<span class="mif-apps place-right"></span></h1>
    <hr class="thin bg-grayLighter">
    <div class="cell box auto-size padding20 bg-white" id="cell-content">  
        <div class="flex-grid">
            <div class="row">
                <div class="cell">
                    <button class="button box fg-blue" onclick="metroDialog.toggle('#addCatalog')">Add Student</button>
                </div>
                <div class="cell colspan4">
                <?php echo validation_errors(); ?>
            </div>
            </div>
            <div class="row colspan12">
                <h1>Students</h1>
                <hr class="thin bg-grayLighter">
            </div>
            <div class="row">
                <div class="cell colspan12">
                    <table id="accounts" class="dataTables_wrapper no-footer hovered border bordered dataTable" data-searching="true" style="width: 100%;">
                                <thead>
                                    <tr>    
                                        <th>Student No.</th>
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>Grade</th>
                                        <th>Email</th>
                                        <th>Online Status</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                </div>
            </div>
            <br>
            <br>
            <div class="row colspan12">
                <h1>Educators</h1>
                <hr class="thin bg-grayLighter">
            </div>
            <div class="row">
                <div class="cell colspan12">
                    <table id="teachers" class="dataTables_wrapper no-footer hovered border bordered dataTable" data-searching="true" style="width: 100%;">
                                <thead>
                                    <tr>    
                                        <th>Emp #.</th>
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Online Status</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                </div>
            </div>
            <br>
            <br>
            <div class="row colspan12">
                <h1>Librarian</h1>
                <hr class="thin bg-grayLighter">
            </div>
            <div class="row">
                <div class="cell colspan12">
                    <table id="librarian" class="dataTables_wrapper no-footer hovered border bordered dataTable" data-searching="true" style="width: 100%;">
                                <thead>
                                    <tr>    
                                        <th>Emp #.</th>
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                </div>
            </div>
            <br>
            <br>
        </div> 
    </div>
</div> 
</body>