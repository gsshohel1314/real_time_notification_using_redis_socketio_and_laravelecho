<div id="toast" class="hidden flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-500 dark:bg-white" role="alert" style="position: fixed; bottom: 1rem; right: 1rem; z-index: 9999;">
    <!-- Default Icon when type is not matched -->
    <div id="default-icon" class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-gray-500 bg-gray-200 rounded-lg">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 0a10 10 0 1 0 10 10A10.01 10.01 0 0 0 10 0ZM5 10a1 1 0 0 1 1-1h8a1 1 0 0 1 0 2H6a1 1 0 0 1-1-1Z"/>
        </svg>
    </div>

    <!-- Success Icon -->
    <div id="success-icon" class="hidden inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-200 rounded-lg">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
    </div>

    <!-- Error Icon -->
    <div id="error-icon" class="hidden inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-200 rounded-lg">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
        </svg>
    </div>

    <!-- Warning Icon -->
    <div id="warning-icon" class="hidden inline-flex items-center justify-center shrink-0 w-8 h-8 text-orange-500 bg-orange-200 rounded-lg">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
        </svg>
    </div>

    <div class="ms-3 text-sm font-semibold" id="toast-message">Default</div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-full focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>

<script>
    function showToast(type, message) {
        // Hide all icons first
        document.getElementById('success-icon').classList.add('hidden');
        document.getElementById('error-icon').classList.add('hidden');
        document.getElementById('warning-icon').classList.add('hidden');
        document.getElementById('default-icon').classList.add('hidden');
        
        // Set the message dynamically
        document.getElementById('toast-message').innerText = message;

        // Show the correct icon based on the type
        if (type === 'success') {
            document.getElementById('success-icon').classList.remove('hidden');
        } else if (type === 'error') {
            document.getElementById('error-icon').classList.remove('hidden');
        } else if (type === 'warning') {
            document.getElementById('warning-icon').classList.remove('hidden');
        } else {
            document.getElementById('default-icon').classList.remove('hidden');
        }

        // Show the toast message
        document.getElementById('toast').classList.remove('hidden');
        
        // Hide the toast after 3 seconds
        setTimeout(function() {
            document.getElementById('toast').classList.add('hidden');
        }, 3000);
    }
</script>