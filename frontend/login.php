<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
<div class="d-flex justify-content-center pt-5 align-items-center">
        <form class="form col-6 mt-5" method="POST" action="{{ route('postlogin') }}">
            @csrf
            <p class="title">Login </p>
                <div class="flex">
            </div>  
                    
            <label class="mb-3">
                <small class="text-black">Email</small>
                <input class="input" type="email" name="email" placeholder="Ema" required="">
            </label> 
                
            <label>
                <small class="text-black">Password</small>
                <input class="input" type="password" name="password" placeholder="" required="">
            </label>
            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="submit col-4">login</button>
            </div>
            <p class="text-black signin">Don't have an account? <a href="{{route('register')}}">Sign up</a> </p>
        </form>
    </div>

  


























<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>