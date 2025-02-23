<div id="create-update-modal" class="hidden fixed top-0 left-0 right-0 z-50 items-center justify-center w-full h-full bg-gray-900 bg-opacity-50">
    <div class="bg-white rounded p-6 w-1/4">
        <h3 class="text-lg font-semibold" id="modal-title">Create Post</h3>
        <p class="mb-4">Enter your post details here.</p>
  
        <form id="post-form">
            <input type="hidden" id="post-id" name="post_id">
  
            <label for="title" class="block mb-2 text-sm font-medium">Title</label>
            <input type="text" name="title" id="title" class="w-full p-2 border border-gray-300 rounded mb-4">
  
            <label for="body" class="block mb-2 text-sm font-medium">Body</label>
            <textarea id="body" name="body" rows="4" class="w-full p-2 border border-gray-300 rounded mb-4"></textarea>
  
            <button type="submit" id="submit-btn" class="text-white bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded-lg">Submit</button>
            <button type="button" onclick="closeModal()" class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg ml-2">Close</button>
        </form>
    </div>
</div>