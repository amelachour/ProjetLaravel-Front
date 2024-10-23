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
            background-color: #b6d7a8; /* Updated background color */
        }

        .navbar {
            background-color: #b6d7a8 !important; /* Updated navbar color */
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
            color: #345c12;
        }

        .comment-input {
            border-radius: 20px;
            background-color: #f8f9fa;
        }

        .comment-section {
            margin-top: 20px;
        }

        .btn-new-post {
            background-color: #345c12;
            color: #fff;
            border-radius: 30px;
            padding: 10px 20px;
            transition: background-color 0.3s, box-shadow 0.3s;
            border: none;

        }

        .btn-new-post:hover {
            background-color: #345c12;
            box-shadow: 0 4px 12px rgba(128, 189, 90, 0.4);
        }

        .modal-content {
            border-radius: 20px;
            overflow: hidden;
        }

        .modal-header {
            background-color: #345c12;
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
            border-color: #345c12;
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
            color: #345c12;
        }

        .show-more-comments {
            color: #345c12;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }

        .show-more-comments:hover {
            text-decoration: underline;
        }

        .filter-section {
            margin-bottom: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .filter-section label {
            font-weight: bold;
        }
    </style>
    <style>
        .modal-header-custom {
            justify-content: center;
            position: relative;
            border-bottom: none;
            padding: 1rem 1.5rem;
        }

        .modal-header-custom .modal-title {
            font-weight: bold;
            margin: 0 auto;
        }

        .modal-header-custom .btn-close {
            position: absolute;
            right: 1.5rem;
            top: 1rem;
        }
    </style>
    <style>
        .button-center-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;

        }
    </style>

</head>
<body>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 80px;">
        </a>

        <!-- Navbar Toggle for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item current">
                    <a href="{{ route('home') }}" class="nav-link text-dark smoothscroll">Accueil</a>
                </li>
                <li class="nav-item">
                    <a href="{{ asset('#about') }}" class="nav-link text-dark smoothscroll">Centres</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('disposalRecords.index') }}" class="nav-link text-dark">Suivi</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('wastes.index') }}" class="nav-link text-dark">Déchets</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('posts.index') }}" target="_blank" class="nav-link text-dark">Articles</a>
                </li>
                <li class="nav-item">
                    <a href="{{ asset('#download') }}" class="nav-link text-dark smoothscroll">Contactez Nous</a>
                </li>
            </ul>
        </div>

        <!-- Logout Button -->
        <div class="d-flex align-items-center">
            @if(auth()->check())
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-dark ms-3">Déconnecter</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-dark ms-3">Se Connecter</a>
            @endif
        </div>
    </div>
</nav>




