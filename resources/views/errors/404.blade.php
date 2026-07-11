<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Not Found - 404</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #334155;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset("image.png") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            z-index: -2;
        }

        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #176b87e0;
            z-index: -1;
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.95);
            padding: 3rem 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), 0 8px 10px -6px rgba(0, 0, 0, 0.2);
            max-width: 28rem;
            width: 90%;
            backdrop-filter: blur(10px);
        }

        .icon {
            color: #ef4444;
            margin-bottom: 1.5rem;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 0 1rem 0;
            color: #0f172a;
        }

        p {
            margin: 0 0 2rem 0;
            line-height: 1.5;
            color: #475569;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            background-color: #176b87;
            color: white;
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn:hover {
            background-color: #125368;
            box-shadow: 0 4px 6px -1px rgba(23, 107, 135, 0.2);
        }
    </style>
</head>

<body>
    <div class="container">
        <svg class="icon" width="64" height="64" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
            </path>
        </svg>
        <h1>Document Not Found</h1>
        <p>The document you are looking for is not registered in our system or may have been deleted. Please check the
            QR code or link and try again.</p>
        <a href="{{ route('home') }}" class="btn">Return to Homepage</a>
    </div>
</body>

</html>