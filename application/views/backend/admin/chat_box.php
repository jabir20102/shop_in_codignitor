
<div class="">
			<div class="row justify-content-center h-100">

				<!-- chat box -->
				 <div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="<?php echo $img_src; ?>" class="rounded-circle user_img">
									
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Chat with <?php echo $user_name ?></span>
									<p>1767 Messages</p>
								</div>
								<!-- <div class="video_cam">
						 			<span><i class="fas fa-video"></i></span>
									<span><i class="fas fa-phone"></i></span>
								</div> -->
							</div>
							<span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
							<div class="action_menu">
								<ul>
									<li><i class="fas fa-user-circle"></i> View profile</li>
									<li><i onclick="clear_chat();" class="fas fa-ban"></i> Clear Chat
									</li>
									<!-- <li><i class="fas fa-users"></i> Add to close friends</li>
									<li><i class="fas fa-plus"></i> Add to group</li>
									<li><i class="fas fa-ban"></i> Block</li> -->
								</ul>
							</div>
						</div>
						<div id="chat_box" class="card-body msg_card_body">
							<div class="d-flex justify-content-start mb-4">
								loading messages.....
								<!-- <div class="img_cont_msg">
									<img src="https://devilsworkshop.org/files/2013/01/enlarged-facebook-profile-picture.jpg" class="rounded-circle user_img_msg">
								</div> -->
								<div class="msg_cotainer">
									Hi, how are you samim?
									<span class="msg_time">8:40 AM, Today</span>
								</div>
							</div>

							<div class="d-flex justify-content-end mb-4">
								<div class="msg_cotainer_send">
									Hi Maryam i am good tnx how about you? 
									<span class="msg_time_send">8:55 AM, Today</span>
								</div>
								<div class="img_cont_msg">
							<img src="" class="rounded-circle user_img_msg">
								</div>
							</div>
							
							
						</div>
						<div class="card-footer">
							<div class="input-group">
								<div class="input-group-append">
									<!-- <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span> -->
								</div>
								<input type="hidden" name="user_to" id="user_to" value="<?php echo $id ?>">
								<textarea id="chat_message" class="form-control type_msg" placeholder="Type your message..."></textarea>
								<div class="input-group-append">
									<span class="input-group-text send_btn"><i onclick="send_chat();" class="fas fa-location-arrow"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div> 

			</div>
		</div>


<script type="text/javascript">
    // $(document).ready(function () {
    // var user_to=
    
 setInterval(function(){
  // update_last_activity();
 //  fetch_user();
 // update_chat_history_data();
 // alert(<?php echo $id; ?>);
 fetch_user_chat_history(<?php echo $id; ?>);
 }, 3000);

function fetch_user_chat_history(to_user_id)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>User/fetch_user_chat_history",
   method:"POST",
   data:{to:to_user_id,from:'0'},
   success:function(data){
    $('#chat_box').html(data);
    $('.user_img').html('<img src="<?php echo $img_src; ?>" class="rounded-circle user_img" />');
    $('.my_img').html('<img src="<?php echo $admin_src; ?>" class="rounded-circle user_img" />');
   }
  });
 }

 	function send_chat(){
  var to_user_id = $('#user_to').val();
  var chat_message = $('#chat_message').val();
  var from_user_id='0';
  $.ajax({
   url:"<?php echo base_url(); ?>User/insert_chat",
   method:"POST",
   data:{to_user_id:to_user_id,from_user_id:from_user_id, chat_message:chat_message},
   success:function(data)
   {
   	// alert('khandd');
    // $('#chat_message').val('');
   }
  });
    $('#chat_message').val('');
}

function clear_chat(){
  var to_user_id = $('#user_to').val();
  var from_user_id='0';
  $.ajax({
   url:"<?php echo base_url(); ?>User/clear_chat",
   method:"POST",
   data:{to_user_id:to_user_id,from_user_id:from_user_id},
   success:function(data)
   {
   	// alert("Chat is deleted successfully...");
   }
  });
  $('#chat_box').html("Deleting chat messages.....");
}
function del_msg(id){
  // var to_user_id = $('#user_to').val();
  var from_user_id=0;
  $.ajax({
   url:"<?php echo base_url(); ?>User/del_msg",
   method:"POST",
   data:{chat_message_id:id,from_user_id:from_user_id},
   success:function(data)
   {
    // alert(data);
     // alert("Chat is deleted successfully...");
   }
  });
  $('#msg_'+id).html("Deleting  messages.....");
}

// });
</script>


