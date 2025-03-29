@extends('layouts.main')

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
                            <span class="text-secondary">Sites auto-delete after 24 hours or delete manually anytime.</span>
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
                        <p class="text-secondary">Ready in 30 seconds • Auto-deletes in 24 Hours</p>
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
                    
                    <form action="#" method="POST" class="mb-0">
                        @csrf
                        <div class="mb-4">
                            <label for="subdomain" class="form-label fw-medium mb-2">Choose Your Subdomain</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text border-end-0 bg-white text-muted">
                                    <i class="fas fa-globe"></i>
                                </span>
                                <input type="text" class="form-control form-control-lg border-start-0 ps-0 @error('subdomain') is-invalid @enderror" 
                                       id="subdomain" name="subdomain" placeholder="yoursite" value="{{ old('subdomain') }}">
                                <span class="input-group-text">.serveravatar.com</span>
                            </div>
                            <div class="form-text mt-2">Only lowercase letters, numbers and hyphens allowed.</div>
                            @error('subdomain')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="send_email" name="send_email" value="1" 
                                       {{ old('send_email') ? 'checked' : '' }} onchange="toggleEmailField()">
                                <label class="form-check-label fw-medium" for="send_email">
                                    Send me site info and remind me before delete
                                </label>
                            </div>
                            
                            <div id="emailFieldContainer" style="{{ old('send_email') ? '' : 'display: none;' }}">
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
                                const sendEmail = document.getElementById('send_email');
                                const emailFieldContainer = document.getElementById('emailFieldContainer');
                                
                                if (sendEmail.checked) {
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
                                    I agree to the <a href="#" class="text-decoration-none text-primary">Terms of Service</a> and <a href="#" class="text-decoration-none text-primary">Privacy Policy</a>
                                </label>
                                @error('terms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-primary btn-lg w-100 py-3 rounded-pill" 
                                onclick="alert('Coming soon! This functionality will be implemented later.')">
                            <span class="fw-semibold">Create Throwaway Site</span> <i class="fas fa-rocket ms-2"></i>
                        </button>
                    </form>
                    
                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <span class="text-success me-2"><i class="fas fa-shield-alt"></i></span>
                        <span class="text-secondary small">Secure, encrypted connection</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Open Source Section -->
<section class="py-5 my-5" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.03) 0%, rgba(14, 165, 233, 0.03) 100%);">
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
                    <a href="https://github.com/serveravatar/sandbox" target="_blank" class="btn btn-dark px-4 py-2 rounded-pill">
                        <i class="fab fa-github me-2"></i> View Source
                    </a>
                    <a href="https://serveravatar.com/deploy?repo=serveravatar/sandbox" target="_blank" class="btn btn-primary px-4 py-2 rounded-pill">
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
                                Your WordPress site will be deployed and ready to use in less than 60 seconds. You'll receive an email with your login credentials as soon as it's ready, allowing you to immediately start working on your site.
                            </div>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 2 -->
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="fas fa-globe text-primary me-3 opacity-75"></i>
                                Can I use my own domain instead of a subdomain?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes! After creating your site, you can connect your own domain through our dashboard. We'll handle all the DNS configuration for you automatically with our CloudFlare integration, making the process seamless and hassle-free.
                            </div>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 3 -->
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <i class="fas fa-layer-group text-primary me-3 opacity-75"></i>
                                Is there a limit to how many staging sites I can create?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Our free tier allows you to create up to 3 staging sites. For unlimited staging sites and additional features like automated backups, custom domains, and priority support, check out our premium plans starting at just $9.99/month.
                            </div>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 4 -->
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <i class="fas fa-puzzle-piece text-primary me-3 opacity-75"></i>
                                Can I install plugins and themes on my staging site?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Absolutely! You have full admin access to your WordPress installation. You can install any themes or plugins you need, just like on a regular WordPress site. This makes it perfect for testing new functionality before deploying to production.
                            </div>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 5 -->
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                <i class="fas fa-clock text-primary me-3 opacity-75"></i>
                                How long will my staging site be available?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Free staging sites remain active for 7 days without login activity. Premium plans offer extended inactivity periods and permanent staging environments. We'll send you email reminders before any site is scheduled for cleanup.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

@endsection