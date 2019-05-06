<!DOCTYPE html>
<html>

<head>
    <title>HR | Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/jquery-1.12.0.min.js">
    </script>
    <script src="js/bootstrap.min.js">
    </script>

    <script>
        if (!(document.getElementById('uname').value == '' && document.getElementById('pwd').value == '')){
            var username = document.getElementById('uname').value;
            var password = document.getElementById('pwd').value;
        }

        function login() {
            if (username == 'Admin' && password=='admin'){
                alert('Yoh men');
                window.location.href= "admin_dashboard.php";
            }

        }
    </script>
</head>

<body>
<div class="container">
<div class="panel panel-primary">
    <div class="panel-heading">
        <label>Login Below</label>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="hr_login_db.php" method="POST">
            <div class="form-group">
                <label class="control-label col-sm-4" for="email">Username:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter username" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="pwd">Password:</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter password" required="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4"></div>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary" onClick="login()">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

</body>
</html>
