@extends('layouts.general')

@section('content')
    <script type="text/javascript" src="https://test-epay.homebank.kz/payform/payment-api.js"></script>
    <script>
        var invoiceId = "002300020";
        var amount = 150;
        var auth = {
            "access_token": "QESNU3GSC8W8D6QPIMJCZG",
            "expires_in": "5000",
            "refresh_token": "",
            "scope": "payment",
            "token_type": "Bearer"
        };
        var createPaymentObject = function(auth, invoiceId, amount) {
            var paymentObject = {
                invoiceId: invoiceId,
                backLink: "http://127.0.0.1:8000/covid/success-payment",
                failureBackLink: "http://127.0.0.1:8000/covid/failure-payment",
                postLink: "http://127.0.0.1:8000/api/covid/payment-response",
                failurePostLink: "http://127.0.0.1:8000/api/covid/payment-response",
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
