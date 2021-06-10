<div data-role="dialog" id="add" class="padding20" data-close-button="true" data-overlay="true" data-background="bg-darkBlue" data-overlay-click-close="true">
    <div class="flex-grid padding20">
        <form action="<?php echo site_url('ElibrarySystem/insert_slider') ?>" method="post" enctype="multipart/form-data">
            <div class="cell">
                <label class="fg-white">Title:</label>
                <div class="input-control text full-size">
                    <input type="text" name="title">
                </div>
            </div>
            <div class="cell">
                <label class="fg-white">Sub-Title:</label>
                <div class="input-control text full-size">
                    <input type="text" name="subtitle">
                </div>
            </div>
            <div class="cell">
                <label class="fg-white">Description:</label>
                <div class="input-control text full-size">
                    <input type="text" name="description">
                </div>
            </div></br></br>
            <div class="cell colspan4" id="cell-content">
                <div class="row">
                    <div class="cell"> 
                        <label class="fg-white">Background Image:</label>
                        <input type="file" id="image" name="file" size="33" />
                    </div>
                    <div class="cell colspan3"></div>
                    <div class="cell"> 
                        <input type="submit" class="button primary" value="Add">
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<div data-role="dialog" id="remove" class="padding20" data-close-button="true" data-overlay="true" data-background="bg-darkBlue" data-overlay-click-close="true">
<div class="flex-grid padding20">
        <form action="<?php echo site_url('ElibrarySystem/remove_slider') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="cell colspan6 padding10">
                    <label class="fg-white">ID: </label>
                    <div class="input-control text full-size">
                        <select name="sliderremoveid">
                            <option>Select ID</option>
                            <?php
                            foreach ($slide as $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['id'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="cell padding10">
                    <label class="fg-white">-</label> 
                    <input type="submit" class="button danger" value="Remove">
                </div>
            </div>
        </form>
</div>       
</div>

<div data-role="dialog" id="update" class="padding20" data-close-button="true" data-overlay="true" data-background="bg-darkBlue" data-overlay-click-close="true">
    <div class="flex-grid padding20">
        <form action="<?php echo site_url('ElibrarySystem/update_slider') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="cell colspan5 padding10">
                    <label class="fg-white">ID: </label>
                    <div class="input-control text full-size">
                        <select name="sliderid" id="sliderid">
                            <option>Select ID</option>
                            <?php
                            foreach ($slide as $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['id'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div></br>    
            <div class="row">
                <div class="cell colspan6 padding10">
                    <label class="fg-white">Title: </label>
                    <div class="input-control text full-size">
                        <input type="text" id="titleslider" name="titleslider">
                    </div>
                </div>
                <div class="cell colspan5 padding10">
                    <label class="fg-white">Description: </label>
                    <div class="input-control text full-size">
                        <textarea type="text" id="description" name="description"
                            style="margin: 0px; height: 212px; width: 283px;">
                        </textarea>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="cell colspan6 padding10">
                    <label class="fg-white">Sub-Title: </label>
                    <div class="input-control text full-size">
                        <input type="text" id="subtitle" name="subtitle">
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="cell colspan6 padding10">
                    <label class="fg-white">Status: </label>
                    <div class="input-control text full-size">
                        <input type="text" id="status" name="status">
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="cell colspan6 padding10"> 
                    <label class="fg-white">Background Image:</label>
                    <input type="file" id="imageUpdate" name="fileUpdate" size="33" />
                </div>
                <div class="cell colspan2"></div>
                <div class="cell padding10"> 
                    <input type="submit" class="button success" value="Update">
                </div>
            </div>
        </form>
    </div>
</div>


<div class="cell auto-size padding10 bg-white" id="cell-content">
    <h1 class="text-light">Home Page<span class="mif-apps place-right"></span></h1>
    <hr class="thin bg-grayLighter">
    <div class="cell auto-size padding20 bg-white" id="cell-content">  
        <div class="flex-grid">


            <div class="row">
                <div class="tabcontrol2" data-role="tabcontrol">
                    <ul class="tabs">
                        <li><a href="#home_slider">Home Slider</a></li>
                        <li><a href="#Logs" onclick="return logloadme();">Logs</a></li>
                    </ul>
                    <div class="frames">
                        <div class="frame" id="home_slider">
                            <button class="button fg-blue" onclick="metroDialog.toggle('#add')">Manual Add</button>
                            <button class="button fg-blue" onclick="metroDialog.toggle('#remove')">Remove</button>
                            <button class="button fg-blue" onclick="metroDialog.toggle('#update')">Edit</button>

                            <table id="manageHomePage" class="dataTables_wrapper no-footer hovered border bordered dataTable"  
                                   data-searching="true" style="width: 100%;">
                                <thead>
                                    <tr>    
                                        <th>Id</th>
                                        <th>Background</th>
                                        <th>Title</th>
                                        <th>Sub-Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>

                            </br></br></br>

                        </div>

                        <div class="colspan1"></div>
                        <div class="frame colspan3" id="Logs">
                            <h3>Log</h3><div id="preloads" class="loadersd"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                            <textarea id="loginlog" cols="80" rows="25" style="white-space: pre-wrap;">
                                
                            </textarea>
                            Filename to Save As:
        <input id="inputFileNameToSaveAs"></input>
        <button onclick="saveTextAsFile()">Save Text to File</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
        </div> 
    </div>
</div>
</div>
</div>  
</body>
