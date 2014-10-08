<script src="assets/template/js/countdown.js" type="text/javascript"></script>

<script>

$(document).ready(function(){

	$('#block_bttn').click(function(){

		window.location.href = "front/career";

		return false;

	});

	$('#check_bttn').click(function(){

//		window.location.href = "front/career";

		return false;

	});

});



function doneHandler(result){

	var id = $("#question_id").val();

    $.ajax({

       type: "POST",

       url: "front/set_next_question",  

       data: "id="+id,

       beforeSend: function () {

//	      $(".show_class").html("Loading ...");

        },

       success: function(msg){

		//  alert(msg);

			if(msg=='success'){

				$('#modal_block').modal('show');	



				//alert('Sorry Time is over.You have been blocked for 120 minutes.');

				//window.location.href = "front/career";

			}

       }

   });	

	//alert('hello');

}

</script>
<script type="text/javascript">
    function blink(n) {
        var blinks = document.getElementsByTagName("blink");
        var visibility = n % 2 === 0 ? "visible" : "hidden";
        for (var i = 0; i < blinks.length; i++) {
            blinks[i].style.visibility = visibility;
        }
        setTimeout(function() {
            blink(n + 1);
        }, 500);
    }
    $(document).ready(function(){
        blink(1);
    });
</script>
	<div class="bodywrapper">

        <?php //include('include/menu1.php');?>

        <?php include('/../temp/include/header_child.php');?>

        <?php include('include/address.php');?>



        <div class="container">

	        <div class="main-page">	        	

	        	<div class="car-lists">

        			<div class="form-fill-cart dis-form">

	        			<div class="row">

	        				<div class="col-md-12">

	        					<div class="promotion-page">

	        						<!-- Nav tabs -->

									<ul class="nav nav-tabs">

									  <li class="active"><a href="#permanent_job" data-toggle="tab">Interview</a></li>

									</ul>



									<!-- Tab panes -->

									<div class="tab-content">

                                        <div class="tab-pane active" id="permanent_job">

	                                        <div class="download-material">

                                        <div class="row">

                                        <div class="col-md-12" style="float:left">



                                



<?php

if(isset($all_data)&&!empty($all_data)){

	$check = $this->session->userdata('question_detail');

	if(isset($check)&&!empty($check)){

		$check = $this->session->userdata('question_detail');

		array_push($check,array('question_id'=>$all_data[0]['id']));

		$this->session->set_userdata('question_detail',$check);

	}

	else{

		$ar = array('question_id'=>$all_data[0]['id']);

		$this->session->set_userdata('question_detail',array($ar));

	}



?>

<script>

  var size = <?php echo $all_data[0]['min_words'];?> ;

	function show(form){

		var view = form.answer.value.length;

        if (view < size) {

			

	        $('#text_msge').text('Please type '+size+' characters minimum. Thank you');

			$('#modal_text').modal('show');	



			//alert('Please type '+size+' minimum words.');

		   return false;

		}

	}

      function countChar(val) {

        var len = val.value.length;

        if (len >= size) {

          $('#charNum').text('');

        } else {

          $('#charNum').text(size - len+' characters remaining');

        }

      };

    </script>

                                            <div class="media">

                                                <div class="media-body hidden-xs">

                                                    <h4 class="media-heading"></h4>

                                                    <form action="" method="post" onsubmit="return show(this)">

                                                    	<input type="hidden" name="operation"  value="set"/>

                                                    	<input type="hidden" name="question_id" id="question_id"  value="<?php echo $all_data[0]['id'];?>"/>

                                                        <table border="0">

                                                        	<tr height="40">

                                                            	<td width="90"><span style="font-weight:bold">Question <?php echo $question_number;?> :</span></td>

                                                            	<td><?php echo $all_data[0]['name'];?></td>

                                                                <td><div style="float:right">

<div style="float:right;">

<script type="application/javascript">

var myCountdown2 = new Countdown({

						time: <?php echo 60*$all_data[0]['duration'];?>, 

						width:100, 

						height:40, 

						rangeHi:"minute",	// <- no comma on last item!

						style:"flip",

						onComplete : doneHandler// <- no comma on last item!

						});

</script>

</div>

<div style="float:right">Timer</div>

<div style="clear:both"></div>

</div></td>

                                                            </tr>

                                                        	<tr>

                                                            	<td><label style="margin-bottom:111px;font-weight:bold">Answer:</label></td>

                                                            	<td colspan="2"><textarea name="answer" style="height:130px" cols="157" onkeyup="countChar(this)"></textarea>

																</td>

                                                            </tr>

                                                        	<tr>

                                                            	<td>&nbsp;</td>

                                                            	<td><div id="charNum"><?php echo $all_data[0]['min_words']?> characters remaining</div>

																</td>

                                                            </tr>

                                                        	<tr>

                                                            	<td>&nbsp;</td>

                                                            	<td><input type="submit" class="btn btn-primary btn-sm" value="Next" /></td>

                                                            </tr>

                                                        </table>                                                    	

                                                        

                                                    </form> 

                                                    <span style="color:#F00"><b>Note: </b>Please dont refresh the page.</span>                                                   

                                                 </div>

                                            </div>

                                        <div style="clear:both"></div>

                                        

                                

<?php	

}

?>									  	

										</div>

                                        </div>

                                        </div>	

                                        </div><!--End download-material-->

                                        

                                        

                                        <!--End knowledge center-->

                                        

									</div>



	        					</div>

	        				</div>

	        				

	        			</div>

        			</div>



	        	</div>



	        </div><!--End content-->

    	</div>



<div class="modal fade" id="modal_block">

				  <div class="modal-dialog">

				    <div class="modal-content">

				      <!-- <div class="modal-header">

				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

				        <h4 class="modal-title">Modal title</h4>

				      </div> -->

				      <div class="modal-body">

				      		<div class="box-content-modal">

				      			<h2 class="title-modal">Time Over</h2>

				      			<p>Sorry Time is over.You have been blocked for 120 minutes.</p>

				      			<div class="clearfix"></div>

				      			<div class="btn-modal">

				      				

			        				<a style="float:right" href="javascript:void(0)" id="block_bttn" onClick="$('#modal_block').modal('hide')" class="btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a>	

				      			</div>

				      		</div>

				      </div>

				      <!-- <div class="modal-footer">

				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				        <button type="button" class="btn btn-primary">Save changes</button>

				      </div> -->

				    </div><!-- /.modal-content -->

				  </div><!-- /.modal-dialog -->

				</div>

                

<div class="modal fade" id="modal_text">

				  <div class="modal-dialog">

				    <div class="modal-content">

				      <!-- <div class="modal-header">

				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

				        <h4 class="modal-title">Modal title</h4>

				      </div> -->

				      <div class="modal-body">

				      		<div class="box-content-modal">

				      			<h2 class="title-modal"><blink>Warning</blink></h2>

				      			<p id="text_msge"></p>

				      			<div class="clearfix"></div>

				      			<div class="btn-modal">

				      				

			        				<a style="float:right" href="javascript:void(0)" id="check_bttn" onClick="$('#modal_text').modal('hide')" class="btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a>	

				      			</div>

				      		</div>

				      </div>

				      <!-- <div class="modal-footer">

				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				        <button type="button" class="btn btn-primary">Save changes</button>

				      </div> -->

				    </div><!-- /.modal-content -->

				  </div><!-- /.modal-dialog -->

				</div>                