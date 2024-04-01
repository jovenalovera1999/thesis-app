@if (auth()->check())    
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <!-- Position it: -->
        <!-- - `.toast-container` for spacing between toasts -->
        <!-- - `top-0` & `end-0` to position the toasts in the upper right corner -->
        <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
        <div class="toast-container top-0 end-0 p-3">

            <!-- Then put toasts within -->
            <div class="toast bg-success text-white" id="logged_in_toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body text-center">
                    Welcome {{ auth()->user()->full_name }}.
                </div>
            </div>
        </div>
    </div>
@endif

@if (session()->has('message_success'))
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <!-- Position it: -->
        <!-- - `.toast-container` for spacing between toasts -->
        <!-- - `top-0` & `end-0` to position the toasts in the upper right corner -->
        <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
        <div class="toast-container top-0 end-0 p-3">
    
            <!-- Then put toasts within -->
            <div class="toast bg-success text-white" id="toast_success" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="toast-body text-center">
                    {{ session('message_success') }}
                </div>
            </div>
        </div>
    </div>
@endif