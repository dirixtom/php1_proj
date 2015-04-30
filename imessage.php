<?php
	session_start();
	if(isset( $_SESSION['name'] ))
	{
		$currentUser = $_SESSION['name'];
	}

	include_once("classes/Message.class.php");
	$m = new Message();
	if( !empty($_POST) )
	{	
		try {
			$m = new Message();
			$m->setText($_POST['text']);
			$m->setUser($currentUser);
			$m->Create();
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	}
	$all_messages = $m->GetAllMessages();

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>iMessage</title>
	<link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>

<?php

    if (isset($error)): ?>

        <div class="error"><?php echo $error; ?></div>

<?php endif ?>
	<div class="chat">
		
		<section class="messages">
			<?php
				while( $message = $all_messages->fetch(PDO::FETCH_OBJ) )
				{
					echo "<article>";
					if( $message->user === $currentUser )
					{
						echo "<article class='me'>" . $message->message . "</article>";
					}
					else
					{
						echo "<article class='them'>" . $message->message . "</article>";
					}
					echo "</article>";
				}
			?>
		</section>

		<section class="newMessage">
			<form action="" method="post">
			<input type="text" class="imessage" placeholder="iMessage" name="text">
			<button type="submit" value="Send" id="btnSubmit">Send</button>
			</form>
		</section>
	</div>

    <script>

        $(document).ready(function(){
            // 1 - click op button
            $("#btnSubmit").on("click", function(e){
                // 2 - value uit form lezen
                var text = $(".imessage").val();

                // 3 - AJAX call richting ajax/save_activity.php
                $.ajax({
                    method: "POST",
                    url: "classes/save_message.php",
                    data: { 'text' : text }
                })
                    .done(function( resp ) {
                        //alert( "Data Saved: " + resp );
                        //console.log(resp);
                        if(resp.status === "success")
                        {
                            // 4 - indien success> slideDown()
                            console.log("finish!!");
                            var li = $("<article class='me'></article>").html(resp.text).css("display","none");
                            $(".messages").append(li);
                            li.slideDown("fast");
                            //$(".messages").last().slideUp("fast", function(){
                            //$(this).remove();
                            //});
                        }
                    });

                setInterval(function(){

                    $.get("classes/get_message.php", function(data, status){

                        console.log(data.toString());

                    });

                }, 3000);

                e.preventDefault();
            });
        });

    </script>

</body>
</html>