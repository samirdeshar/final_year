<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking Detail</title>
</head>
<body>
    <h1>You Have New Booking Details</h1>

    <p>
        <strong>Trip:</strong>{{$data->trip->title}}
        <br>
        <strong>Trip Type:</strong>{{getTripType(@$data->trip_type)}}
        <br>
       <strong>Name:</strong>{{ucfirst(@$data->first_name) .' '.ucfirst(@$data->middle_name).' '.ucfirst(@$data->last_name)}}
        <br>
        <strong>Total Person</strong>:{{@$data->adults + @$data->childs+ @$data->infants}}
        <br>
        <strong>Adult</strong>:{{@$data->adults}}
        <br>
        <strong>Children</strong>:{{@$data->childs}}
        <br>
        <strong>Infants</strong>:{{@$data->infants}}
        <br>
         <strong>Phone Num:</strong>:{{@$data->contact_num}}
        <br>
         <strong>Country</strong>:{{@$data->country}}
        <br>
         <strong>City</strong>:{{@$data->city}}
        <br>
        <strong>Comment</strong>:{{@$data->additional_info}}
        <br>
        <strong>Email</strong>:{{@$data->email}}
        <br>
    </p>
</body>
</html>
