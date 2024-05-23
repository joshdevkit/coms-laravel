<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Construction Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <h3 class="card-title">Welcome to Construction Management System</h3>
                <p class="card-text">Hi <?php echo e($name); ?>,</p>
                <p class="card-text">You recently update your password. For some secutity reason please verify this action.</p>
                <p class="card-text">You're OTP:</p>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Email:</strong> <?php echo e($email); ?></li>
                    <li class="list-group-item"><strong>OTP:</strong> <?php echo e($otp); ?></li>
                </ul>
                <p class="card-text">If you receive this message by mistake please disregard it or delete. Thank You!</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\construction-management-system\resources\views/emails/otp_mailer_mail.blade.php ENDPATH**/ ?>