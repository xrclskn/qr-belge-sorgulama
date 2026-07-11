<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Of Origin System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
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
            background: white;
            padding: 2.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            max-width: 800px;
            width: 90%;
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 2rem;
        }

        .icon {
            width: 20px;
            height: 20px;
            color: #475569;
        }

        .grid-content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 3rem;
            align-items: center;
        }

        @media (max-width: 768px) {
            .grid-content {
                grid-template-columns: 1fr;
            }
        }

        .image-wrapper img {
            width: 100%;
            height: auto;
            border-radius: 0.5rem;
            display: block;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .form-wrapper {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .input-field {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid transparent;
            background-color: #e2e8f0;
            color: #334155;
            font-size: 0.875rem;
            font-family: inherit;
            box-sizing: border-box;
            outline: none;
            transition: all 0.2s;
        }

        .input-field:focus {
            border-color: #176b87;
            background-color: #f1f5f9;
        }

        .disabled-input {
            color: #64748b;
            cursor: not-allowed;
            opacity: 0.8;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1rem;
        }

        .submit-btn {
            background-color: #3f6075;
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            border: none;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            width: 100%;
            font-family: inherit;
        }

        .submit-btn:hover {
            background-color: #2c4454;
        }

        .login-link {
            display: inline-block;
            margin-top: 1rem;
            color: #94a3b8;
            font-size: 0.75rem;
            text-decoration: none;
            text-align: center;
        }

        .login-link:hover {
            color: #475569;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header-title">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Certificate of Origin Verification
        </div>

        <div class="grid-content">
            <div class="image-wrapper">
                <img src="{{ asset('illustration.png') }}" alt="Verification Illustration">
            </div>

            <div class="form-wrapper">
                @if(session('error'))
                <div
                    style="background-color: #fee2e2; border: 1px solid #f87171; color: #b91c1c; padding: 0.75rem; border-radius: 0.375rem; font-size: 0.875rem; margin-bottom: 1rem;">
                    {{ session('error') }}
                </div>
                @endif
                <form id="verifyForm" action="{{ route('verify.manual') }}" method="POST">
                    @csrf

                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <input type="text" name="serial_no" placeholder="Reference Number" class="input-field" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <input type="text" id="qr_code" name="qr_code" placeholder="QR-Code" class="input-field"
                            required>
                    </div>

                    <button type="submit" class="submit-btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>