<div class="container py-4">
    <div class="filter-section">
        <h5>Filtrer les Publications</h5>
        <form id="filterForm">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="filterTitle" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="filterTitle" name="title">
                </div>
                <div class="col-md-4">
                    <label for="filterAuthor" class="form-label">Auteur</label>
                    <input type="text" class="form-control" id="filterAuthor" name="author">
                </div>
                <div class="col-md-4">
                    <label for="filterLocation" class="form-label">Lieu</label>
                    <input type="text" class="form-control" id="filterLocation" name="location">
                </div>
                <div class="col-md-4">
                    <label for="filterDateFrom" class="form-label">Date de Début</label>
                    <input type="date" class="form-control" id="filterDateFrom" name="date_from">
                </div>
                <div class="col-md-4">
                    <label for="filterDateTo" class="form-label">Date de Fin</label>
                    <input type="date" class="form-control" id="filterDateTo" name="date_to">
                </div>
                <div class="col-md-4 d-none">
                    <label for="filterLikes" class="form-label">Nombre de J'aime Minimum</label>
                    <input type="number" class="form-control" id="filterLikes" name="likes">
                </div>
            </div>
            <div class="text-end mt-3">
                <button type="button" class="btn btn-dark" onclick="applyFilters()">Appliquer les Filtres</button>
            </div>
        </form>
    </div>
    <div class="button-center-wrapper">
        <button type="button" class="btn btn-new-post" data-bs-toggle="modal" data-bs-target="#formModal">
            Ajouter une nouvelle publication
        </button>
    </div>

    <!-- Displaying posts -->
    @foreach($posts as $post)
        <div class="post-card bg-white">
            <!-- Post Actions (Edit/Delete) -->
            <div class="post-actions">
                <i class="fas fa-edit" onclick="openEditModal({{ json_encode($post) }})"></i>
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
                        <span id="likeCount-{{ $post->id }}" class="ms-1">{{ $post->likes->count() }} J'aime</span>
                        <button class="btn btn-link p-0 m-0 text-decoration-none"
                                onclick="viewAllDetails({{ $post->id }})">
                            <span style="font-size: 15px">View all</span>
                        </button>
                    </div>
                    <div>
                        <span>{{ $post->comments->count() }} Commentaires</span>
                    </div>
                </div>
            </div>


            <!-- Interaction Buttons -->
            <div class="d-flex justify-content-around p-2 border-bottom">
                <button
                    class="interaction-button like-button p-2 flex-grow-1 @if($post->likes->contains('user_id', auth()->id())) liked @endif"
                    data-post-id="{{ $post->id }}">
                    @if($post->likes->contains('user_id', auth()->id()))
                        <i class="fas fa-heart text-danger me-2"></i>Unlike
                    @else
                        <i class="fas fa-heart me-2"></i>Like
                    @endif
                </button>
                <button class="interaction-button p-2 flex-grow-1" data-bs-toggle="modal"
                        data-bs-target="#commentsModal-{{ $post->id }}">
                    <i class="fas fa-comment me-2"></i>Comment
                </button>
            </div>


            <!-- Comments Section -->
            <div class="p-3 comment-section" data-post-id="{{ $post->id }}">
                @foreach($post->comments as $index => $comment)
                    <div class="d-flex mb-3 comment-item" data-comment-id="{{ $comment->id }}">
                        <img src="{{ asset('images/placeholder-avatar.png') }}" alt="User Avatar"
                             class="user-avatar me-2" style="width: 32px; height: 32px;">
                        <div class="bg-light p-2 rounded flex-grow-1" style="display: inline-block;">
                            <h6 class="mb-1">{{ $comment->user->name }}</h6>
                            <p class="mb-0 comment-text" id="commentText-{{ $comment->id }}">{{ $comment->comment }}</p>
                            <textarea class="form-control d-none"
                                      id="commentContent-{{ $comment->id }}">{{ $comment->comment }}</textarea>
                            <div class="comment-actions mt-1">
                                <i class="fas fa-edit text-primary edit-comment"
                                   onclick="enableCommentEdit({{ $comment->id }})" style="cursor: pointer;"></i>
                                <i class="fas fa-trash-alt text-danger ms-2 delete-comment"
                                   onclick="deleteComment({{ $comment->id }})" style="cursor: pointer;"></i>
                            </div>
                        </div>
                    </div>

                @endforeach

                @if($post->comments->count() > 3)
                    <div class="text-center mt-3">
                        <button class="btn btn-link show-more-comments" data-post-id="{{ $post->id }}"
                                onclick="toggleComments({{ $post->id }})">
                            <i class="fas fa-chevron-down"></i> Show More
                        </button>
                    </div>
                @endif

                <!-- Comment Input -->
                <div class="d-flex align-items-center mt-3">
                    <img src="{{ asset('images/placeholder-avatar.png') }}" alt="Your Avatar" class="user-avatar me-2"
                         style="width: 32px; height: 32px;">
                    <input type="text" id="newCommentInput-{{ $post->id }}" class="form-control comment-input"
                           placeholder="Write a comment..." onkeypress="handleCommentInput(event, {{ $post->id }})">
                </div>
            </div>


        </div>
    @endforeach

</div>


