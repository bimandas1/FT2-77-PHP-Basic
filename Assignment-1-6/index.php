<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PHP Basic Assignment </title>
</head>
<body>
    <?php
        include './form.php';
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
        First Name :
        <input type="text" id="first-name" name="first-name" oninput="updateFullName()">
        <br> <br>

        Last Name :
        <input type="text" id="last-name" name="last-name" oninput="updateFullName()">
        <br> <br>

        Full Name :
        <input type="text" id="full-name" name="full-name" disabled>
        <br> <br>

        Image :
        <input type="file" name="image">
        <br> <br>

        Phone number :
        <input type="text" name="phone">

        <?php
            if($valid_phone == FALSE){
                echo "<p class='wrong'> Invalid phone number </P>";
            }
        ?>

        <br> <br>

        Email :
        <input type="text" name="email">

        <?php
            if($email_check == "valid"){
                echo "<p class='wrong'> Valid Email Id </P>";
            }
            else if($email_check == "invalid") {
                echo "<p class='wrong'> Invalid Email Id </P>";
            }
        ?>

        <br> <br>

        Subject Marks :
        <br>
        <textarea name="subject-marks" cols="30" rows="10"> </textarea>
        <br> <br>

        <input type="submit" name="submit">
    </form>

    <?php
        if(strlen($firstName) > 0){
            echo "Hello " . $firstName . " " . $lastName;
        }

        /** Display image */
        if($img_upload === "successful"){
            echo "<img src='$target_file' alt='Uploaded Image'> ";
        }
        else if($img_upload === "unsuccessful") {
            echo "<p class='wrong'> Image not uploaded successfully ! </p>";
        }

        /** Display Marks table */
        if(empty($sub_mark_arr) == FALSE){
            echo "
                <table>
                    <tr>
                        <th> Subject </th>
                        <th> Mark </th>
                    </tr>";


                    foreach($sub_mark_arr as $sub => $mark) {
                        echo "
                            <tr>
                                <td> $sub </td>
                                <td> $mark </td>
                            </tr>
                        ";
                    }


            echo
                "</table>
            ";
        }
    ?>

</body>

    <script src="./script.js"> </script>
</html>
