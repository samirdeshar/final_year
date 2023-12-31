<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking Detail</title>
</head>
<body>
    <h1>Booking Successfull !!</h1>
    <p>
        <strong>Dear</strong>,
        <br>
        Mr {{ @$data->first_name .' '.@$data->middle_name.' '.@$data->last_name}}
        <br>
        Your Booking has Been Successfully Done With Details !!

        <br>
        <strong>Total Person</strong>:{{@$data->adults + @$data->childs + @$data->infants}}
        <br>
        <strong>Adult</strong>:{{@$data->adults}}
        <br>
        <strong>Children</strong>:{{@$data->childs}}
        <br>
        <strong>Children</strong>:{{@$data->infants}}
        <br>

        
    </p>
</body>
</html>
