<style>

.bottom .date {
  color: #589C1B;
  float: left;
  font-size: 11px;
  height: 13px;
  margin-left: 9px;
  position: relative;
  top: 1px;
}
.nick {
  float: left;
  font-size: 11px;
  margin-left: 13px;
}
.bottom {
  clear: both;
  font-family: Tahoma;
  height: 33px;
  margin-top: 1px;
}
.left {
  float: left;
  width:315px;
  margin-top:11px;
}
.right {
  float: right;
  text-align: right;
  width: 145px;
}
.fi-block div {
  float: left;
}
.bottom .cfri .minus {
  background: none repeat scroll 0 0 #B86161;
  cursor: help;
  float: left;
  margin-right: 1px;
  padding: 1px 4px;
}

.bottom .cfri {
  color: #FFFFFF;
  font-size: 11px;
}
.cfri {
  color: #FFFFFF;
  float: left;
  font-size: 11px;
  margin-left: 9px;
}

.bottom .cfri .plus {
  background: none repeat scroll 0 0 #5F89B1;
  cursor: help;
  float: left;
  margin-right: 1px;
  padding: 1px 4px;
}
.gs_toolbar {
  background: url("../images/gs_toolbar.jpg") repeat scroll 0 0 #F5F6F6;
  border: 1px solid #2F73B2;
  border-radius: 5px;
  color: #000000;
  height: 44px;
  margin-bottom: 0;
}

