<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publications</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            background-color: #f9f9f9;
        }

        .post-card {
            max-width: 600px;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
            background-color: #fff;
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .post-timestamp {
            font-size: 0.8rem;
            color: #666;
        }

        .post-media {
            max-height: 400px;
            object-fit: cover;
        }

        .interaction-button {
            border: none;
            background: none;
            color: #555;
            transition: color 0.2s;
        }

        .interaction-button:hover {
            color: #0d6efd;
        }

        .comment-input {
            border-radius: 20px;
            background-color: #f8f9fa;
        }

        .comment-section {
            margin-top: 20px;
        }

        .btn-new-post {
            background-color: #0d6efd;
            color: #fff;
            border-radius: 30px;
            padding: 10px 20px;
            transition: background-color 0.3s, box-shadow 0.3s;
            border: none;
        }

        .btn-new-post:hover {
            background-color: #0b5ed7;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.4);
        }

        .modal-content {
            border-radius: 20px;
            overflow: hidden;
        }

        .modal-header {
            background-color: #0d6efd;
            color: #fff;
            border-bottom: none;
            padding: 20px;
        }

        .modal-body {
            padding: 30px;
        }

        .btn-close {
            color: #fff;
            font-size: 1.2rem;
            border: none;
            background: none;
            opacity: 1;
        }

        .btn-close:hover {
            color: #f8f9fa;
        }

        .btn-dark {
            background-color: #343a40;
            color: #fff;
            border-radius: 30px;
            padding: 10px 20px;
            transition: background-color 0.3s, box-shadow 0.3s;
            border: none;
        }

        .btn-dark:hover {
            background-color: #23272b;
            box-shadow: 0 4px 12px rgba(52, 58, 64, 0.4);
        }

        .upload-area {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            background: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s;
        }

        .upload-area:hover {
            border-color: #0d6efd;
            background: #f1f3f5;
        }

        .preview-media {
            max-width: 100%;
            max-height: 200px;
            margin-top: 10px;
            border-radius: 4px;
        }

        .post-actions {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .post-actions i {
            cursor: pointer;
            color: #555;
            margin-left: 10px;
            transition: color 0.2s;
        }

        .post-actions i:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <button type="button" class="btn btn-new-post" data-bs-toggle="modal" data-bs-target="#formModal">
        Ajouter une nouvelle publication
    </button>

    <!-- Displaying posts -->
    @foreach($posts as $post)
        <div class="post-card bg-white">
            <!-- Post Actions (Edit/Delete) -->
            <!-- Post Actions (Edit/Delete) -->
            <div class="post-actions">
                <i class="fas fa-edit" onclick="openEditModal({{ $post->id }})"></i>
                <i class="fas fa-trash-alt" onclick="confirmDelete({{ $post->id }})"></i>
            </div>


            <!-- Post Header -->
            <div class="p-3 border-bottom">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/placeholder-avatar.png') }}" alt="User Avatar" class="user-avatar me-2">
                    <div>
                        <h6 class="mb-0">{{ $post->user->name }}</h6>
                        <small class="post-timestamp">{{ $post->created_at }}</small>
                    </div>
                </div>
            </div>

            <!-- Post Media -->
            @if($post->media)
                @if($post->media->is_image)
                    <img src="{{ asset($post->media->path) }}" alt="Image" class="w-100 post-media">
                @else
                    <video class="w-100 post-media" controls>
                        <source src="{{ asset($post->media->path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            @else
                <!-- Fallback image when no media is available -->
                <img src="{{ asset('images/fallback-image.png') }}" alt="Fallback Image" class="w-100 post-media">
            @endif

            <!-- Post Content -->
            <div class="p-3">
                <h5 class="mb-2">{{ $post->title }}</h5>
                <p class="mb-3">{{ $post->body }}</p>
                <p><i class="fas fa-map-marker-alt"></i> {{ $post->location ?? 'Location not specified' }}</p>
            </div>

            <!-- Interaction Stats -->
            <div class="px-3 py-2 border-top border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-heart text-danger"></i>
                        <span class="ms-1">{{ $post->likes->count() }} J'aime</span>
                    </div>
                    <div>
                        <span>{{ $post->comments->count() }} Commentaires</span>
                    </div>
                </div>
            </div>

            <!-- Interaction Buttons -->
            <div class="d-flex justify-content-around p-2 border-bottom">
                <button class="interaction-button p-2 flex-grow-1">
                    <i class="fas fa-heart me-2"></i>Like
                </button>
                <button class="interaction-button p-2 flex-grow-1" data-bs-toggle="modal"
                        data-bs-target="#commentsModal-{{ $post->id }}">
                    <i class="fas fa-comment me-2"></i>Comment
                </button>
            </div>

            <!-- Comments Section -->
            <div class="p-3 comment-section">
                @foreach($post->comments as $comment)
                    <div class="d-flex mb-3">
                        <img src="{{ asset('images/placeholder-avatar.png') }}" alt="User Avatar"
                             class="user-avatar me-2" style="width: 32px; height: 32px;">
                        <div class="bg-light p-2 rounded flex-grow-1">
                            <h6 class="mb-1">{{ $comment->user->name }}</h6>
                            <p class="mb-0">{{ $comment->comment }}</p>
                        </div>
                    </div>
                @endforeach

                <!-- Comment Input -->
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/placeholder-avatar.png') }}" alt="Your Avatar" class="user-avatar me-2"
                         style="width: 32px; height: 32px;">
                    <input type="text" class="form-control comment-input" placeholder="Write a comment...">
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Modal for creating a new post -->
<!-- Modal for creating a new post -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Ajouter une nouvelle publication</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="contentForm">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="body" class="form-label">Contenu</label> <!-- Changed 'description' to 'body' -->
                        <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Lieu</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Media (Image/Video)</label>
                        <div class="upload-area" id="mediaUpload">
                            <img src="/api/placeholder/100/100" alt="Upload Icon" width="50" height="50">
                            <p class="mt-2 mb-0">Click or drag and drop to upload media</p>
                            <input type="file" class="d-none" id="mediaInput" name="media" accept="image/*, video/*">
                            <div id="mediaPreview"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" form="contentForm" class="btn btn-primary">Publier</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing a post -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifier la publication</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PATCH') <!-- Add this to override method to PATCH -->
                    <!-- Include a hidden input field for the post ID if needed -->
                    <input type="hidden" id="editPostId" name="post_id" value="{{ $post->id }}">

                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="editTitle" name="title" required value="{{ $post->title }}">
                    </div>

                    <div class="mb-3">
                        <label for="editBody" class="form-label">Contenu</label>
                        <textarea class="form-control" id="editBody" name="body" rows="3" required>{{ $post->body }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="editLocation" class="form-label">Lieu</label>
                        <input type="text" class="form-control" id="editLocation" name="location" value="{{ $post->location }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Media (Image/Video)</label>
                        <div class="upload-area" id="editMediaUpload">
                            <img src="/api/placeholder/100/100" alt="Upload Icon" width="50" height="50">
                            <p class="mt-2 mb-0">Click or drag and drop to upload media</p>
                            <input type="file" class="d-none" id="editMediaInput" name="media" accept="image/*, video/*">
                            <div id="editMediaPreview"></div>
                        </div>
                    </div>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" form="editForm" class="btn btn-primary">Sauvegarder les modifications</button>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Handle media upload area click
    document.getElementById('mediaUpload').addEventListener('click', () => {
        document.getElementById('mediaInput').click();
    });

    // Preview media (image or video)
    document.getElementById('mediaInput').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('mediaPreview');
                if (file.type.startsWith('image/')) {
                    preview.innerHTML = `<img src="${e.target.result}" class="preview-media">`;
                } else if (file.type.startsWith('video/')) {
                    preview.innerHTML = `<video controls class="preview-media"><source src="${e.target.result}"></video>`;
                }
            }
            reader.readAsDataURL(file);
        }
    });

    // Handle form submission
    // Set CSRF token for all AJAX requests
    // Set CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Handle form submission
    $('#contentForm').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('posts.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#formModal').modal('hide');
                // Display SweetAlert for success
                Swal.fire({
                    title: 'Succès!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Reload the page to reflect the new post
                    location.reload();
                });
            },
            error: function (error) {
                // Log error to console for debugging
                console.error('Error:', error);

                // Get error messages and display them
                let errorMessage = 'Il y a eu un problème lors de l\'ajout de la publication.';
                if (error.responseJSON && error.responseJSON.errors) {
                    errorMessage = Object.values(error.responseJSON.errors).join('<br>');
                }

                Swal.fire({
                    title: 'Erreur!',
                    html: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    // Confirm delete post
    function confirmDelete(postId) {
        if (confirm('Are you sure you want to delete this post?')) {
            // Add logic to delete post
            console.log('Post deleted:', postId);
        }
    }
</script>

<script>
    // Open the edit modal and fill it with post data
    function openEditModal(postId) {
        // Fetch post details with AJAX (assuming an endpoint to get the post exists)
        $.ajax({
            url: `/posts/${postId}`,
            type: "GET",
            success: function (response) {
                // Fill the form fields with post data
                $('#editPostId').val(response.id);
                $('#editTitle').val(response.title);
                $('#editBody').val(response.body);
                $('#editLocation').val(response.location);

                // Set media preview if available
                if (response.media) {
                    const preview = $('#editMediaPreview');
                    if (response.media.is_image) {
                        preview.html(`<img src="/${response.media.path}" class="preview-media">`);
                    } else {
                        preview.html(`<video controls class="preview-media"><source src="/${response.media.path}"></video>`);
                    }
                }

                // Open the modal
                $('#editModal').modal('show');
            },
            error: function (error) {
                console.error('Error fetching post data:', error);
                Swal.fire('Erreur!', 'Impossible de charger les détails de la publication.', 'error');
            }
        });
    }

    // Handle edit form submission
    $('#editForm').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        var postId = $('#editPostId').val();

        $.ajax({
            url: `/posts/${postId}`,
            type: "POST", // Must be "POST" to allow Laravel to process it
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-HTTP-Method-Override': 'PATCH' // Override POST to PATCH for Laravel
            },
            success: function (response) {
                $('#editModal').modal('hide');
                Swal.fire({
                    title: 'Succès!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Reload the page to reflect the updated post
                });
            },
            error: function (xhr) {
                let errorText = 'Il y a eu un problème lors de la mise à jour de la publication.';
                if (xhr.status === 422) {
                    // Handle validation errors
                    const errors = xhr.responseJSON.error;
                    errorText = Object.values(errors).flat().join('<br>');
                }
                Swal.fire({
                    title: 'Erreur!',
                    html: errorText,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

</script>
</body>
</html>
