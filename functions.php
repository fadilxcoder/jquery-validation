<?php
    include 'db-connect.php';

    // Errors Setting
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    /* QUERIES */
    function converter($query)
    {
        $arr = array();
        while( $data = mysqli_fetch_assoc($query)):
                $arr[] = $data;
        endwhile;
        return $arr;
    }

    function newsletter($email)
    {
        global $connection;
        $email = strip_tags($email);
        $sql = "INSERT INTO `newsletters` (`email`, `date_ins`) VALUES ('".$email."', '".date('d-m-y')."') ";
        $query = mysqli_query($connection, $sql);
        $data = "success";
        echo json_encode($data);
    }
    
    function check_email($email)
    {
        global $connection;
        $email = strip_tags($email);
        $sql = "SELECT * FROM newsletters WHERE email = '".$email."'";
        $query = mysqli_query($connection, $sql);
        $result = converter($query);
        if(empty($result)):
            $value = TRUE;
        else:
            $value = FALSE;
        endif;
        echo json_encode($value);
    }

    /* LOGIC */
    if(isset($_POST['email']) && $_POST['exec'] == 'insertion'):
        newsletter($_POST['email']);
    endif;

    if(isset($_POST['email']) && $_POST['exec'] == 'validation'):
        check_email($_POST['email']);
    endif;
?>