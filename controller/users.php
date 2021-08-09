<?php
    session_start();
    include_once "config.php";

    $sql = mysqli_query($conn,"SELECT * FROM users WHERE NOT unique_id={$_SESSION['unique_id']}");
    $output = "";
    if (mysqli_num_rows($sql) == 1) {
        $output .= "No users are available to chat";
    } else if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $sql2 = mysqli_query($conn,"SELECT * FROM messages WHERE (incoming_message_id = {$row['unique_id']} OR outgoing_message_id = {$row['unique_id']}) 
            AND (outgoing_message_id = {$row['unique_id']} OR incoming_message_id = {$row['unique_id']}) ORDER BY msg_id DESC LIMIT 1");
            $row2 = mysqli_fetch_assoc($sql2);
            if (mysqli_num_rows($sql2) > 0) {
                $msg = $row2['msg'];
                (strlen($msg) > 28)? $msg = substr($msg,0,28).'...' : $msg = $msg;

                ($_SESSION['unique_id'] == $row2['outgoing_message_id']) ? $you = "You: " : $you = "";
                ($row2['status'] == "offline") ? $offline = "offline: " : $offline = "";
            } else {
                $msg = "No message available right now";
            }
            
            if ($_SESSION['unique_id'] != $row['unique_id']) {
                $output .= '<a href="chat.php?user_id='.$row['unique_id'].'">
                            <div class="content">
                                <img src="controller/images/'.$row['img'].'" alt="">
                                <div class="details">
                                    <span>'.$row['fname'].' '.$row['lname'].'</span>
                                    <p>'.$you.$msg.'</p>
                                </div>
                            </div>
                            <div class="status-dot '.$offline.'">
                                <div><i class="fas fa-circle"></i></div>
                            </div>
                        </a>';
            }
        }
    }
    echo $output;
?>