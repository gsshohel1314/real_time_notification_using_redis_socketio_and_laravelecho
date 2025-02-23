<div id="delete-modal" tabindex="-1" class="hidden fixed inset-0 z-50 justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
    <input type="hidden" id="delete-post-id">
    <div class="relative p-4 w-full max-w-md bg-white rounded-lg shadow">
        <div class="p-4 text-center">
            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this post?</h3>
            <button onclick="deletePost()" class="text-white bg-red-500 hover:bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5">
                Yes, I'm sure
            </button>
            <button onclick="closeDeleteModal()" class="text-white bg-blue-500 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5">
                No, cancel
            </button>
        </div>
    </div>
</div>