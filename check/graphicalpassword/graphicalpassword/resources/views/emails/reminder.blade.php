Hello <strong>{{ $username }}</strong>,
<p>{{$body}}</p>

<a href="{{route('select.password',[
            'username' => $username,
            'email' => $email,
            'address' => $address,
            'city' => $city,
            'contact_num' => $contact_num,
            'deluser'=>'1'
    ])}}">Reset password</a>


