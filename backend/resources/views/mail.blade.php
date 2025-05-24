@component('mail::message')
    <img src="{{asset('storage/images/logo.png')}}" alt="" width="150">
    <H2>Hi {{$name}}</H2>
    <br>
    Your account has been created successfully.
    <br><br>
    <div>
        <a href="http://localhost/setup_credentials.php?id={{$id}}" style="padding: 10px 15px; color: #fff; background-color:#3674B5">Complete your account</a>
    </div>
@endcomponent