@extends('layouts.main')

@inject('systemSettings', 'App\Services\SystemSettingsService')

@section('content')
<!-- Hero Section -->
<section class="hero-section" id="home">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <span class="badge bg-white shadow-sm text-primary fw-medium px-3 py-2 mb-4">
                    <i class="fas fa-rocket me-1"></i> Deploy & Delete in seconds
                </span>
                <h1 class="display-3 fw-bold mb-3">
                    <span class="hero-gradient-text">Instant Throwaway</span> WordPress Sites
                </h1>
                <p class="lead text-secondary mb-4">Create disposable WordPress environments instantly. Perfect for quick tests, temporary client demos, and short-term projects with zero commitment.</p>
                
                <ul class="features-list list-unstyled">
                    <li>
                        <i class="fas fa-bolt"></i>
                        <div>
                            <strong class="d-block mb-1">Zero Setup Time</strong>
                            <span class="text-secondary">Your throwaway site is ready in under 30 seconds</span>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-trash-alt"></i>
                        <div>
                            <strong class="d-block mb-1">Self-Destructing</strong>
                            <span class="text-secondary">Sites auto-delete after {{ $systemSettings->get('default_deletion_time', 24) }} hours or delete manually anytime.</span>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-link"></i>
                        <div>
                            <strong class="d-block mb-1">Shareable Links</strong>
                            <span class="text-secondary">Show clients concepts without lengthy setup processes.</span>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-layer-group"></i>
                        <div>
                            <strong class="d-block mb-1">Secured by Default</strong>
                            <span class="text-secondary">Each site has isolated environment and SSL Certificate by default.</span>
                        </div>
                    </li>
                </ul>
                
                <div class="mt-5 d-none d-lg-flex gap-3">
                    <a href="#faq" class="btn btn-outline-secondary btn-lg px-4 py-3 rounded-pill">
                        Learn More
                    </a>
                </div>
            </div>
            
            <div class="col-lg-6" id="create-site">
                <div class="form-container">
                    <div class="text-center mb-4">
                        <div class="badge bg-accent-color text-white px-3 py-2 rounded-pill mb-3">No Credit Card Required</div>
                        <h3 class="fw-bold mb-1">Create WordPress with one-click!</h3>
                        <p class="text-secondary">Ready in 30 seconds • Auto-deletes in {{ $systemSettings->get('default_deletion_time', 24) }} Hours</p>
                    </div>
                    
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 bg-success bg-opacity-10" role="alert">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-check-circle text-success fs-4"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-medium">{{ session('success') }}</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error') || $errors->any())
                        <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 bg-danger bg-opacity-10" role="alert">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-exclamation-circle text-danger fs-4"></i>
                                </div>
                                <div>
                                    @if (session('error'))
                                        <p class="mb-0 fw-medium">{{ session('error') }}</p>
                                    @endif
                                    @if ($errors->any())
                                        <ul class="mb-0 ps-3">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @php
                        $allowSiteCreation = $systemSettings->get('allow_site_creation', '1');
                        $domain = $systemSettings->get('domain', 'example.com');
                    @endphp
                    
                    @if($allowSiteCreation === '1' || $allowSiteCreation === null)
                        <form action="{{ route('home.sites.store') }}" method="POST" class="mb-0" id="create-site-form">
                            @csrf
                            <div id="form-submission-status" class="alert d-none mb-3">
                                <!-- This will show submission status messages -->
                            </div>
                            <div class="mb-4">
                                <label for="subdomain" class="form-label fw-medium mb-2">Choose Your Subdomain</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text border-end-0 bg-white text-muted">
                                        <i class="fas fa-globe"></i>
                                    </span>
                                    <input type="text" class="form-control form-control-lg border-start-0 ps-0 @error('subdomain') is-invalid @enderror" 
                                        id="subdomain" name="subdomain" placeholder="yoursite" value="{{ old('subdomain') }}">
                                    <span class="input-group-text">.{{ $domain }}</span>
                                </div>
                                <div class="form-text mt-2">Only lowercase letters, numbers and hyphens allowed.</div>
                                @error('subdomain')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="reminder" name="reminder" value="on" 
                                        {{ old('reminder') ? 'checked' : '' }} onchange="toggleEmailField()">
                                    <label class="form-check-label fw-medium" for="reminder">
                                        Send me site info and remind me before delete
                                    </label>
                                </div>
                                
                                <div id="emailFieldContainer" style="{{ old('reminder') ? '' : 'display: none;' }}">
                                    <label for="email" class="form-label fw-medium mb-2">Email Address</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text border-end-0 bg-white text-muted">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control form-control-lg border-start-0 ps-0 @error('email') is-invalid @enderror" 
                                            id="email" name="email" placeholder="your@email.com" value="{{ old('email') }}">
                                    </div>
                                    <div class="form-text mt-2">We'll send login details and a reminder before your site is deleted.</div>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <script>
                                function toggleEmailField() {
                                    const reminder = document.getElementById('reminder');
                                    const emailFieldContainer = document.getElementById('emailFieldContainer');
                                    
                                    if (reminder.checked) {
                                        emailFieldContainer.style.display = 'block';
                                    } else {
                                        emailFieldContainer.style.display = 'none';
                                    }
                                }
                            </script>
                            
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input @error('terms') is-invalid @enderror" 
                                        type="checkbox" id="terms" name="terms" value="1" {{ old('terms') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="terms">
                                        I agree to the <a href="{{ route('legal.terms') }}" class="text-decoration-none text-primary" target="_blank">Terms of Service</a> and <a href="{{ route('legal.privacy') }}" class="text-decoration-none text-primary" target="_blank">Privacy Policy</a>
                                    </label>
                                    @error('terms')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg w-100 py-3 rounded-pill" id="create-site-btn">
                                <span class="fw-semibold" id="btn-text">Create Throwaway Site</span> 
                                <i class="fas fa-rocket ms-2" id="btn-icon"></i>
                                <span class="spinner-border spinner-border-sm ms-2 d-none" id="btn-spinner" role="status" aria-hidden="true"></span>
                            </button>
                        </form>
                    @else
                        <div class="alert alert-info border-0 rounded-3 bg-info bg-opacity-10 text-center p-4" role="alert">
                            <div class="mb-3">
                                <i class="fas fa-info-circle text-info fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-2">Site Creation Temporarily Disabled</h4>
                            <p class="mb-0">Site creation from the homepage is currently disabled by the administrator. Please check back later or contact the site administrator for assistance.</p>
                        </div>
                    @endif
                    
                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <span class="text-success me-2"><i class="fas fa-shield-alt"></i></span>
                        <span class="text-secondary small">Secure, encrypted connection</span>
                    </div>
                    
                    <!-- AJAX Form Submission Script -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const form = document.getElementById('create-site-form');
                            const btn = document.getElementById('create-site-btn');
                            const btnText = document.getElementById('btn-text');
                            const btnIcon = document.getElementById('btn-icon');
                            const btnSpinner = document.getElementById('btn-spinner');
                            const statusDiv = document.getElementById('form-submission-status');
                            
                            // Only attach listener if we found the form
                            if (form) {
                                form.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    
                                    // Show loading state
                                    btn.disabled = true;
                                    btnText.textContent = 'Creating your site...';
                                    btnIcon.classList.add('d-none');
                                    btnSpinner.classList.remove('d-none');
                                    
                                    // Hide any previous status messages
                                    statusDiv.classList.add('d-none');
                                    
                                    // Create FormData object
                                    const formData = new FormData(form);
                                    
                                    // Send AJAX request
                                    fetch(form.action, {
                                        method: 'POST',
                                        body: formData,
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest'
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            // Success - Show success message
                                            statusDiv.classList.remove('d-none', 'alert-danger');
                                            statusDiv.classList.add('alert-success');
                                            statusDiv.innerHTML = '<div class="d-flex align-items-center">' +
                                                '<i class="fas fa-check-circle text-success me-2"></i>' +
                                                '<div>' + data.message + '</div>' +
                                                '</div>';
                                            
                                            // Reset form
                                            form.reset();
                                            
                                            // Reset button after a short delay (let user see "created successfully")
                                            setTimeout(() => {
                                                btn.disabled = false;
                                                btnText.textContent = 'Create Throwaway Site';
                                                btnIcon.classList.remove('d-none');
                                                btnSpinner.classList.add('d-none');
                                                
                                                // Redirect to the site
                                                window.location.href = data.redirect;
                                            }, 800);
                                        } else {
                                            // Handle validation errors
                                            statusDiv.classList.remove('d-none', 'alert-success');
                                            statusDiv.classList.add('alert-danger');
                                            
                                            let errorHtml = '<div class="d-flex">' +
                                                '<i class="fas fa-exclamation-circle text-danger me-2 mt-1"></i>' +
                                                '<div>';
                                            
                                            if (data.message) {
                                                errorHtml += '<p class="mb-1">' + data.message + '</p>';
                                            }
                                            
                                            if (data.errors) {
                                                errorHtml += '<ul class="mb-0 ps-3">';
                                                for (const field in data.errors) {
                                                    data.errors[field].forEach(error => {
                                                        errorHtml += '<li>' + error + '</li>';
                                                    });
                                                }
                                                errorHtml += '</ul>';
                                            }
                                            
                                            errorHtml += '</div></div>';
                                            statusDiv.innerHTML = errorHtml;
                                            
                                            // Reset button
                                            btn.disabled = false;
                                            btnText.textContent = 'Create Throwaway Site';
                                            btnIcon.classList.remove('d-none');
                                            btnSpinner.classList.add('d-none');
                                        }
                                    })
                                    .catch(error => {
                                        // Handle unexpected errors
                                        statusDiv.classList.remove('d-none', 'alert-success');
                                        statusDiv.classList.add('alert-danger');
                                        statusDiv.innerHTML = '<div class="d-flex align-items-center">' +
                                            '<i class="fas fa-exclamation-triangle text-danger me-2"></i>' +
                                            '<div>An unexpected error occurred. Please try again.</div>' +
                                            '</div>';
                                        
                                        // Reset button
                                        btn.disabled = false;
                                        btnText.textContent = 'Create Throwaway Site';
                                        btnIcon.classList.remove('d-none');
                                        btnSpinner.classList.add('d-none');
                                        
                                        console.error('Error:', error);
                                    });
                                });
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Open Source Section -->
<section style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.03) 0%, rgba(14, 165, 233, 0.03) 100%); padding-top: 100px; padding-bottom: 100px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 pe-lg-5 mb-5 mb-lg-0">
                <span class="badge bg-primary bg-opacity-10 text-primary fw-medium px-3 py-2 mb-4">
                    <i class="fab fa-github me-1"></i> Open Source
                </span>
                <h2 class="fw-bold mb-4">Host Your Own<br>Throwaway Sites Platform</h2>
                <p class="text-secondary mb-4 lead">
                    Sandbox is completely open-source. Deploy on your own infrastructure with full control over domains, timeouts, and configurations.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="https://github.com/adarshsojitra/sandbox" target="_blank" class="btn btn-dark px-4 py-2 rounded-pill">
                        <i class="fab fa-github me-2"></i> View Source
                    </a>
                    <a href="https://github.com/adarshsojitra/sandbox/blob/main/README.md" target="_blank" class="btn btn-primary px-4 py-2 rounded-pill">
                        <i class="fas fa-cloud-upload-alt me-2"></i> Deploy Your Own
                    </a>
                </div>
                <div class="mt-4 pt-2">
                    <span class="badge rounded-pill px-3 py-2 position-relative" 
                          style="background: linear-gradient(135deg, #607d8b15, #78909c15); border: 1px solid rgba(96, 125, 139, 0.1);"
                          data-bs-custom-class="modern-tooltip"
                          data-bs-toggle="tooltip" 
                          data-bs-placement="bottom" 
                          data-bs-html="true"
                          title="<div class='p-3 rounded'><div class='mb-2 fw-bold fs-6 border-bottom pb-2'>MIT License</div><div style='font-size: 0.9rem; line-height: 1.5;'>Permission is hereby granted, free of charge, to any person obtaining a copy of this software to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software without restriction.<br><br>The software is provided 'as is' without warranty of any kind.<br><br><span class='fst-italic'>In simple terms: You can do whatever you want with this code, commercially or non-commercially, but you must include the original license and copyright notice.</span></div></div>">
                        <span class="fw-medium" style="color: #455a64;">MIT Licensed</span>
                        <i class="fas fa-info-circle text-primary ms-2 opacity-75" style="font-size: 0.85em;"></i>
                    </span>
                </div>
                
                <!-- Initialize tooltips with custom styling -->
                <style>
                    .modern-tooltip .tooltip-inner {
                        max-width: 350px;
                        background-color: white;
                        color: #333;
                        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
                        border-radius: 8px;
                        text-align: left;
                        padding: 0;
                    }
                    .modern-tooltip .tooltip-arrow::before {
                        border-bottom-color: white;
                    }
                </style>
                
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                            return new bootstrap.Tooltip(tooltipTriggerEl, {
                                container: 'body',
                                boundary: document.querySelector('body'),
                                trigger: 'hover'
                            });
                        });
                    });
                </script>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <div class="bg-white rounded-4 shadow-sm p-4 mb-4" style="border-left: 4px solid var(--primary-color);">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 text-primary p-2 rounded me-3">
                                <i class="fas fa-server"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0">Self-Hosted Solution</h5>
                            </div>
                        </div>
                        <p class="text-secondary mb-0">Host the throwaway sites platform on your own infrastructure for complete control and privacy.</p>
                    </div>
                    
                    <div class="bg-white rounded-4 shadow-sm p-4 mb-4" style="border-left: 4px solid var(--accent-color); margin-left: 20px;">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-accent-color bg-opacity-10 text-accent-color p-2 rounded me-3">
                                <i class="fas fa-code-branch"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0">Fully Customizable</h5>
                            </div>
                        </div>
                        <p class="text-secondary mb-0">Modify the platform to fit your specific needs or integrate with your existing systems.</p>
                    </div>
                    
                    <div class="bg-white rounded-4 shadow-sm p-4" style="border-left: 4px solid var(--secondary-color); margin-left: 40px;">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-secondary bg-opacity-10 text-secondary p-2 rounded me-3">
                                <i class="fas fa-sliders-h"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0">Custom Configuration</h5>
                            </div>
                        </div>
                        <p class="text-secondary mb-0">Set your own domain, custom timeouts for site deletion, and tailor the platform to your specific needs.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section" id="faq">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <span class="badge bg-primary bg-opacity-10 text-primary fw-medium px-3 py-2 mb-3">
                    FAQ
                </span>
                <h2 class="fw-bold mb-3">Frequently Asked Questions</h2>
                <p class="lead text-secondary">Everything you need to know about our instant WordPress staging service.</p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <!-- FAQ Item 1 -->
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="fas fa-bolt text-primary me-3 opacity-75"></i>
                                How quickly will my WordPress site be ready?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Your WordPress site will be deployed and ready to use in approximately 30 seconds. Once created, you'll be automatically redirected to your site's information page where you can find all login credentials and connection details. If you provided an email address, you'll also receive these details via email.
                            </div>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 2 -->
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="fas fa-clock text-primary me-3 opacity-75"></i>
                                How long will my site remain available?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Each site automatically deletes after {{ $systemSettings->get('default_deletion_time', 24) }} hours. This is configurable by system administrators to provide flexibility based on your needs. The exact time remaining is always displayed on your site's information page, and if you provided an email address, you'll receive a reminder before deletion.
                            </div>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 3 -->
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <i class="fas fa-puzzle-piece text-primary me-3 opacity-75"></i>
                                What access do I get to the WordPress site?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You receive full administrator access to your WordPress installation. All credentials (WordPress admin username and password, database details, etc.) are provided on your site's information page. You can install plugins, themes, and make any configuration changes just like on any standard WordPress installation.
                            </div>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 4 -->
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <i class="fas fa-shield-alt text-primary me-3 opacity-75"></i>
                                Is my throwaway site secure?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes! Each site is created with SSL enabled by default, ensuring that all connections are encrypted. Sites are also isolated from each other in their own environments. Your site's information page contains all credentials and is accessible via a unique, non-guessable URL that you can share with team members or clients as needed.
                            </div>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 5 -->
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                <i class="fas fa-share-alt text-primary me-3 opacity-75"></i>
                                Can I share my site with others?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Absolutely! All sites created from the homepage are automatically public. You can share both the WordPress site URL and the site information page with clients, team members, or anyone who needs access. The site information page provides all the necessary login credentials for WordPress admin access.
                            </div>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 6 -->
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                <i class="fas fa-database text-primary me-3 opacity-75"></i>
                                Can I access the database directly?
                            </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, all database credentials are provided on your site's information page. This includes the database name, username, password, and host. You can use these credentials to connect to the database using tools like phpMyAdmin or MySQL clients to perform direct database operations if needed.
                            </div>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 7 -->
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingSeven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                <i class="fas fa-envelope text-primary me-3 opacity-75"></i>
                                Why should I provide my email address?
                            </button>
                        </h2>
                        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Providing your email is optional but recommended. If you choose to share your email, we'll send you the WordPress login credentials and site information immediately after creation. Additionally, you'll receive a reminder before your site is scheduled for automatic deletion, giving you time to save any important work.
                            </div>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 8 -->
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingEight">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                <i class="fas fa-code-branch text-primary me-3 opacity-75"></i>
                                Can I host this platform on my own server?
                            </button>
                        </h2>
                        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes! This platform is completely open-source and designed to be self-hosted. You can deploy it on your own infrastructure with full control over domains, timeouts, and configurations. Check out our GitHub repository for installation instructions, or use our one-click deploy option to get started quickly.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

@endsection