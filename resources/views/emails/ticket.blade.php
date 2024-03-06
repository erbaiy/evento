<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Ticket Details</title>
</head>

<body>
    <h1>Ticket Details</h1>

    <p><strong>Event ID:</strong> {{ $event['event_id'] }}</p>

    <p><strong>Ticket Token:</strong> {{ $ticket->token }}</p>
    {{-- @dd('ddd'); --}}
    <!-- Add any other ticket details you want to display here -->
</body>

</html>

{{-- @dd();
<x-mail::message>
    # Introduction

    The body of your message.

    <x-mail::button :url="''">
        Button Text
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message> --}}