<!-- Modal for creating a new post -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title" id="formModalLabel">Ajouter une nouvelle publication</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <form id="contentForm" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="body" class="form-label">Contenu</label>
                        <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Lieu</label>
                        <input type="text" class="form-control" id="location" name="location">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Media (Image/Video)</label>
                        <div class="upload-area" id="mediaUpload">
                            <input type="file" class="form-control" id="mediaInput" name="media"
                                   accept="image/*, video/*">
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
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" id="editPostId" name="post_id">

                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="editTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="editBody" class="form-label">Contenu</label>
                        <textarea class="form-control" id="editBody" name="body" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editLocation" class="form-label">Lieu</label>
                        <input type="text" class="form-control" id="editLocation" name="location">
                    </div>
                    <!-- Media Input -->
                    <div class="mb-3">
                        <label class="form-label">Upload Media (Image/Video)</label>
                        <div class="upload-area" id="editMediaUpload">
                            <input type="file" class="d-none" id="editMediaInput" name="media"
                                   accept="image/*, video/*">
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

<!-- View All Modal -->
<div class="modal fade" id="viewAllModal" tabindex="-1" aria-labelledby="viewAllModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewAllModalLabel">Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Likes</h6>
                <ul id="viewAllLikesList" class="list-group mb-4">
                    <!-- Likes will be dynamically populated here -->
                </ul>

                <h6>Comments</h6>
                <ul id="viewAllCommentsList" class="list-group">
                    <!-- Comments will be dynamically populated here -->
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Handle media upload area click for adding media
    document.getElementById('mediaUpload').addEventListener('click', () => {
        document.getElementById('mediaInput').click();
    });

    // Handle media preview for adding media
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

    // Open the edit modal and fill it with post data
    function openEditModal(post) {
        $('#editPostId').val(post.id);
        $('#editTitle').val(post.title);
        $('#editBody').val(post.body);
        $('#editLocation').val(post.location);
        if (post.media) {
            const preview = $('#editMediaPreview');
            if (post.media.is_image) {
                preview.html(`<img src="/${post.media.path}" class="preview-media">`);
            } else {
                preview.html(`<video controls class="preview-media"><source src="/${post.media.path}"></video>`);
            }
        } else {
            $('#editMediaPreview').html('');
        }
        $('#editModal').modal('show');
    }

    $('#contentForm').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('posts.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#formModal').modal('hide');
                Swal.fire('Succès!', response.message, 'success').then(() => {
                    location.reload(); // Reload the page to reflect the new post
                });
            },
            error: function (xhr) {
                let errorText = 'Il y a eu un problème lors de la création de la publication.';
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    errorText = Object.values(errors).flat().join('<br>');
                }
                Swal.fire('Erreur!', errorText, 'error');
            }
        });
    });

    // Handle edit form submission
    $('#editForm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var postId = $('#editPostId').val();

        $.ajax({
            url: `/posts/${postId}`,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-HTTP-Method-Override': 'PATCH' // Override POST to PATCH
            },
            success: function (response) {
                $('#editModal').modal('hide');
                Swal.fire('Succès!', response.message, 'success').then(() => {
                    location.reload();
                });
            },
            error: function (xhr) {
                let errorText = 'Il y a eu un problème lors de la mise à jour de la publication.';
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.error;
                    errorText = Object.values(errors).flat().join('<br>');
                }
                Swal.fire('Erreur!', errorText, 'error');
            }
        });
    });

    // Confirm delete post
    function confirmDelete(postId) {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Voulez-vous vraiment supprimer cette publication?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer!',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/posts/${postId}`,
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.fire('Supprimé!', response.message, 'success').then(() => {
                            location.reload();
                        });
                    },
                    error: function () {
                        Swal.fire('Erreur!', 'Il y a eu un problème lors de la suppression de la publication.', 'error');
                    }
                });
            }
        });
    }
