<?php
    include 'emailValidate.php';

    $firstName = $lastName = $marksStr = "";

    $target_file = "";
    $img_upload = "";

    $sub_mark_arr = "";

    $phone = "+91";
    $valid_phone = TRUE;

    $email = "";
    $email_check = "";


    /** If Form submitted */
    if (isset($_POST["submit"])) {

        // Get firstName & lastName
        $firstName = $_POST["first-name"];
        $lastName = $_POST["last-name"];

        /** Get image */
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
            $target_file = "uploads/" . basename($_FILES["image"]["name"]);

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $img_upload = "successful";
            }
            else {
                $img_upload = "unsuccessful";
            }
        }

        /** Get suject marks */
        $marksStr = $_POST["subject-marks"];
        $marks_arr = explode("\n", $marksStr); // Convert the string in array of `sub|mark'
        $sub_mark_arr = array();  // Associative array of `sub => mark`

        foreach ($marks_arr as $key => $mark) {
            $sub_mark = explode("|", $mark);
            $sub_mark_arr[$sub_mark[0]] = $sub_mark[1];
        }

        /** Get phone number */
        if (isset($_POST["phone"])) {
            $phone = $_POST["phone"];

            if (strlen($phone) == 13 && preg_match("/^\+91[0-9]{10}$/", $phone)) {
                $valid_phone = TRUE;
            }
            else {
                $valid_phone = FALSE;
            }
        }

        /** Get Email */
        if (isset($_POST["email"])) {
            $email = $_POST["email"];

            if (isValidEmail($email) == TRUE) {
                $email_check = "valid";
            }
            else {
                $email_check = "invalid";
            }
        }

        /** Create,save and download user datas in pdf format. */
        if ($valid_phone == TRUE && $email_check == "valid") {
            /** Session start */
            session_start();
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['phone'] = $phone;
            $_SESSION['email'] = $email;

            header("Location: pdf.php");
            exit;
        }
    }
?>
