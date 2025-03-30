@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="mb-4 fw-bold">Terms of Service</h1>
            
            <div class="bg-light p-4 rounded-3 mb-4">
                <p class="text-muted mb-0"><strong>Last Updated:</strong> March 30, 2025</p>
            </div>

            <div class="mb-5">
                <p class="lead">Please read these Terms of Service ("Terms") carefully before using the Throwaway WordPress Sites service ("Service").</p>
                <p>By accessing or using the Service, you agree to be bound by these Terms. If you disagree with any part of the terms, then you may not access the Service.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">1. Service Description</h2>
                <p>Throwaway WordPress Sites provides temporary WordPress sites that are automatically deleted after a specified period. These sites are intended for testing, demonstrations, and temporary use cases.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">2. Account Terms</h2>
                <p>When you create a temporary site on our platform, you may provide an email address for notifications. You are responsible for maintaining the security of your site credentials and are fully responsible for all activities that occur under your account.</p>
                <p>You must immediately notify us of any unauthorized use of your account or any other breach of security.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">3. Acceptable Use</h2>
                <p>Your use of the Service must not violate any applicable laws, including copyright or trademark laws, export control laws, or other laws in your jurisdiction. You are responsible for making sure that your use of the Service is in compliance with laws and any applicable regulations.</p>
                <p><strong>You agree not to use the Service for:</strong></p>
                <ul>
                    <li>Illegal activities or to promote illegal activities</li>
                    <li>Distributing malware or other harmful code</li>
                    <li>Phishing, spamming, or any form of unsolicited communication</li>
                    <li>Impersonating others or providing inaccurate information</li>
                    <li>Activities that interfere with or disrupt the Service or servers</li>
                    <li>Storing or transmitting material that infringes on the rights of others</li>
                </ul>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">4. Content Ownership</h2>
                <p>You retain ownership of any intellectual property rights that you hold in content you upload to your temporary site. By uploading content, you grant us a worldwide, royalty-free license to use, reproduce, modify, and distribute that content for the purpose of providing the Service.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">5. Service Termination</h2>
                <p>We may terminate or suspend your access to the Service immediately, without prior notice or liability, for any reason, including, without limitation, if you breach the Terms.</p>
                <p>All temporary sites are scheduled for automatic deletion after a specified period (as indicated during site creation). We make no guarantees about the availability of your site beyond the specified period.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">6. Limitation of Liability</h2>
                <p>In no event shall we be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from your access to or use of or inability to access or use the Service.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">7. Disclaimer</h2>
                <p>Your use of the Service is at your sole risk. The Service is provided on an "AS IS" and "AS AVAILABLE" basis. The Service is provided without warranties of any kind, whether express or implied, including, but not limited to, implied warranties of merchantability, fitness for a particular purpose, non-infringement or course of performance.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">8. Changes to Terms</h2>
                <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will try to provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">9. Contact Us</h2>
                <p>If you have any questions about these Terms, please contact us at support@example.com.</p>
            </div>

            <div class="text-center mt-5 pt-3">
                <a href="{{ route('home') }}" class="btn btn-outline-primary px-4 py-2">Return to Homepage</a>
            </div>
        </div>
    </div>
</div>
@endsection