<!DOCTYPE html>
<html>

<head>
    <title>Contract Expiry Notification</title>
</head>

<body>
    <p>Dear {{ $mou->customer->name }},</p>
    <p>We would like to inform you that your contract with us will expire soon.</p>
    <p><strong>Contract Number:</strong> {{ $mou->mou_number }}</p>
    <p><strong>End Date:</strong> {{ $mou->contract_end_date }}</p>
    <p>Please contact us if you wish to renew your contract.</p>
    <p>Thank you!</p>
</body>

</html>
