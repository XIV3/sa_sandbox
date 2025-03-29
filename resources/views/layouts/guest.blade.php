<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instant WordPress Staging - ServerAvatar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --secondary-color: #0ea5e9;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --accent-color: #10b981;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
            line-height: 1.7;
            background-color: #f8fafc;
        }
        
        /* Navigation */
        .navbar {
            backdrop-filter: blur(10px);
        }
        
        .navbar-brand img {
            height: 42px;
        }
        
        /* Hero section */
        .hero-section {
            padding: 120px 0 100px;
            background: radial-gradient(circle at 70% 30%, rgba(99, 102, 241, 0.15) 0%, rgba(14, 165, 233, 0.08) 50%, rgba(248, 250, 252, 0) 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            top: -100%;
            left: -50%;
            z-index: -1;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.05) 0%, rgba(14, 165, 233, 0.02) 50%, rgba(248, 250, 252, 0) 70%);
        }
        
        .hero-gradient-text {
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }
        
        /* Features */
        .features-list {
            margin-top: 2rem;
        }
        
        .features-list li {
            margin-bottom: 1.25rem;
            display: flex;
            align-items: flex-start;
        }
        
        .features-list i {
            color: var(--accent-color);
            background-color: rgba(16, 185, 129, 0.12);
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            margin-top: 2px;
            font-size: 0.75rem;
            flex-shrink: 0;
        }
        
        /* Form */
        .form-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06), 
                        0 1px 3px rgba(0, 0, 0, 0.05);
            padding: 2.5rem;
            position: relative;
            z-index: 10;
            border: 1px solid rgba(226, 232, 240, 0.7);
        }
        
        .form-container::before {
            content: '';
            position: absolute;
            top: -10px;
            right: -10px;
            bottom: -10px;
            left: -10px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(14, 165, 233, 0.05) 100%);
            border-radius: 20px;
            z-index: -1;
        }
        
        .form-control, .input-group-text, .btn {
            border-radius: 10px;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            border-color: var(--primary-color);
        }
        
        .btn-primary {
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
            font-weight: 600;
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.15), 
                        0 4px 6px -4px rgba(99, 102, 241, 0.1);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            background: linear-gradient(90deg, var(--primary-dark) 0%, var(--primary-color) 100%);
            box-shadow: 0 15px 20px -3px rgba(99, 102, 241, 0.2), 
                        0 8px 8px -4px rgba(99, 102, 241, 0.15);
        }
        
        /* FAQ section */
        .faq-section {
            background-color: white;
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }
        
        .faq-section::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: radial-gradient(circle at 10% 90%, rgba(99, 102, 241, 0.08) 0%, rgba(248, 250, 252, 0) 60%);
            z-index: 0;
        }
        
        .accordion-item {
            border-radius: 12px !important;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
            margin-bottom: 1rem;
        }
        
        .accordion-item:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05),
                        0 10px 10px -5px rgba(0, 0, 0, 0.01);
        }
        
        .accordion-button {
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            background-color: white;
            font-size: 1.05rem;
            color: var(--dark-color);
        }
        
        .accordion-button:not(.collapsed) {
            color: var(--primary-color);
            background-color: rgba(99, 102, 241, 0.05);
            font-weight: 600;
            box-shadow: none;
        }
        
        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(99, 102, 241, 0.5);
        }
        
        .accordion-button::after {
            background-size: 16px;
            height: 16px;
            width: 16px;
        }
        
        /* CTA section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 60%);
            z-index: 0;
        }
        
        /* Footer */
        .footer {
            background-color: var(--dark-color);
            color: #e2e8f0;
            padding: 60px 0 40px;
        }
        
        .footer a {
            color: #e2e8f0;
            transition: color 0.2s ease;
        }
        
        .footer a:hover {
            color: white;
        }
        
        .footer h5 {
            color: white;
            font-weight: 600;
            margin-bottom: 1.25rem;
            font-size: 1.1rem;
        }
        
        .footer li {
            margin-bottom: 0.75rem;
        }
        
        /* Animations */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-section {
                padding: 80px 0 60px;
            }
            
            .form-container {
                padding: 1.75rem;
            }
            
            .faq-section {
                padding: 80px 0;
            }
        }
    </style>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>