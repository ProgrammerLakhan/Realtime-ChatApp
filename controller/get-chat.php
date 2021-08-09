<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = mysqli_real_escape_string($conn,$_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn,$_POST['incoming_id']);
        $output = "";
        $sql = mysqli_query($conn,"SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.incoming_message_id WHERE (outgoing_message_id = {$outgoing_id} AND incoming_message_id = {$incoming_id}) OR (outgoing_message_id = {$incoming_id} AND incoming_message_id = {$outgoing_id}) ORDER BY msg_id ASC");
        if (mysqli_num_rows($sql) > 0) {
            while($row = mysqli_fetch_assoc($sql)){
                if ($row['outgoing_message_id'] === $outgoing_id) {
                    $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p>'.$row['msg'].'</p>
                                    </div>
                                </div>';
                }else {
                    $output .= '<div class="chat incoming">
                                    <img src="controller/images/'.$row['img'].'" alt="">
                                    <div class="details">
                                        <p>'.$row['msg'].'</p>
                                    </div>
                                </div>';
                }
            }
            echo $output;
        } else {
            echo "No messages yet";
        }
        

    }else {
        header("location:../login.php");
    }

?>