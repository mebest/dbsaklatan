<div class="cell auto-size padding20 bg-white" id="cell-content">
    <h1 class="text-light">Change Password<span class="mif-user place-right"></span></h1>
    <hr class="thin bg-grayLighter">
    <div>
        <button class="button box" onclick="goBack();">
            <span class="my-text mif-arrow-left"></span> Back</button>
    </div>
    <div class="flex-grid">
        <div class="row"></div>
        <div class="row">
            <div class="cell colspan3"></div>
            <div class="cell colspan6">
                <div class="panel success">
                    <div class="heading success">
                        <span class="icon mif-profile"></span>
                        <span class="title text-shadow">Password Modify</span>
                    </div>
                    <div class="content">
                        <center><br><br>
                            <form data-role="validator" action="<?php echo base_url(); ?>ElibrarySystem/changePass?user_id=<?= $user_id ?>" method="post">

                                <fieldset>
                                    <label>Current Password: </label>
                                    <input name="oldpassword" type="text" data-validate-func="required"
                                           data-validate-hint="field can not be empty!">
                                </fieldset>

                                <fieldset>
                                    <label>New Password: </label>
                                    <input  name="newpassword" type="text" data-validate-func="required"
                                            data-validate-hint="field can not be empty!">
                                </fieldset>
                                <fieldset>
                                    <label>Confirm Password: </label>
                                    <input  name="rpassword" type="text" data-validate-func="required"
                                            data-validate-hint="field can not be empty!">
                                </fieldset>

                                <fieldset>
                                    <button class="button primary" name="subject" type="submit" value="add"><span class="mif-file-upload"></span></button>
                                </fieldset>
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