@extends('layouts.app')
@section('breadcrumbs')
    <nav aria-label="breadcrumb" class="breadcrumb">
        <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profile</a></li>
            <li class="breadcrumb-item"><a href="{{ route('payment-methods') }}">Payment Methods</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Payment Method</li>
        </ol>
        @endsection
        @section('content')
            <div class="error">
                @if($errors->any())
                    {{ $errors->first() }}
                @endif

                <div id="add-payment-method-container" class="container">
                    <h1 style="margin-top: 0">Add Payment Method</h1>

                    <form id="payment-method-form" action="{{ route('payment-methods.add') }}" method="POST">
                        @csrf

                        <label for="payment-type">Select Payment Method:</label>
                        <select name="payment-type" id="payment-type">
                            <option value="none">Select Payment Method</option>
                            <option value="mbway">MBWAY</option>
                            <option value="credit-card">Credit Card</option>
                        </select>

                        <div id="dynamic-form">
                        </div>

                        <button type="submit" id="submit-button" class="details-button" style="display: none;">Submit</button>
                    </form>
                </div>

                <script>
                    let paymentType = document.getElementById('payment-type');
                    let submitButton = document.getElementById('submit-button');

                    paymentType.addEventListener('change', function () {
                        let selectedType = this.value;
                        let dynamicForm = document.getElementById('dynamic-form');
                        dynamicForm.innerHTML = '';

                        if (selectedType === 'mbway') {
                            dynamicForm.innerHTML = `
                <label for="mbway-phone-number">Phone Number:</label>
                <input type="text" id="mbway-phone-number" name="mbway-phone-number" required>`;
                        } else if (selectedType === 'credit-card') {
                            dynamicForm.innerHTML = `
                <label for="credit-card-number">Card Number:</label>
                <input type="text" id="credit-card-number" name="credit-card-number" required>
                <label for="credit-card-cvv">CVV:</label>
                <input type="text" id="credit-card-cvv" name="credit-card-cvv" required>
                <label for="credit-card-date">Expiration Date:</label>
                <input type="text" id="credit-card-date" name="credit-card-date" placeholder="MM/YYYY" required>`;
                        }

                        addPaymentMethodNameField(selectedType); // Call function to add payment method name field
                        toggle(selectedType);
                    });

                    function addPaymentMethodNameField(selectedType) {
                        let dynamicForm = document.getElementById('dynamic-form');
                        let paymentMethodLabel = document.createElement('label');
                        paymentMethodLabel.setAttribute('for', 'payment-method-name');
                        paymentMethodLabel.textContent = 'Payment Method Name:';
                        dynamicForm.appendChild(paymentMethodLabel);

                        let paymentMethodNameInput = document.createElement('input');
                        paymentMethodNameInput.setAttribute('type', 'text');
                        paymentMethodNameInput.setAttribute('id', 'payment-method-name');
                        paymentMethodNameInput.setAttribute('name', 'payment-method-name');
                        paymentMethodNameInput.setAttribute('required', 'required');
                        dynamicForm.appendChild(paymentMethodNameInput);
                    }

                    function toggle(selectedType) {
                        if (selectedType === 'none') {
                            submitButton.style.display = 'none';
                        } else {
                            submitButton.style.display = 'block';
                        }
                    }
                </script>

@endsection