</script>
<script>
    // Handle adding comments in real time
    // Handle adding comments in real time
    function handleCommentInput(event, postId) {
        if (event.key === 'Enter') {
            let comment = event.target.value.trim();
            if (comment !== "") {
                $.ajax({
                    url: "{{ route('comments.store', '') }}/" + postId,
                    type: "POST",
                    data: {
                        comment: comment,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        // Append new comment to the comment section
                        let newCommentHtml = `
                        <div class="d-flex mb-3 comment-item" data-comment-id="${response.comment_id}">
                            <img src="{{ asset('images/placeholder-avatar.png') }}" alt="User Avatar" class="user-avatar me-2" style="width: 32px; height: 32px;">
                            <div class="bg-light p-2 rounded flex-grow-1" style="display: inline-block;">
                                <h6 class="mb-1">${response.user}</h6>
                                <p class="mb-0 comment-text" id="commentText-${response.comment_id}">${response.comment}</p>
                                <textarea class="form-control d-none" id="commentContent-${response.comment_id}">${response.comment}</textarea>
                                <div class="comment-actions mt-1">
                                    <i class="fas fa-edit text-primary edit-comment" onclick="enableCommentEdit(${response.comment_id})" style="cursor: pointer;"></i>
                                    <i class="fas fa-trash-alt text-danger ms-2 delete-comment" onclick="deleteComment(${response.comment_id})" style="cursor: pointer;"></i>
                                </div>
                            </div>
                        </div>`;
                        $(event.target).closest('.comment-section').find('.d-flex.align-items-center').before(newCommentHtml);
                        event.target.value = ""; // Clear input field after adding the comment
                    },
                    error: function (xhr) {
                        Swal.fire('Erreur!', 'Impossible d\'ajouter le commentaire.', 'error');
                    }
                });
            }
        }
    }

    // Handle editing comments
    function updateComment(commentId) {
        const newCommentContent = $(`#commentContent-${commentId}`).val().trim();

        if (newCommentContent !== "") {
            $.ajax({
                url: `/comments/${commentId}`, // Use the correct URI pattern for comments update route
                type: "PATCH",
                data: {
                    comment: newCommentContent,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Update the comment display after successful update
                    const commentText = $(`#commentText-${commentId}`);
                    const commentContent = $(`#commentContent-${commentId}`);

                    commentText.text(response.comment);
                    commentText.show();
                    commentContent.addClass('d-none');

                    Swal.fire('Succès!', 'Commentaire mis à jour avec succès.', 'success');
                },
                error: function (xhr) {
                    let errorText = 'Il y a eu un problème lors de la mise à jour du commentaire.';
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        errorText = Object.values(errors).flat().join('<br>');
                    }
                    Swal.fire('Erreur!', errorText, 'error');
                }
            });
        } else {
            Swal.fire('Erreur!', 'Le contenu du commentaire ne peut pas être vide.', 'error');
        }
    }    // Handle deleting comments
    function deleteComment(commentId) {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Voulez-vous vraiment supprimer ce commentaire?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer!',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/comments/${commentId}`, // Use the dynamic comment ID directly
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        $(`[data-comment-id="${commentId}"]`).remove(); // Remove comment from DOM
                        Swal.fire('Supprimé!', response.message, 'success');
                    },
                    error: function () {
                        Swal.fire('Erreur!', 'Impossible de supprimer le commentaire.', 'error');
                    }
                });
            }
        });
    }

    // Enable editing for a comment
</script>

<script>
    function enableCommentEdit(commentId) {
        // Toggle between displaying comment text and textarea for editing
        const commentText = $(`#commentText-${commentId}`);
        const commentContent = $(`#commentContent-${commentId}`);

        if (commentText.is(":visible")) {
            commentText.hide();
            commentContent.removeClass('d-none').focus();

            // Add an event listener for pressing "Enter" while editing
            commentContent.on('keypress', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Prevent adding a new line
                    updateComment(commentId);
                }
            });

            // Alternatively save the comment when the user clicks outside (blur event)
            commentContent.on('blur', function () {
                updateComment(commentId);
            });
        } else {
            commentText.show();
            commentContent.addClass('d-none');
        }
    }

    function toggleComments(postId) {


        // Find the button clicked and the corresponding comments for the post
        const button = $(`.show-more-comments[data-post-id="${postId}"]`);
        const comments = $(`.comment-section[data-post-id="${postId}"] .comment-item`);

        if (button.text().trim().includes("Show More")) {
            // Show all comments
            comments.removeClass('d-none');
            button.html('<i class="fas fa-chevron-up"></i> Show Less');
        } else {
            // Hide all comments except the first 3
            comments.each((index, comment) => {
                if (index >= 3) {
                    $(comment).addClass('d-none');
                }
            });
            button.html('<i class="fas fa-chevron-down"></i> Show More');
        }
    }

