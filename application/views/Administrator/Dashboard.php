<div class="cell auto-size padding10 bg-white" id="cell-content">
    <h1 class="text-light">Dashboard<span class="mif-apps place-right"></span></h1>
    <hr class="thin bg-grayLighter">
    <div class="cell auto-size padding20 bg-white" id="cell-content">  
        <div class="flex-grid">
            <div class="row">
                <div class="cell colspan1"></div>
                <div class="cell colspan10 box">
                    <h5>Simple color test <span id="sct-1">0%</span></h5>
                    <div class="progress"
    data-value="97"
    data-color="bg-red"
    data-role="progress"></div>
                </div>
                <div class="cell colspan1"></div>
            </div>
            <div class="row">&nbsp;</div>
            <div class="row">
                <div class="cell colspan1"></div>
                <div class="cell colspan3">
                    <div class="panel">
                        <div class="heading bg-pink">
                            <span class="icon mif-books"></span>
                            <span class="title text-shadow">Catalog</span>
                        </div>
                        <div class="ribbed-grayLight content">
                            <center>
                                    <br>
                                    <h2 class="text-shadow">
                                     <span class="tag bg-lightRed fg-white box"><span class="fg-lightGreen"><?=$catalog?></span> Total Books</span>
                                </h2>
                                <small><a href="<?= base_url(); ?>ElibrarySystem/catalog" class="text-shadow mif-search fg-white" style="text-decoration: none;"> Access</a></small>
                                <br>
                                <br>
                                <br>
                            </center>
                        </div>
                    </div> 
                </div>
                <div class="cell colspan1"></div>
                <div class="cell colspan3">
                    <div class="panel success">
                        <div class="heading bg-pink">
                            <span class="icon mif-clipboard"></span>
                            <span class="title text-shadow">Transactions</span>
                        </div>
                        <div class="content">
                            <center><br>
                                <h2 class="text-shadow"> <span class="tag bg-lightRed fg-white box"><span class="fg-lightGreen"><?=$newrequest?></span> E-book <span class="fg-lightGreen"> Today!</span></span>
                                    <br>
                                     <span class="tag bg-lightRed fg-white box"><span class="fg-lightGreen"><?=$newphys?></span> Physical Book<span class="fg-lightGreen"> Today!</span></span>
                                    <br>
                                     <span class="tag bg-lightRed fg-white box"><span class="fg-lightGreen"><?=$approve?></span> Approved <span class="mif-user-check"></span></span>
                                     <br>
                                     <span class="tag bg-lightRed fg-white box"><span class="fg-lightGreen"><?=$denied?></span> Onloan <span class="mif-user-minus"></span></span>
                                </h2>
                                <small><a href="<?= base_url(); ?>ElibrarySystem/transactions" class="text-shadow mif-search fg-white" style="text-decoration: none;"> Access</a></small>
                                <br>
                                <br>
                                <br>
                            </center>
                        </div>
                    </div> 
                </div>
                <div class="cell colspan1"></div>
                <div class="cell colspan3">
                    <div class="panel success">
                        <div class="heading bg-pink">
                            <span class="icon mif-bubbles"></span>
                            <span class="title text-shadow">Chat</span>
                        </div>
                        <div class="content">
                            <center><br>
                                <h2 class="text-shadow">
                                     
                                    
                                </h2>
                                <small><a href="<?= base_url(); ?>ElibrarySystem/chatpage" class="text-shadow mif-search fg-white" style="text-decoration: none;"> Access</a></small>
                                <br>
                                <br>
                                <br>
                            </center>
                        </div>
                    </div> 
                </div>
                
                 
            </div>
            <div class="row">
                <div class="cell colspan1"></div>
                <div class="cell colspan3">
                    <div class="panel success">
                        <div class="heading bg-pink">
                            <span class="icon mif-calendar"></span>
                            <span class="title text-shadow">Event Calendar</span>
                        </div>
                        <div class="content">
                            <center><br>
                                <br>
                                <h2 class="text-shadow"> 
                                     <span class="tag bg-lightRed fg-white box"><span class="fg-lightGreen"><?=$ann?></span> Announcements </span>
                                     <span class="tag bg-lightRed fg-white box"><span class="fg-lightGreen"><?=$newsc?></span> News</span>
                                </h2>
                                <small><a href="<?= base_url(); ?>ElibrarySystem/events" class="text-shadow mif-search fg-white" style="text-decoration: none;"> Access</a></small>
                                <br>
                                <br>
                                <br>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="cell colspan1"></div>
                <div class="cell colspan3">
                    <div class="panel success">
                        <div class="heading bg-pink">
                            <span class="icon mif-profile"></span>
                            <span class="title text-shadow">User Profile</span>
                        </div>
                        <div class="content">
                            <center><br>
                                <br>
                                <h2 class="text-shadow">  <span class="tag bg-lightRed fg-white box"><span class="fg-lightGreen"><?=$students?></span> Students<span class="mif-user"></span></span>
                                    <br>
                                     <span class="tag bg-lightRed fg-white box"><span class="fg-lightGreen"><?=$educators?></span> Educator<span class="mif-users"></span></span>
                                </h2>
                                <small><a href="<?= base_url(); ?>ElibrarySystem/accounts" class="text-shadow mif-search fg-white" style="text-decoration: none;"> Access</a></small>
                                <br>
                                <br>
                                <br>
                            </center>
                        </div>
                    </div>
                </div>  
                <div class="cell colspan1"></div>
                <div class="cell colspan3">
                    <div class="panel success">
                        <div class="heading bg-pink">
                            <span class="icon mif-cog"></span>
                            <span class="title text-shadow">Page Configuration</span>
                        </div>
                        <div class="content">
                            <center><br>
                                <br>
                                <h2 class="text-shadow"> 
                                
                                </h2>
                                <small><a href="<?= base_url(); ?>ElibrarySystem/page_configurations" class="text-shadow mif-search fg-white" style="text-decoration: none;"> Access</a></small>
                                <br>
                                <br>
                                <br>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    
</div>
</body>
