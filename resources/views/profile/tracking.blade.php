@extends('layouts.app')
@section('content')
    <div id="tracking-container" class="container small-container">
    <form id="trackingForm">
        @csrf
        <label for="tracking_number" style="font-size: 1.15em">Enter Tracking Number:</label><br>
        <input type="text" id="tracking_number" name="tracking_number"><br><br>
        <button type="button" id="trackButton" class="details-button">Track</button><br><br>

        <div id="errorsDiv">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </form>

    <div id="trackingResults"></div>
    </div>
    <script>
        document.getElementById('trackButton').addEventListener('click', function() {
            track();
        });

        document.getElementById('trackingForm').addEventListener('submit', function(event) {
            event.preventDefault();
            track();
        });

        function track() {
            let trackingNumber = document.getElementById('tracking_number').value;

            fetch('{{ url('/track') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ tracking_number: trackingNumber })
            })
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    let errorsDiv = document.getElementById('errorsDiv');
                    let tracking_results = document.getElementById('trackingResults');

                    errorsDiv.innerHTML = '';
                    tracking_results.innerHTML = '';

                    if (data.error) {
                        errorsDiv.innerHTML = '<div class="alert alert-danger">' + data.error + '</div>';
                    } else {
                        if (data.trackingStatus === 'Shipped') {
                            tracking_results.innerHTML = '<p>Your order has been shipped! It will be delivered to <strong>' + data.purchase.address + '</strong> on ' + data.deliveryDate + '</p>';
                        } else if (data.trackingStatus === 'Delivered') {
                            tracking_results.innerHTML = '<p>Your order has been delivered to ' + data.purchase.address + '</p>';
                        }
                    }
                })
                .catch(function(error) {
                    let errorsDiv = document.getElementById('errorsDiv');
                    errorsDiv.innerHTML = '<div class="alert alert-danger">' + error.message + '</div>';
                });
        }
    </script>
@endsection