.title-bar{
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  font-size: 13px;
  height: 28px;
  line-height: 32px;
  text-align: left;
  padding:0px 5px;
}
div.selector {
  -moz-box-sizing: content-box;
  background: -moz-linear-gradient(center top , #FCFCFC 0%, #F4F4F4 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
  border: 1px solid #D5D5D5;
  border-radius: 2px;
  box-shadow: 0 1px 0 #FFFFFF inset, 0 1px 0 #EEEEEE;
  cursor: pointer;
  display: inline-block;
  font-size: 12px;
  height: 28px;
  line-height: 28px;
  margin: 0;
  max-width: 280px;
  overflow: hidden;
  padding: 0 0 0 8px;
  position: relative;
  vertical-align: middle;
  width: auto;
}
.btn {
  background: -moz-linear-gradient(center top , #FFFFFF 0%, #F5F5F5 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
  border: 1px solid #D5D5D5;
  border-radius: 2px;
  box-shadow: 0 1px 1px rgba(255, 255, 255, 0.2) inset;
  color: #686868;
  display: inline-block;
  font-size: 11px;
  font-weight: bold;
  line-height: 13px;
  margin: 2px 0;
  padding: 8px 13px 7px;
}

.selector{
	/*width:70px !important;*/
	padding:3px 13px !important;
}
</style>
<script>
$(document).ready(function(){
	$('.rank').click(function(){
		//alert($(this).attr('user_id')+' '+$(this).attr('prediction_id'));
		var user_id = $(this).attr('user_id');
		var prediction_id = $(this).attr('prediction_id');
		$.ajax({
		   type: "POST",
		   url: "user/get_rank",
		   data: "prediction_id="+prediction_id+'&user_id='+user_id,
		   beforeSend: function () {
			$("#events").html("Loading ...");
		   },
		   success: function(msg){
			 //alert(msg);
			 $('#showrank'+prediction_id).html(msg);
		   }
		});
		return false;
	});
});
</script>
<div id="main_content">  
    <!-- end of menu tab -->
    <div class="crumb_navigation"><?php echo $this->lang->line('navigation');?> : <span class="current"><?php echo $this->lang->line('home');?></span> </div>
    <div class="left_content" style="margin-top:15px">


    <div class="sidebar">
        <!--<div class="search-bar">
            <p class="search-header">SEARCH SBR</p>
            <div class="search-item">
                <p>
                    <input type="text" buttonrel="btnSearch" placeholder="Search Sportsbook News" class="text-search" id="miniSearchText">
                    <input type="button" onclick="" value="" class="btn-search ir" id="btnSearch">
                </p>
		    </div>
        </div>-->
	    	    <?php include 'left_content.php';?>

    </div>
    
    
    
      
      
      
      <!--<div class="title_box">Special Products</div>
      <div class="border_box">
        <div class="product_title"><a href="">Makita 156 MX-VL</a></div>
        <div class="product_img"><a href=""><img src="images/p1.jpg" alt="" border="0" /></a></div>
        <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
      </div>-->
      
    </div>
    <!-- end of left content -->

    <div class="center_content">
	    <div class="section">
        <?php
if($this->session->flashdata('success')) {
    $msg = $this->session->flashdata('success');
?>
      <div class="note"><?php echo $msg;?>
      </div>
<?php
}
?>    
<?php
if($this->session->flashdata('error')) {
    $msg = $this->session->flashdata('error');
?>
      <div class="error"><?php echo $msg;?>
      </div>
<?php
}
?>        

        <div class="blockTop colCenter cf">
<?php
$top_predictions	= $this->comman_model->get_top_ranking1('prediction_rank','prediction_id','point','point','desc');
$top_check = false;
if(!empty($top_predictions)){
foreach($top_predictions as $set_data2){
	$top_prediction = $this->comman_model->get_data_by_id('prediction',array('id'=>$set_data2['prediction_id'],'status'=>1));
	$top_date 		= strtotime($top_prediction['dates']);
	$top_date1 		= explode(' ',$top_prediction['dates']);
	$current_data1 = time();
	if($top_check==true){
		break;
	}
	if($current_data1<$top_date){
		$top_check 		= true;
		$top_username1	= $this->comman_model->get_data_by_id('user',array('id'=>$top_prediction['user_id']));
		$top_subscribe	= $this->comman_model->get_data_by_id('prediction_price',array('user_id'=>$top_username1['id'],'plan'=>'tips'));
		$top_category	= $this->comman_model->get_data_by_id('category',array('id'=>$top_prediction['category_id']));
		$top_bookie		= $this->comman_model->get_data_by_id('bookies',array('id'=>$top_prediction['bookie']));
		$top_like		= $this->comman_model->get_all_data_by_id('user_rating',array('prediction_id'=>$top_prediction['id'],'rating_type'=>1));
		$top_dislike	= $this->comman_model->get_all_data_by_id('user_rating',array('prediction_id'=>$top_prediction['id'],'rating_type'=>0));
		$top_event		= $this->comman_model->get_data_by_id('event',array('id'=>$top_prediction['event_id']));
		$top_team1		= $this->comman_model->get_data_by_id('team',array('id'=>$top_prediction['team1']));
		$top_team2		= $this->comman_model->get_data_by_id('team',array('id'=>$top_prediction['team2']));
		$top_profits	= $this->comman_model->get_sum_by_id('prediction',array('user_id'=>$top_prediction['user_id']),'result_percentage');
		$top_count 		= $this->comman_model->get_all_data_by_id('prediction_rank',array('prediction_id'=>$top_prediction['id']));
?>            
<h1 class="headline" style="margin:7px 0px 0px"><?php echo $this->lang->line('top_prediction');?></h1>
<div class="wrap-shadow" style="margin:10px 0px 0px;border-top-left-radius:5px;border-top-right-radius:5px;">
                	<div class="title-bar">
						<div style="float:left;font-weight:bold" >
<?php
echo $top_team1['name'].' - '.$top_team2['name'].' '.$top_category['name'].' forecast from '.$top_username1['username'].' | '.$top_date1[0];
if($set_data1['type']=='free'){
//	echo ' <span style="margin-top:15px;color:#0C0;font-size:13px">(Free)</span>';
}
else{
	//echo ' <span style="margin-top:15px;color:#C30;font-size:13px">(Pay)</span>';
}
?>
                        </div>
                        <div style="float:right">
<?php
if($set_data1['type']=='free'){
	echo ' <span style="">'.$this->lang->line('free_prediction').'</span>';
}
else{
	echo ' <span style="">'.$this->lang->line('paid_prediction').'</span>';
}
?>
	                    </div>
                    </div>
                    <div style="clear:both"></div>
                	<h2 class="title" style="margin-left:5px;float:left;line-height:0px;font-size:13px;font-weight:100"><?php echo $top_event['name'];?></h2>

					<div style="float:right">
						<a href="<?php echo $top_bookie['link'];?>" target="_blank">
<?php
	$image = 'assets/uploads/bookies/small/'.$top_bookie['image'];
	echo '<img title="bet" alt="'.$top_bookie['name'].'" style="cursor: pointer;" src="'.$image.'" height="30" width="80">';
?>                                
						 </a>
				    </div>
					<div style="clear:both"></div>

					<div class="fi-block" style="padding:5px">
      <div class="fi-img">
<?php
if(isset($top_team1['image'])&&$top_team1['image']!=''){
	$image = 'assets/uploads/team/thumbnails/'.$top_team1['image'];
	echo '<img src="'.$image.'" style="float:left" height="30" width="30" >&nbsp;&nbsp;';
}
?>                                
    </div>
      <div style="font-size:16px;font-weight:bold">
        <strong><?php echo '  '.$top_team1['name'].' - '.$top_team2['name'].' '?></strong>
      </div>
      <div class="fi-img rig">
<?php
if(isset($top_team2['image'])&&$top_team2['image']!=''){
	$image1 = 'assets/uploads/team/thumbnails/'.$top_team2['image'];
	echo '&nbsp;&nbsp;<img src="'.$image1.'" height="30" width="30">';
}
?>                                
      
</div>
      
    </div>
				    <div style="clear:both"></div>
					
                    <div style="padding:5px">
<?php 
if($set_data1['type']=="free"){
	echo $set_data1['description'];
}
?>
</div>
					
                    <div class="bottom" style="padding:5px">
		<div class="left">
			<div class="rating">                               
                <span class="up"></span>
                <span class="degit"><?php echo count($top_like);?></span>
                <span class="down"></span>                              
                <span class="degit"><?php echo count($top_dislike);?></span>
            </div>       
            <div class="nick" st><div class="nick_icon">&nbsp;</div>
            	<span><a href="front/user_profile/<?php echo $top_username1['id'];?>"><?php echo $top_username1['username'];?></a></span></div>
			<div class="cfri">
<?php
if($top_profits['result_percentage']>=0){
?>            
                <div class="plus"><?php echo number_format($top_profits['result_percentage'],2).'%';?></div>
<?php
}
else{
?>                <div class="minus"><?php echo number_format($top_profits['result_percentage'],2).'%';?></div>
<?php
}
?>                
            </div>
            <time class="date"><span class="clock_icon">&nbsp;</span> <?php echo $top_date1[1];?></time>

<?php
	echo '<div class="star"></div>';
?>            
            <div style="float:left;margin-left:5px;color:#003399;font-weight:bold"><?php echo count($top_count);?></div>
			
            

			
            			
        </div>
        <div class="right">            
			<?php
$current_data = time();
if($current_data<$top_date){
	if(isset($login['logged_in'])&&$login['logged_in']=='user'){	
		if($set_data1['type']=='paid'&&$top_username1['username']!=$login['name']){
			$check	= $this->comman_model->get_data_by_id('subscribe_prediction',array('pred_id'=>$set_data1['id'],'user_id'=>$login['id']));	
			if(empty($check)){
			?>                                                    
					<a class="btn btn-minier btn-info"  href="user/subscribe_tips/<?php echo $set_data1['id'];?>"><?php echo $this->lang->line('buy');?>
                    <?php echo !empty($top_subscribe)?'$'.$top_subscribe['amount']:'';?></a>
			<?php
			}
			else{
				?>
				<div class="btn btn-minier btn-info" style="color:#0C0"><?php echo $this->lang->line('subscribed');?></div>
				<a class="btn btn-minier btn-info" href="user/views_prediction/<?php echo $set_data1['id'];?>"><?php echo $this->lang->line('view');?></a>
				<?php
			}
		}
		else{
			?>
			<a class="btn btn-minier btn-info" href="user/views_prediction/<?php echo $set_data1['id'];?>"><?php echo $this->lang->line('view');?></a>
			<?php
		}
	}
	else if($set_data1['type']!="free"){
?>
	<a href="user/subscribe_tips/<?php echo $set_data1['id'] ?>" class="btn btn-minier btn-info"><?php echo $this->lang->line('buy');?>
	<?php echo !empty($top_subscribe)?'$'.$top_subscribe['amount']:'';?></a>
<?php
	}
	else if($set_data1['type']=="free"){
?>
	<a href="front/views_prediction/<?php echo $set_data1['id'] ?>" class="btn btn-minier btn-info"><?php echo $this->lang->line('view');?></a>
<?php
	}
}
else{
?>
        <div class="btn btn-minier btn-info" style="color:#900"><?php echo $this->lang->line('expired');?></div>
		<a href="front/views_prediction/<?php echo $set_data1['id'] ?>" class="btn btn-minier btn-info"><?php echo $this->lang->line('view');?></a>
<?php
}
?>
			
			
				
									
        </div>        
    </div>
				    <div style="clear:both"></div>
                </div>
<?php
	}
	}
}
?>                	





















<h1 class="headline" style="margin:7px 0px 0px"><?php echo $this->lang->line('prediction');?></h1>

				
<?php
if(isset($all_predictions)&&!empty($all_predictions)){
	foreach($all_predictions as $set_data1){
		$username1	= $this->comman_model->get_data_by_id('user',array('id'=>$set_data1['user_id']));
		$subscribe	= $this->comman_model->get_data_by_id('prediction_price',array('user_id'=>$username1['id'],'plan'=>'tips'));
		$category	= $this->comman_model->get_data_by_id('category',array('id'=>$set_data1['category_id']));
		$bookie		= $this->comman_model->get_data_by_id('bookies',array('id'=>$set_data1['bookie']));
		$like		= $this->comman_model->get_all_data_by_id('user_rating',array('prediction_id'=>$set_data1['id'],'rating_type'=>1));
		$dislike	= $this->comman_model->get_all_data_by_id('user_rating',array('prediction_id'=>$set_data1['id'],'rating_type'=>0));
		$event		= $this->comman_model->get_data_by_id('event',array('id'=>$set_data1['event_id']));
		$team1		= $this->comman_model->get_data_by_id('team',array('id'=>$set_data1['team1']));
		$team2		= $this->comman_model->get_data_by_id('team',array('id'=>$set_data1['team2']));
		$profits	= $this->comman_model->get_sum_by_id('prediction',array('user_id'=>$set_data1['user_id']),'result_percentage');
		$count 		= $this->comman_model->get_all_data_by_id('prediction_rank',array('prediction_id'=>$set_data1['id']));
		$date 		= strtotime($set_data1['dates']);
		$date1 		= explode(' ',$set_data1['dates']);
?>
            	<div class="wrap-shadow" style="margin:10px 0px 0px;border-top-left-radius:5px;border-top-right-radius:5px;">
                	<div class="title-bar">
						<div style="float:left;font-weight:bold" >
<?php
echo $team1['name'].' - '.$team2['name'].' '.$category['name'].' forecast from '.$username1['username'].' | '.$date1[0];
if($set_data1['type']=='free'){
//	echo ' <span style="margin-top:15px;color:#0C0;font-size:13px">(Free)</span>';
}
else{
	//echo ' <span style="margin-top:15px;color:#C30;font-size:13px">(Pay)</span>';
}
?>
                        </div>
                        <div style="float:right">
<?php
if($set_data1['type']=='free'){
	echo ' <span style="">('.$this->lang->line('free_prediction').')</span>';
}
else{
	echo ' <span style="">('.$this->lang->line('paid_prediction').')</span>';
}
?>
	                    </div>
                    </div>
                    <div style="clear:both"></div>
                	<h2 class="title" style="margin-left:5px;float:left;line-height:0px;font-size:13px;font-weight:100"><?php echo $event['name'];?></h2>

					<div style="float:right">
						<a href="<?php echo $bookie['link'];?>" target="_blank">
<?php
	$image = 'assets/uploads/bookies/small/'.$bookie['image'];
	echo '<img title="bet" alt="'.$bookie['name'].'" style="cursor: pointer;" src="'.$image.'" height="30" width="80">';
?>                                
						 </a>
				    </div>
					<div style="clear:both"></div>

					<div class="fi-block" style="padding:5px">
      <div class="fi-img">
<?php
if(isset($team1['image'])&&$team1['image']!=''){
	$image = 'assets/uploads/team/thumbnails/'.$team1['image'];
	echo '<img src="'.$image.'" style="float:left" height="30" width="30" >&nbsp;&nbsp;';
}
?>                                
    </div>
      <div style="font-size:16px;font-weight:bold">
        <strong><?php echo '  '.$team1['name'].' - '.$team2['name'].' '?></strong>
      </div>
      <div class="fi-img rig">
<?php
if(isset($team2['image'])&&$team2['image']!=''){
	$image1 = 'assets/uploads/team/thumbnails/'.$team2['image'];
	echo '&nbsp;&nbsp;<img src="'.$image1.'" height="30" width="30">';
}
?>                                
      
</div>
      
    </div>
				    <div style="clear:both"></div>
					
                    <div style="padding:5px">
<?php 
if($set_data1['type']=="free"){
	echo $set_data1['description'];
}
?>
</div>
					
                    <div class="bottom" style="padding:5px">
		<div class="left">
			<div class="rating">                               
                <span class="up"></span>
                <span class="degit"><?php echo count($like);?></span>
                <span class="down"></span>                              
                <span class="degit"><?php echo count($dislike);?></span>
            </div>       
            <div class="nick" st><div class="nick_icon">&nbsp;</div>
            	<span><a href="front/user_profile/<?php echo $username1['id'];?>"><?php echo $username1['username'];?></a></span></div>
			<div class="cfri">
<?php
if($profits['result_percentage']>=0){
?>            
                <div class="plus"><?php echo number_format($profits['result_percentage'],2).'%';?></div>
<?php
}
else{
?>                <div class="minus"><?php echo number_format($profits['result_percentage'],2).'%';?></div>
<?php
}
?>                
            </div>
            <time class="date"><span class="clock_icon">&nbsp;</span> <?php echo $date1[1];?></time>

<?php
if(isset($login['logged_in'])&&$login['logged_in']=='user'){
	if($login['user_service']=='sell_tips'){
?>          
            <a href="" prediction_id="<?php echo $set_data1['id']?>" user_id="<?php echo $login['id'];?>" class="rank"> <div class="star"></div></a>
<?php
	}
	else{
		echo '<div class="star"></div>';
	}
}
else{
	echo '<div class="star"></div>';
}
?>            
            <div id="<?php echo 'showrank'.$set_data1['id']?>" style="float:left;margin-left:5px;color:#003399;font-weight:bold"><?php echo count($count);?></div>
			
            
			
            			
        </div>
        <div class="right">            
			<?php
$current_data = time();
if($current_data<$date){
	if(isset($login['logged_in'])&&$login['logged_in']=='user'){	
		if($set_data1['type']=='paid'&&$username1['username']!=$login['name']){
			$check	= $this->comman_model->get_data_by_id('subscribe_prediction',array('pred_id'=>$set_data1['id'],'user_id'=>$login['id']));	
			if(empty($check)){
			?>                                                    
					<a class="btn btn-minier btn-info"  href="user/subscribe_tips/<?php echo $set_data1['id'];?>"><?php echo $this->lang->line('buy');?>
                    <?php echo !empty($subscribe)?'$'.$subscribe['amount']:'';?></a>
			<?php
			}
			else{
				?>
				<div class="btn btn-minier btn-info" style="color:#0C0"><?php echo $this->lang->line('subscribed');?></div>
				<a class="btn btn-minier btn-info" href="user/views_prediction/<?php echo $set_data1['id'];?>"><?php echo $this->lang->line('view');?></a>
				<?php
			}
		}
		else{
			?>
			<a class="btn btn-minier btn-info" href="user/views_prediction/<?php echo $set_data1['id'];?>"><?php echo $this->lang->line('view');?></a>
			<?php
		}
	}
	else if($set_data1['type']!="free"){
?>
	<a href="user/subscribe_tips/<?php echo $set_data1['id'] ?>" class="btn btn-minier btn-info"><?php echo $this->lang->line('buy').' '.!empty($subscribe)?$subscribe['amount']:'';?></a>
<?php
	}
	else if($set_data1['type']=="free"){
?>
	<a href="front/views_prediction/<?php echo $set_data1['id'] ?>" class="btn btn-minier btn-info"><?php echo $this->lang->line('view');?></a>
<?php
	}
}
else{
?>
        <div class="btn btn-minier btn-info" style="color:#900"><?php echo $this->lang->line('expired');?></div>
		<a href="front/views_prediction/<?php echo $set_data1['id'] ?>" class="btn btn-minier btn-info"><?php echo $this->lang->line('view');?></a>
<?php
}
?>
			
			
				
									
        </div>        
    </div>
				    <div style="clear:both"></div>
                </div>
<?php			
	}
}
?>                
            
            <p style="float:right"><?php echo $links; ?></p>

        </div>
    </div>
        
        
    
      <!--<div class="oferta"> <img src="images/p1.png" width="165" height="113" border="0" class="oferta_img" alt="" />
        <div class="oferta_details">
          <div class="oferta_title">Title</div>
          <div class="oferta_text"> content </div>
          <a href="" class="prod_buy">details</a> </div>
      </div>-->
    </div>
    <!-- end of center content -->
    <div class="right_content" style="margin-top:15px">
      
      <?php include 'right_content.php';?>
    </div>
    <!-- end of right content -->
  </div>