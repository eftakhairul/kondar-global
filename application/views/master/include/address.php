<div class="container">
            <div class="row bread">
                    <div class="col-md-6">
                        <div class="text-bread">
<?php
if(isset($active)){
    if($active=='career'){
?>
                <a href="<?=base_url()?>front/home">Home</a> / Career
<?php       
    }
    else if($active=='promotion'){
        if(isset($page_data)){
            
?>
                <a href="<?=base_url()?>front/home">Home</a> / <a href="<?=base_url()?>promotion">Promotion</a> / <?php echo $page_data['name'];?>
<?php           
        }
        else{
?>
                <a href="front/home">Home</a> / Promotion
                
<?php       
        }
    }
    else if($active=='vehicle'){
        
    }
    else if($active=='model'){
       
    }
    else if($active=='promotion_form'){         
        if(isset($apply_form)){
?>
                <a href="<?=base_url()?>front/home">Home</a> / <a href="<?=base_url()?>promotion">Promotion</a> / <?php echo $apply_form['name'];?>
<?php           
        }
    }
    else if($active=='category'){
        if(isset($category)){
?>
                <a href="<?=base_url()?>front/home">Home</a> / <a href="<?=base_url()?>promotion">Promotion</a> / <?php echo $category['name'];?>
<?php           
        }
        else{
?>
                <a href="<?=base_url()?>front/home">Home</a> / Promotion
                
<?php       
        }
    }
    else if($active=='about'){
?>
                <a href="<?=base_url()?>front/home">Home</a> / About
<?php       
    }
    else if($active=='mission'){
?>
                <a href="<?=base_url()?>front/home">Home</a> / Mission
<?php       
    }
    else if($active=='vision'){
?>
                <a href="<?=base_url()?>front/home">Home</a> / Vision
<?php       
    }
    else if($active=='contact'){
?>
                <a href="<?=base_url()?>front/home">Home</a> / contact us
<?php       
    }
}
?>
                        </div>
                    </div>
                   
                </div>
        </div>