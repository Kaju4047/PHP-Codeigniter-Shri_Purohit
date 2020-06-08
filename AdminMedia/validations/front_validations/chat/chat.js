$(document).ready(function() {
/*Start::By default set chat data*/
	base_url = $('input[name="base_url"]').val();

	penddingRequest = false;

	fromImg = '';
	lgnImg = $('.loginLi img').attr('src'); //login img set
	lastID = 0;
	first_id = 0;
	loaded_all_chat = false;

	$('#msg_list').scroll(function(event) {

		if (!loaded_all_chat) {

			var user_id = $('#to_id_set').val();
			let div = $(this).get(0);

			if(div.scrollTop == 0 && !penddingRequest) {

				penddingRequest = true;

				$.ajax({
					url: base_url+'get-chat',
					type: 'POST',
					data: {user_id: user_id,first_id:first_id,last_id: lastID},
					dataType: 'json',
					success: function(data) {

						var firstMsg = $('#msg_list .chat-container:first');
					    var curOffset = firstMsg.offset().top - $('#msg_list').scrollTop();

						penddingRequest = false;

						var chat = get_chat_list(data);
						$('#msg_list').prepend(chat);

						if (data.first_id == 0) {
							loaded_all_chat = true;
						} else {
							first_id = data.first_id;
						}
						$('#msg_list').scrollTop(firstMsg.offset().top-curOffset);
					}
				});
			}
		}
	});
/*End::By default set chat data*/
/*Start::By default set chat*/
	function chats() {

		var user_id = $('#to_id_set').val();
		var order_id=$('#order_id_set').val();

		penddingRequest = true;

		$.ajax({
			url: base_url+'get-chat',
			type: 'POST',
			data: {user_id: user_id,first_id:first_id,last_id: lastID,order_id:order_id},
			dataType: 'json',
			success: function(data) {

				penddingRequest = false;

				var chatList = get_chat_list(data);

				if(lastID == 0) {
					$('#msg_list').html(chatList);
					$("#msg_list").animate({ scrollTop: $("#msg_list")[0].scrollHeight }, 0);
				} else {
					$('#msg_list').prepend(chatList);
				}

				if (data.last_id != 0) {
					lastID = data.last_id;
				}
				if (data.first_id != 0) {
					first_id = data.first_id;
				}
			 }
		});
	}
/*End::By default set chat*/
/*Start::Step2 design html of chat like from & to message and (call this fuction when send message and recevied new message) and return chat*/
	function get_chat_list(data){


		var chat = '';

		var rec_name = $('.purohit_name_cls').text();

		$.each(data.chat, function(index, val) {

// alert(val.created_date);
		var created_date = moment(val.created_date, "YYYY-MM-DD").format("DD MMM, Y");
		var formattedTime = new Date(val.created_date).getFormattedTime();



			if (val.from == data.t_user) {
				chat += 
				`<div class="chat-container">
					<div class="chat-respond msg">
						<div class="flippd">
	                		<strong>`+data.usr_name+`</strong>
	                		<div class="chatmsg">`+val.message+`
	                		</div>
	                		<div class="text-right mt-1"><small>`+created_date+" "+formattedTime+`</small></div>
	              		</div>
	            	</div>
	            	<div class="chat-respond img-respo"><img src="`+lgnImg+`"></div>
	            </div>`;
	        } else {

		        chat += `
		        	  <div class="chat-container">
                        <div class="chat-sender img-chat"><img src="`+fromImg+`"></div>
                        <div class="chat-sender msg"><strong>`+rec_name+`</strong>
                          <div class="chatmsg">`
		            		+val.message+`</div>
                          <div class="text-right mt-1"><small>`+created_date+" "+formattedTime+`</small></div>
                        </div>
                      </div>
		            `;
	        }
		});

		return chat;
	}



/*End::Step2 design html of chat like from & to message and (call this fuction when send message and recevied new message) and return chat*/
/*Start::Step3 new chat message get*/
	function new_messages(){

		var user_id = $('#to_id_set').val();
		var order_id=$('#order_id_set').val();
		if (!penddingRequest) {

			penddingRequest = true;

			$.ajax({
				url: base_url+'new-messages',
				type: 'POST',
				data: {user_id: user_id,last_id: lastID,order_id:order_id},
				dataType: 'json',
				success: function(data) {
                    console.log(data);
					penddingRequest = false;

					var chat = get_chat_list(data);
					$('#msg_list').append(chat);
				//	

					if (data.last_id != 0) {
						lastID = data.last_id
					}
			
				}
			});
		}

	}
/*End::Step3 new chat message get*/
	setInterval(function() {
		new_messages();
	}, 10000);
/*Start::Chat insert into chat message table (Form submit throught ajax)*/
	$('body').on('submit','#chat_box',function (e) {

		e.preventDefault();
		$.ajax({
        	url: base_url + "front-chat-msg-action",
        	type: 'POST',
        	data: $(this).serialize(),
        	dataType: 'json',
        	success: function(data) {
        		// alert(data);

        		var message = get_chat_list(data);

        		$("#msg_list").append(message);
        		$("#txtmsg").val('');

				if (data.last_id != 0) {
					lastID = data.last_id;
				}
        	}
        });
	});
/*End::Chat insert into chat message table (Form submit throught ajax)*/
/*Start::step1::Open chat form on onclick & set name image etc... */
	$('body').on('click','.assign_chtbtn',function(){

		$('#assign_myForm').show();

		fromImg = $(this).closest('.purohit-box').find('img').attr('src');

		lastID = 0;
		first_id = 0;
		loaded_all_chat = false;

		var purohit_name = $(this).attr("data-purohit-name");
		var to_id = $(this).attr("data-to-id");
		var order_id = $(this).attr("data-order-id");
		var pooja_status = $(this).attr("data-pooja-status");
		var pooja_reject_status = $(this).attr("data-pooja-reject-status");
		var pooja_reject_by = $(this).attr("data-pooja-reject-by");
// alert(to_id);
		$('.purohit_name_cls').text(purohit_name);
		$('#to_id_set').val(to_id);
		$('#order_id_set').val(order_id);
		if (pooja_status==2 || pooja_status==3 || pooja_status==4 || (pooja_reject_status=='Rejected' && to_id==pooja_reject_by)) {
			$('#txtmsg').prop("disabled", true);
			$('#btnsend').prop("disabled", true);
		}else{
			$('#txtmsg').prop("disabled", false);
			$('#btnsend').prop("disabled", false);
		}
		chats();
	});
	/*End::step1::Open chat form on onclick & set name image etc... */
});
	function closeForm() {
		document.getElementById("assign_myForm").style.display = "none";
	}
	 /*[START:: Date time format::]*/
  Date.prototype.getFormattedTime = function () {
      var hours = this.getHours() == 0 ? "12" : this.getHours() > 12 ? this.getHours() - 12 : this.getHours();
      var minutes = (this.getMinutes() < 10 ? "0" : "") + this.getMinutes();
      var ampm = this.getHours() < 12 ? "AM" : "PM";
      var formattedTime = hours + ":" + minutes + " " + ampm;
      return formattedTime;
  }
  /*[END:: Date time format::]*/

  $("#ratingFrm").validate({
// Specify the validation rules
ignore:[],
        rules: {
            txtcomment: {
                required: true,
                },
            rating: {
                required: true,
                },
       
         },
        // Specify the validation error messages
        messages: {
            txtcomment: {
                required: "* Please enter comment.",
                
            },
            rating: {
                required: "* Please select rating.",
                
            },
         
        },
        submitHandler: function (form) { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });
/*Start::Review form enable only when pooja_status 2 (i.e. completed)*/
	var poojastatus = $('#poojastatus').val();
	// alert(poojastatus);
  	if (poojastatus==2) {
			$('#btnclass').prop("disabled", false);
			$('.editsubmitbtn').prop("disabled", true);
			
		}else{
			$('#btnclass').prop("disabled", true);
			
		}

	 	if (poojastatus==4) {
			
			$('.editsubmitbtn').prop("disabled", true);
			
		}	
/*Start::Review form enable only when pooja_status 2 (i.e. completed)*/

/*STart::Cancel order pop-pup set pooja details*/
$('body').on('click','.cancelcls',function(){
		var puja_name = $(this).attr("data-pooja-name");
		var pooja_date = $(this).attr("data-pooja-date");
		var pooja_time = $(this).attr("data-pooja-time");
		var pooja_order_id = $(this).attr("data-pooja-order-id");
		var puja_pkg_ammount = $(this).attr("data-pkg-total");

		$('#poojanmset').text(puja_name);
		$('#poojadate').text(pooja_date);
		$('#poojatime').text(pooja_time);
		$('#puja_order_id').val(pooja_order_id);
		$('#puja_pkg_ammount').val(puja_pkg_ammount);
		
	});
/*End::Cancel order pop-pup set pooja details*/
/*Start::Cancel button hide when pooja_status=4 and show refund button */
$('.refundcls').hide();
// alert(poojastatus);
  	if (poojastatus==4 || poojastatus==3) {
			$('.refundcls').show();
			$('.cancelcls').hide();
			$('.editsubmitbtn').prop("disabled", true);
		}else if(poojastatus==2){
			$('.cancelcls').hide();

		}
/*End::Cancel button hide when pooja_status=4 and show refund button */
/*--IFSC Code VALIDATION start--*/
   jQuery.validator.addMethod("is_ifsc_code", function(value, element) {
      // allow any non-whitespace characters as the host part
      return this.optional( element )  ||  /^[A-Z|a-z]{4}[0][\d]{6}$/.test( value );
      }, 'Please enter a valid IFSC Code.');
      /*--IFSC Code VALIDATION STOP--*/
  $("#refundFrm").validate({
// Specify the validation rules
ignore:[],
        rules: {
            bank_name: {
                required: true,
                },
            holdername: {
                required: true,
                },
            account_number: {
                required: true,
                },
            ifsc_code: {
            	is_ifsc_code: true,
                required: true,
                },
            banch_name: {
                required: true,
                },
           
       
         },
        // Specify the validation error messages
        messages: {
            bank_name: {
                required: "* Enter bank name.",
                
            },
            holdername: {
                required: "* Enter account holder name.",
                
            },
            account_number: {
                required: "* Enter account number.",
                
            },
            ifsc_code: {
                required: "* Enter ifsc code.",
                
            },
            banch_name: {
                required: "* Enter banch name.",
                
            },
         
        },
        submitHandler: function (form) { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
    });

