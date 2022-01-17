@extends('layouts.general')

@section('content')
    <script type="text/javascript" src="https://test-epay.homebank.kz/payform/payment-api.js"></script>
    <script>
        var invoiceId = "002300024";
        var amount = 150;
        var auth = {
            "access_token": "GT51F8UFU702W6LKG57MFM",
            "expires_in": "5000",
            "refresh_token": "",
            "scope": "payment",
            "token_type": "Bearer"
        };

        var hostname = window.location.hostname;
        alert(hostname);
        var createPaymentObject = function(auth, invoiceId, amount) {
            var paymentObject = {
                invoiceId: invoiceId,
                backLink: "https://" + hostname + "/covid/success-payment",
                failureBackLink: "https://" + hostname + "/covid/failure-payment",
                postLink: "https://" + hostname + "/api/covid/payment-response",
                failurePostLink: "https://" + hostname + "/api/covid/payment-response",
                language: "RU",
                description: "Оплата в интернет магазине",
                accountId: "testuser1",
                terminal: "67e34d63-102f-4bd1-898e-370781d0074d",
                amount: amount,
                currency: "KZT",
                phone: "77777777777",
                email: "example@example.com",
                cardSave: true
            };
            paymentObject.auth = auth;
            return paymentObject;
        };
        halyk.pay(createPaymentObject(auth, invoiceId, amount));
    </script>
@endsection
