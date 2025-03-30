@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="mb-4 fw-bold">Disclaimer</h1>
            
            <div class="bg-light p-4 rounded-3 mb-4">
                <p class="text-muted mb-0"><strong>Last Updated:</strong> March 30, 2025</p>
            </div>

            <div class="mb-5">
                <p class="lead">This disclaimer ("Disclaimer") sets forth the general guidelines, disclosures, and terms of your use of the Throwaway WordPress Sites service ("Service", "we", "us" or "our").</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">1. Representation</h2>
                <p>Any views or information found on our Service are not intended to offend, but if you find anything offensive or inaccurate, please contact us immediately so we can address it.</p>
                <p>The information provided by our Service is for general informational purposes only. All information on the Service is provided in good faith, however we make no representation or warranty of any kind, express or implied, regarding the accuracy, adequacy, validity, reliability, availability, or completeness of any information on the Service.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">2. External Links Disclaimer</h2>
                <p>The Service may contain links to external websites that are not provided or maintained by or in any way affiliated with us. Please note that we do not guarantee the accuracy, relevance, timeliness, or completeness of any information on these external websites.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">3. Errors and Omissions Disclaimer</h2>
                <p>The information given by the Service is for general guidance on matters of interest. Even if the Service takes every precaution to ensure that the content is both current and accurate, errors can occur. Plus, given the changing nature of laws, rules and regulations, there may be delays, omissions or inaccuracies in the information contained on the Service.</p>
                <p>We are not responsible for any errors or omissions, or for the results obtained from the use of this information.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">4. Fair Use Disclaimer</h2>
                <p>The Service may contain copyrighted material the use of which has not always been specifically authorized by the copyright owner. We are making such material available in our efforts to advance understanding of environmental, political, human rights, economic, democracy, scientific, and social justice issues, etc. We believe this constitutes a 'fair use' of any such copyrighted material as provided for in section 107 of the US Copyright Law.</p>
                <p>If you wish to use copyrighted material from the Service for your own purposes that go beyond fair use, you must obtain permission from the copyright owner.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">5. No Responsibility Disclaimer</h2>
                <p>The information on the Service is provided with the understanding that we are not herein engaged in rendering legal, accounting, tax, or other professional advice and services. As such, it should not be used as a substitute for consultation with professional accounting, tax, legal or other competent advisers.</p>
                <p>In no event shall we or our suppliers be liable for any special, incidental, indirect, or consequential damages whatsoever arising out of or in connection with your access or use or inability to access or use the Service.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">6. "Use at Your Own Risk" Disclaimer</h2>
                <p>All information in the Service is provided "as is", with no guarantee of completeness, accuracy, timeliness or of the results obtained from the use of this information, and without warranty of any kind, express or implied, including, but not limited to warranties of performance, merchantability, and fitness for a particular purpose.</p>
                <p>We will not be liable to you or anyone else for any decision made or action taken in reliance on the information given by the Service or for any consequential, special or similar damages, even if advised of the possibility of such damages.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">7. Temporary Website Disclaimer</h2>
                <p>The temporary websites created through our Service are intended for testing, demonstration, and other short-term purposes. We make no guarantees about the availability, security, or performance of these temporary sites beyond their specified expiration period.</p>
                <p>Users are solely responsible for all content placed on their temporary sites and for ensuring that such content complies with all applicable laws and regulations. We assume no responsibility for user-generated content on temporary sites created through our Service.</p>
            </div>

            <div class="mb-5">
                <h2 class="h4 mb-3">8. Contact Us</h2>
                <p>If you have any questions about this Disclaimer, please contact us at disclaimer@example.com.</p>
            </div>

            <div class="text-center mt-5 pt-3">
                <a href="{{ route('home') }}" class="btn btn-outline-primary px-4 py-2">Return to Homepage</a>
            </div>
        </div>
    </div>
</div>
@endsection