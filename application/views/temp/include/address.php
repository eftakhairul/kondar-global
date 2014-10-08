<div class="container">
            <div class="row bread">
                    <div class="col-md-6">
                        <div class="text-bread">
<?php
if(isset($active)){
	if($active=='career'){
?>
				<a href="home">Home</a> / Career
<?php		
	}
	else if($active=='promotion'){
		if(isset($page_data)){
			
?>
				<a href="home">Home</a> / <a href="front/promotion">Promotion</a> / <?php echo $page_data['name'];?>
<?php			
		}
		else{
?>
				<a href="home">Home</a> / Promotion
                
<?php		
		}
	}
	else if($active=='promotion_form'){			
		if(isset($apply_form)){
?>
				<a href="home">Home</a> / <a href="front/promotion">Promotion</a> / <?php echo $apply_form['name'];?>
<?php			
		}
	}
	else if($active=='category'){
		if(isset($category)){
?>
				<a href="home">Home</a> / <a href="front/promotion">Promotion</a> / <?php echo $category['name'];?>
<?php			
		}
		else{
?>
				<a href="home">Home</a> / Promotion
                
<?php		
		}
	}
	else if($active=='about'){
?>
				<a href="home">Home</a> / About
<?php		
	}
	else if($active=='mission'){
?>
				<a href="home">Home</a> / Mission
<?php		
	}
	else if($active=='vision'){
?>
				<a href="home">Home</a> / Vision
<?php		
	}
	else if($active=='contact'){
?>
				<a href="home">Home</a> / contact us
<?php		
	}
}
?>
                        </div>
                    </div>
                   
                </div>
        </div>