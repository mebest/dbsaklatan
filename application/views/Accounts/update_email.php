<div class="cell auto-size padding20 bg-white" id="cell-content">
    <h1 class="text-light">Update Email<span class="mif-user place-right"></span></h1>
    <hr class="thin bg-grayLighter">
    <div>
        <button class="button box" onclick="goBack();">
            <span class="my-text mif-arrow-left"></span> Back</button>
    </div>
    <div class="flex-grid">
        <div class="row"></div>
        <div class="row">
            <div class="cell colspan4"></div>
            <div class="cell colspan4">
                <div class="panel success">
                    <div class="heading success">
                        <span class="icon mif-envelop"></span>
                        <span class="title text-shadow">Email</span>
                    </div>
                    <div class="content">
                        <center><br><br>
                            <form data-role="validator" action="<?php echo base_url(); ?>ElibrarySystem/updateEmail?user_id=<?= $user_id ?>" method="post">
                            <div class="row">
                                <div class="cell colspan3"></div>
                                <?php if($user_log['email']){
                                    echo '<div class="cell colspan5"><span class="tag bg-lightOrange sub-alt-header">Current: '.$user_log['email'].'</span></div>';
                                }else{
                                    echo '<div class="cell colspan3"><span class="tag bg-lightOrange sub-alt-header">Current: None</span></div>';
                                }
                                ?>
                            </div>
                            <div class="row">
                            <div class="cell colspan3"></div>
                            <div class="cell coslpan4">
                            <div class="input-control text" data-role="input">
                                    <input  name="newemail" type="text" data-validate-func="email" placeholder="Email" data-validate-hint="Not valid email address">
                                    <span class="input-state-error mif-warning"></span>
                            <span class="input-state-success mif-checkmark"></span>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="cell colspan3"></div>
                            <div class="cell coslpan4">
                            <div class="input-control text" data-role="input">    
                                    <input name="remail" type="text" data-validate-func="email" placeholder="Confirm Email" data-validate-hint="Not valid email address">
                                    <span class="input-state-error mif-warning"></span>
                            <span class="input-state-success mif-checkmark"></span>        
                             </div>
                            </div>
                         </div>
                             <div class="row">
                            <div class="cell colspan5"></div>
                            <div class="cell coslpan4">
                            
                                    <button class="button primary" name="subject" type="submit" value="add"><span class="mif-file-upload"></span></button>
                                
                            </div></div>
                                <?= validation_errors(); ?>
                            </form>
                            <br></center>
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