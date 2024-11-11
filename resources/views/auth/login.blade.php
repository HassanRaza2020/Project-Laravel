<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
   
</head>


<body>


<div class="container text-align-center">
  <h1 class="heading">Login</h1>

  <form style="margin-top: 80px;" action="{{ route('login') }}" method="POST">
    @csrf  <!-- CSRF token for security -->

    <div class="col-10 offset-sm margin-bottom-15">
      <label for="email">User Email</label>
      <input
        type="text"
        class="form-control"
        id="email"
        name="email"
        aria-describedby="emailHelp"
        placeholder="Enter user email"
      />
    </div>

    <div class="col-10 offset-sm margin-bottom-15">
      <label for="password">User Password</label>
      <input
        type="password"
        class="form-control"
        id="password"
        name="password"
        placeholder="Enter user password"
      />
    </div>

    <button type="submit" class="btn-primary" name="login">Login</button>
  </form>
</div>
    
</body>
</html>