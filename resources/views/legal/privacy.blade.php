@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="mb-4 fw-bold">Privacy Policy</h1>
            
            <div class="bg-light p-4 rounded-3 mb-4">
                <p class="text-muted mb-0"><strong>Last Updated:</strong> March 30, 2025</p>
            </div>

            <div class="mb-5">
                <p class="lead">This Privacy Policy describes how your personal information is collected, used, and shared when you use our Throwaway WordPress Sites service ("Service").</p>
                <p>We respect your privacy and are committed to protecting your personal data. Please read this privacy policy carefully to understand our policies and practices regarding your personal data.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">1. Information We Collect</h2>
                <p>When you use our Service, we may collect the following types of information:</p>
                <ul>
                    <li><strong>Usage Data:</strong> We may collect information on how you access and use the Service, including your IP address, browser type, pages viewed, time spent on pages, and other usage data.</li>
                    <li><strong>Email Address:</strong> If you opt to receive notifications about your temporary site, we collect your email address.</li>
                    <li><strong>Site Content:</strong> Any content you upload to your temporary site is stored on our servers until the site is deleted.</li>
                </ul>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">2. How We Use Your Information</h2>
                <p>We use the information we collect to:</p>
                <ul>
                    <li>Provide, maintain, and improve our Service</li>
                    <li>Send you notifications about your temporary site if you requested them</li>
                    <li>Communicate with you about service-related issues</li>
                    <li>Monitor and analyze usage patterns and trends</li>
                    <li>Protect against and prevent fraud, unauthorized transactions, and other illegal activities</li>
                </ul>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">3. Data Retention</h2>
                <p>Temporary sites and all associated data are automatically deleted after the specified period (as indicated during site creation). After deletion, we may retain basic analytics data but no personally identifiable information associated with your site.</p>
                <p>If you provided an email address for notifications, we retain this information only as long as necessary to provide the Service.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">4. Sharing Your Information</h2>
                <p>We do not sell, trade, or otherwise transfer your personally identifiable information to third parties. This does not include trusted third parties who assist us in operating our website, conducting our business, or servicing you, so long as those parties agree to keep this information confidential.</p>
                <p>We may share your information in the following circumstances:</p>
                <ul>
                    <li>With service providers who perform services on our behalf</li>
                    <li>To comply with legal obligations</li>
                    <li>To protect and defend our rights and property</li>
                    <li>With your consent or at your direction</li>
                </ul>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">5. Cookies and Tracking Technologies</h2>
                <p>We use cookies and similar tracking technologies to track activity on our Service and hold certain information. Cookies are files with small amounts of data which may include an anonymous unique identifier.</p>
                <p>You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">6. Security</h2>
                <p>We value your trust in providing us your personal information, thus we strive to use commercially acceptable means of protecting it. However, no method of transmission over the internet or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">7. Children's Privacy</h2>
                <p>Our Service does not address anyone under the age of 13. We do not knowingly collect personally identifiable information from children under 13. If you are a parent or guardian and you are aware that your child has provided us with personal data, please contact us.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">8. Your Rights</h2>
                <p>Depending on your location, you may have certain rights regarding your personal information, such as:</p>
                <ul>
                    <li>The right to access the personal information we have about you</li>
                    <li>The right to request that we correct or update your personal information</li>
                    <li>The right to request that we delete your personal information</li>
                    <li>The right to object to processing of your personal information</li>
                    <li>The right to data portability</li>
                </ul>
                <p>To exercise any of these rights, please contact us using the information provided below.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">9. Changes to This Privacy Policy</h2>
                <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last Updated" date at the top.</p>
                <p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">10. Contact Us</h2>
                <p>If you have any questions about this Privacy Policy, please contact us at privacy@example.com.</p>
            </div>

            <div class="text-center mt-5 pt-3">
                <a href="{{ route('home') }}" class="btn btn-outline-primary px-4 py-2">Return to Homepage</a>
            </div>
        </div>
    </div>
</div>
@endsection