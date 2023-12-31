<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h4>You Have New Mail !!</h4>
    <strong>Country:</strong>
    {{@$data->country}}
    <br>
    <strong>Destination:</strong>
    {{@$data->destination}}
    <br>
    <strong>Trip Type:</strong>
    {{@getTripType($data->trip_type)}}
    <br>
    <strong>Trip Start:</strong>
    {{@$data->trip_start}}
    <br>
    <strong>Trip End:</strong>
    {{@$data->trip_end}}
    <br>
    <strong>price Range:</strong>
    {{@$data->price_range}}
    <br>
    <strong>Adults:</strong>
    {{@$data->adults}}
    <br>
    <strong>Childs:</strong>
    {{@$data->childs}}
    <br>
    <strong>Infants:</strong>
    {{@$data->infants}}
    <br>
    <strong>Full Name:</strong>
    {{@$data->full_name}}
    <br>
    <strong>Contact Num:</strong>
    {{@$data->contact_num}}
    <br>
    <strong>Email:</strong>
    {{@$data->email}}
    <br>
</body>
</html>
