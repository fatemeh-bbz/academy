<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    $error = array();
    if(sizeof($_POST)>0)
        if(isset($_POST['agree'])){
            $name = $_POST['fname'];
            $mail = $_POST['email'];
            $pass = hash('sha256',$_POST['pass']);
            $gender = $_POST['gender'];
            $date = $_POST['date'];
            $db = @mysqli_connect('localhost','root','','registerform');
            $er = true;
            if(!$db)   
                $error[] =  'خطا در اتصال ';
            else{
                $sql = "insert into users values('$name','$mail','$pass','$gender','$date')";
                $db->query($sql);
                if($db->affected_rows>0){
                    $error[] = 'اطلاعات با موفقیت وارد شد';
                    $er = false;
                }
                else  
                
                    $error[] = 'اطلاعات ذخیره نشده است';
            }
        }
        else
            $error[] = 'گزینه من ربات نیستم انتخاب نشده است';
?>
<?php if(sizeof($error)>0): ?>
    <?php if($er == true): ?>
        <div class="register error">
    <?php else: ?>
        <div class="register success">
        <?php endif; ?>
       <ul>
       <?php
            foreach($error as $e)
                echo  '<li>'.$e.'</li>';
       ?>
       </ul>
       
</div>
<?php  endif ?>

    <div class="container">
    <div class="back">  </div>  
    <div class="content" >
        <div class="r">
    <form method="post" action="" class="register">
    <h2 Style="text-align: center;color:#7E2BDB;">ثبت نام</h2>
        <div>
        
        <label for="">نام کاربری</label>
        <input type="text" name="fname" required>
        </div>

        <div>
        <label for="">ایمیل</label>
        <input type="email" name="email" required>
        </div>

         <div>
        <label for="">رمز عبور</label>
        <input type="password" name="pass" required>
        </div>

        
        <div>
            <label for="">تاریخ تولد</label>
            <input type="date" name="date" >
        </div>

        <div>
            <label for="">جنسیت</label>
            <input type="radio" name="gender" value="1">مرد
            <input type="radio" name="gender" value="2">زن
        </div>

        <div>
            <input type="checkbox" name="agree" value="1">من ربات نیستم
        </div>

        <div>
            <input type="submit" value="ثبت" class="btn" style="padding:5px 25px">
        </div>

    </form>
        </div>
        <div><img src="1.png" style="width: 400px;"></div>
    </div>
    </div>
</body>
</html>
