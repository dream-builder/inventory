<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Activity Tracking System</title>
  </head>

  <body>
    <?php $email = "http://monitoring.mamoni.info/reset_pass?token=".base64_encode($data->email);?>
    <h2>Dear, {{$data->name}}</h2>


    You recently used the "Forgot Password" function on the Activity Tracking System.<br><br>

    You can reset your password now by clicking the following link or copy the link to your browser address line:<br><br>

    <a href="{{$email}}">{{$email}}</a><br><br>

    Important: For some email clients the link may not be working on "Click". In this case please copy the entire link and paste it to the browser address line, click Enter.
    <br><br><br>
    Kind regards,<br><br>
    ATS Team (ICT Innovation, MaMoni MNCSP)
  </body>
</html>
