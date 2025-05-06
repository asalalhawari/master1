<!-- resources/views/emails/appointment_confirmation.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Appointment Confirmation</title>
</head>

<body>

    <h1>Thank you for booking an appointment with us, {{ $appointment->name }}!</h1>

    <p>We have confirmed your appointment for:</p>

    <ul>
        <li>Service: {{ $appointment->service }}</li>
        <li>Date: {{ $appointment->date }}</li>
        <li>Time: {{ $appointment->time }}</li>
    </ul>

    <p>We look forward to seeing you!</p>

</body>

</html>
