@extends('layouts.app')

@section('title', 'Post List')

@section('content')
<div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <div class="w-full bg-white p-6 rounded-lg shadow-lg">

        <!-- Notification show here -->
        @if (auth()->user()->role === 'admin')
            <div id="notification"></div>
        @endif

        <div class="relative overflow-x-auto">
            <div class="flex justify-between mb-2">
                <h2 class="py-2 font-bold uppercase">Post</h2>

                <button onclick="openModal()" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Create
                </button>
            </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase dark:bg-gray-600 dark:text-gray-300 text-center">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Body
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <tr class="border text-black" data-id="{{ $post->id }}">
                                <td class="px-6 py-4">{{ $post->title }}</td>
                                <td class="px-6 py-4">{{ $post->body }}</td>
                                <td class="px-6 py-4 space-x-2">
                                    <button onclick="openModal({{ $post->id }})" class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Edit</button>
                                    <button onclick="openDeleteModal({{ $post->id }})" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-red-500 font-medium">No posts found!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--------------------------Include post create / update modal-------------------------->
@include('posts.create_update_modal')

<!--------------------------Include post delete modal-------------------------->
@include('posts.delete_modal')

<!--------------------------Include toast component-------------------------->
@include('layouts.toast')

<!--------------------------Post create / update js start-------------------------->
<script>
    function openModal(id = null) {
        if (!id) {
            $('#create-update-modal').removeClass('hidden').addClass('flex');
            $('#post-form')[0].reset();
            $('#modal-title').text('Create Post');
            $('#submit-btn').text('Submit');
            $('#post-id').val('');
        } else {
            $.get('/posts/' + id + '/edit', function(post) {
                $('#post-id').val(post.id);
                $('#title').val(post.title);
                $('#body').val(post.body);
                $('#modal-title').text('Edit Post');
                $('#submit-btn').text('Update');
                $('#create-update-modal').removeClass('hidden').addClass('flex');
            });
        }
    }

    function closeModal() {
        $('#create-update-modal').removeClass('flex').addClass('hidden');
    }

    $('#post-form').submit(function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        var postId = $('#post-id').val();
        var url = postId ? '/posts/' + postId : '/posts';
        var method = postId ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: formData,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {
                closeModal();

                if (!postId) {
                    var newPostRow = `<tr class="border text-black" data-id="${response.data.id}">
                                        <td class="px-6 py-4">${response.data.title}</td>
                                        <td class="px-6 py-4">${response.data.body}</td>
                                        <td class="px-6 py-4 space-x-2">
                                            <button onclick="openModal(${response.data.id})" class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Edit</button>
                                            <button onclick="openDeleteModal(${response.data.id})" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</button>
                                        </td>
                                    </tr>`;
                    
                    $('table tbody').prepend(newPostRow);

                    // toast message
                    showToast('success', 'Post created successfully!');
                } else {
                    var postRow = $('tr[data-id="' + response.data.id + '"]');

                    postRow.find('td').eq(0).text(response.data.title);
                    postRow.find('td').eq(1).text(response.data. body);

                    // toast message
                    showToast('success', 'Post updated successfully!');
                }
            },
            error: function(error) {
                alert("Something went wrong!");
            }
        });
    });
</script>
<!--------------------------Post create / update js end-------------------------->

<!--------------------------Post delete js start-------------------------->
<script>
    function openDeleteModal(id) {
        $('#delete-post-id').val(id);
        $('#delete-modal').removeClass('hidden').addClass('flex');
    }

    function closeDeleteModal() {
        $('#delete-modal').removeClass('flex').addClass('hidden');
    }

    function deletePost() {
        var id = $('#delete-post-id').val();

        $.ajax({
            url: '/posts/' + id,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('tr[data-id="' + id + '"]').remove();
                $('#delete-modal').addClass('hidden');

                showToast('success', 'Post deleted successfully!');
            },
            error: function(xhr) {
                alert('Something went wrong while deleting the post!');
            }
        });
    }
</script>
<!--------------------------Post delete js end-------------------------->

<!--------------------------Echo post notification start-------------------------->
<script type="module">
    window.Echo.connector.socket.on('connect', () => {
        console.log('%cConnected to Socket.IO server', 'color: green; font-weight: bold;');
    });

    window.Echo.connector.socket.on('disconnect', () => {
        console.log('%cDisconnected from Socket.IO server', 'color: red; font-weight: bold;');
    });

    window.Echo.channel('posts-channel')
        .listen('.posts-create', (data) => {
            console.log('%cNew Post Created:', 'color: blue; font-weight: bold;', data);

            var d1 = document.getElementById('notification');
            d1.insertAdjacentHTML('beforeend', `
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200" role="alert">
                    <svg aria-hidden="true" class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M18 10c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8 8-8 8 3.582 8 8zM8.293 12.707a1 1 0 011.414 0l3-3a1 1 0 10-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium">${data.message}</span>
                </div>
            `);
        });
</script>
<!--------------------------Echo post notification end-------------------------->
@endsection