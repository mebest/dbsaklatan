<body class="bg-darkTeal">
    <div class="login-form padding20 block-shadow box">
        <form data-role="validator" method="POST" action="<?= base_url(); ?>Elogin/verify_login" autocomplete="off">
            <div class="flex-grid">
            <div class="row">
                <div class="cell colspan3">
                <a href="https://dbsmanila.online"><img src="../uploads/logo.png" style="width: 100%; height: 100%;"></a>
                </div>
                <div class="cell colspan1"></div>
                <div class="cell colspan6">
                    <h4 class="text-light"><i>Login to..</i></h4><h4><span class="fg-cyan"><i>&emsp;&emsp;DBS-Library</i></span></h4>
                </div>
            </div>
            </div>
            <hr class="thin"/>
            
            <br /> 
            <div class="input-control modern text iconic" data-role="input">
                <input type="text" name="user_login" id="user_login" style="padding-right: 5px;">
                            <span class="label">You login</span>
                            <span class="informer">Please enter you login or email</span>
                            <span class="placeholder" style="display: none;">Input Username</span>
                            <span class="icon mif-user mif-ani-shake fg-cyan"></span>
                        </div>
            <div class="input-control modern password iconic" data-role="input">
                <input type="password" name="user_password" id="user_password">
                <span class="label">You password</span>
                <span class="informer">Please enter you password</span>
                <span class="placeholder">Input password</span>
                <span class="icon mif-lock mif-ani-shake fg-cyan"></span>
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
           <center>
            <h6 class="minor-header">
             <?=  validation_errors();?>
                </h6>
        </center>
            <div class="form-actions">
                <br>
                <button type="submit" class="button primary">Login</button>

            </div>
            <br />
        </form>
        <div>
            <center><h3><a href="https://dbsmanila.online" onMouseOver="this.style.color='#eaae05'" onMouseOut="this.style.color='#2086bf'" style="text-decoration: none;">DBS PORTAL</a></h3></center>
            <center><i>Need assistance, <a href="mailto:lrc.dbsmanila@gmail.com">Click here!</a></i></center>
        </div>
    </div>
    
   
</body>