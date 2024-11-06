<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <?php include 'inc/style.php'; ?>
</head>

<body>
  <div class="wrapper">
    <div class="container">
      <div class="row">
        <div class="col-sm-5 mx-auto mt-5">
          <div class="card shadow">
            <div class="card-body">
              <div class="card-title">
                <h3 class="text-center">Welcome!</h3>
                <p class="text-center">Login</p>
              </div>
              <?php if(isset($_GET['register']) == 'success'): ?>
              <div class="alert alert-success">Register success!</div>
              <?php endif ?>
              <form action="controller/action-login.php" method="post">
                <div class="form-group mb-3">
                  <!-- <label for="email" class="form-label">Email</label> -->
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group mb-3">
                  <!-- <label for="password" class="form-label">Password</label> -->
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group mb-3">
                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Log In</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- <div class="card shadow mt-2">
            <div class="card-body">
              <p align="center">Don't have an account? <a style="text-decoration: none;" href="register.php">Sign Up</a>
              </p>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>

  <?php include 'inc/script.php'; ?>
</body>

</html>