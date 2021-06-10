<div class="cell auto-size padding10 bg-white" id="cell-content">
    <h1 class="text-light"><a href="Catalog">&lt;</a>Book<span class="mif-apps place-right"></span></h1>
    <hr class="thin bg-grayLighter">
    <div class="cell auto-size padding20 bg-white" id="cell-content">  
        <?php echo validation_errors(); ?>
        <div class="flex-grid">
            <div class="row cells3">
                <div class="cell colspan3 box padding10">
                    <img alt="Book Cover" src="<?=base_url()?><?=$book_info['bookcover']?>" style="height: 500px; width: 400px;">
                </div>&emsp;&emsp;
                <div class="flex-grid">
                
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>Call No.:</h6><?=$book_info['callno']?>
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
                    <h6>Subject:</h6><?=$book_info['subject']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Available Copies:</h6><?=$book_info['copies']?>
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Status:</h6><?php if($book_info['copies'] == 0){
                echo '<span class="tag bg-lightRed fg-white">Unavailable</span>';
            }else{
                echo '<span class="tag bg-lightGreen fg-white">Available</span>';
            }?>
                </div>
            </div>
                            <div class="cell padding10 colspan3">
                    <h6>Description:</h6><?=$book_info['description']?>
                </div>
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
