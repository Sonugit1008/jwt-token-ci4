<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light grey background */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <!-- Icon -->
        <div class="text-danger">
            <i class="bi bi-shield-exclamation" style="font-size: 6rem;"></i>
        </div>
        <!-- Heading -->
        <h1 class="display-4 text-danger fw-bold mt-3">Access Denied</h1>
        <!-- Description -->
        <p class="text-muted">You do not have permission to access this page.</p>
        <!-- Back Button -->
        <a href="<?=base_url('/')?>" class="btn btn-primary mt-4">
            <i class="bi bi-arrow-left-circle"></i> Back to Home
        </a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
