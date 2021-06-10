<div class="cell auto-size padding10 bg-white" id="cell-content">
    <div class="cell auto-size padding20 bg-white" id="cell-content">
        
    <h1 class="text-light"><a onclick="goBack();">&lt;</a>Books<span class="mif-books place-right"></span></h1><hr class="thin bg-grayLighter"></br>

        <div class="flex-grid">
            <?php 
            foreach ($book as $value) {
                $val = array(
                    'cover' => $value->book_cover,
                    'callno' => $value->callno,
                    'accession' => $value->accession,
                    'isbn' => $value->isbn,
                    'location' => $value->location,
                    'title' => $value->title,
                    'copyright' => $value->copyright,
                    'author' => $value->author,
                    'series' => $value->series,
                    'volume' => $value->volume,
                    'copies' => $value->copies,
                    'subject' => $value->subject,
                    'description' => $value->description,
                    'status' => $value->Status,
                    'publisher' => $value->publisher,
                    'type' => $value->type,
                    'classification' => $value->classification,
                    'access' => $value->access);

                if($value->book_cover == null){
                        $img = 'images/no_image.png';
                    }else{
                        $img = $value->book_cover;
                    }
                 if($val['copies'] == 0){
                $copies = '<span class="tag bg-lightRed fg-white">Unavailable</span>';
                $status = 'disabled';
            }else{
                $copies = '<span class="tag bg-lightGreen fg-white">Available</span>';
                $status = '';
            }
             if(empty($val)){
                echo '-----------------------------------------------------------';
             }else{
                if($val['type'] == 'Phys.B'){
                $button = '<form action="'.base_url().'ElibrarySystem/Reserve?access='.$val['access'].'" method="post"><button class="button bg-lime" '.$status.'>Reserve</button></form>';
            }else{
                $button = '<form action="'.base_url().'ElibrarySystem/Request?access='.$val['access'].'" method="post"><button class="button bg-lightRed" '.$status.'>Request</button></form>';
            }   
                        if($val['classification'] == 0){
                        $class = 'Book';
                    }elseif($val['classification'] == 1){
                        $class = 'AV Material';
                    }elseif($val['classification'] == 2){
                        $class = 'Equipment';
                    }
                    
                echo '<div class="row box cells3 padding10">
                <div class="cell colspan3 box padding10 bg-lightBlue">
                    <img alt="Book Cover" src="'.base_url().''.$img.'" style="height: 500px; width: 400px;">
                </div><div class="flex-grid box bg-white">

            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>Call No.:</h6>'.$val['callno'].'
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Title:</h6>'.$val['title'].'
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Location:</h6>'.$val['location'].'
                </div>
            </div>
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>ISBN:</h6>'.$val['isbn'].'
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Author:</h6>'.$val['author'].'
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Copyright:</h6>'.$val['copyright'].'
                </div>

            </div>
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>Publisher:</h6>'.$val['publisher'].'
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Series:</h6>'.$val['series'].'
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Volume:</h6>'.$val['volume'].'
                </div>
            </div>
            <div class="row cells4">
                <div class="cell padding10 colspan3">
                    <h6>Subject:</h6>'.$val['subject'].'
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Available Copies:</h6>'.$val['copies'].'
                </div>
                <div class="cell padding10 colspan3">
                    <h6>Status:</h6>'.$copies.'
                </div>
            </div>
            <div class="row cells4">
                    <div class="cell padding10 colspan3">
                    <h6>Description:</h6>'.$val['description'].'
                </div>
                <div class="cell padding10 colspan3">
                    <h6>General Material Designation:</h6>'.$class.'
                </div>
                </div>
            </div>
            <div class="grid">
            <div class="row">
            <div class="cell padding10">'.$button.'</div>
            </div>
            <div class="row">
            <div class="cell padding10">
                    
                </div>
                </div> 
            </div>  
            </div></br>';
             }
        }
            ?>
        </div> 
    </div>
</div>
</div>
</div>
</div>
</div>
</body>