</script>
{{--like part--}}
<script>
    $(document).on('click', '.interaction-button.like-button', function () {
        let postId = $(this).data('post-id');
        let button = $(this);

        if (button.hasClass('liked')) {
            // Unlike the post
            $.ajax({
                url: `/posts/${postId}/unlike`,
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    button.removeClass('liked');
                    button.html(`<i class="fas fa-heart me-2"></i>Like`);
                    $(`#likeCount-${postId}`).text(response.like_count + " J'aime");
                },
                error: function () {
                    Swal.fire('Erreur!', 'Impossible d\'annuler le like.', 'error');
                }
            });
        } else {
            // Like the post
            $.ajax({
                url: `/posts/${postId}/like`,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    button.addClass('liked');
                    button.html(`<i class="fas fa-heart text-danger me-2"></i>Unlike`);
                    $(`#likeCount-${postId}`).text(response.like_count + " J'aime");
                },
                error: function () {
                    Swal.fire('Erreur!', 'Impossible d\'aimer la publication.', 'error');
                }
            });
        }
    });


    function viewAllDetails(postId) {
        $.ajax({
            url: `/posts/${postId}/likes`, // Ensure this matches the route you added
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                let likesList = $('#viewAllLikesList');
                let commentsList = $('#viewAllCommentsList');

                // Clear previous lists
                likesList.empty();
                commentsList.empty();

                // Populate likes
                if (response.likes.length > 0) {
                    response.likes.forEach(function (like) {
                        likesList.append(`
                        <li class="list-group-item d-flex align-items-center">
                            <img src="${like.user_avatar}" alt="${like.user_name}" class="user-avatar me-2" style="width: 32px; height: 32px;">
                            <span>${like.user_name}</span>
                        </li>
                    `);
                    });
                } else {
                    likesList.append('<li class="list-group-item text-center">No likes yet</li>');
                }

                // Populate comments
                if (response.comments.length > 0) {
                    response.comments.forEach(function (comment) {
                        commentsList.append(`
                        <li class="list-group-item d-flex align-items-start">
                            <img src="${comment.user_avatar}" alt="${comment.user_name}" class="user-avatar me-2" style="width: 32px; height: 32px;">
                            <div>
                                <strong>${comment.user_name}</strong>
                                <p>${comment.comment}</p>
                            </div>
                        </li>
                    `);
                    });
                } else {
                    commentsList.append('<li class="list-group-item text-center">No comments yet</li>');
                }

                // Show the modal
                $('#viewAllModal').modal('show');
            },
            error: function () {
                Swal.fire('Erreur!', 'Impossible de récupérer les informations.', 'error');
            }
        });
    }


</script>
<script>
    function applyFilters() {
        const title = $('#filterTitle').val().toLowerCase();
        const author = $('#filterAuthor').val().toLowerCase();
        const location = $('#filterLocation').val().toLowerCase();
        const dateFrom = $('#filterDateFrom').val();
        const dateTo = $('#filterDateTo').val();
        const likes = $('#filterLikes').val();

        $('.post-card').each(function () {
            const postTitle = $(this).find('h5').text().toLowerCase();
            const postAuthor = $(this).find('.d-flex.align-items-center h6').text().toLowerCase();
            const postLocation = $(this).find('.fa-map-marker-alt').closest('p').text().toLowerCase();
            const postDate = new Date($(this).find('.post-timestamp').text());
            const postLikes = parseInt($(this).find('#likeCount-' + $(this).data('post-id')).text());

            let matchesFilter = true;

            if (title && !postTitle.includes(title)) matchesFilter = false;
            if (author && !postAuthor.includes(author)) matchesFilter = false;
            if (location && !postLocation.includes(location)) matchesFilter = false;
            if (dateFrom && postDate < new Date(dateFrom)) matchesFilter = false;
            if (dateTo && postDate > new Date(dateTo)) matchesFilter = false;
            if (likes && postLikes < likes) matchesFilter = false;

            if (matchesFilter) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
</script>
</body>
</html>
