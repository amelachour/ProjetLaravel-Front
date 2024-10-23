<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publications</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 CSS -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            background-color: #f9f9f9;
        }

        .post-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            border-left: 5px solid #28a745;
        }

        .post-media {
            border-radius: 10px;
            max-width: 100%;
            max-height: 400px;
            object-fit: cover;
            display: block;
            margin: 0 auto;
        }

        /* Post Header */
        .post-header {
            display: flex;
            align-items: center;
            margin-top: 15px;
        }

        .post-header img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .post-header .username {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 0;
        }

        .post-header small {
            color: gray;
        }


        .comments-btn {
            background-color: #28a745;
            color: white;
            border-radius: 50px;
            padding: 5px 15px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .comments-btn:hover {
            background-color: #218838;
        }

        /* New Post Button */
        .btn-new-post {
            background-color: #28a745;
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            margin-bottom: 20px;
        }


        .post-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .post-actions {
            display: flex;
            align-items: center;
        }

        .post-actions i {
            margin-right: 5px;
        }


        .modal-body {
            padding: 20px;
        }

        .modal-title {
            font-size: 18px;
            font-weight: bold;
        }

        .modal-body h6 {
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }


        .modal-body form .form-control {
            resize: none;
            border-radius: 8px;
        }

        .modal-body form .btn {
            background-color: #28a745;
            border: none;
            color: white;
            border-radius: 8px;
            padding: 8px 16px;
        }

        .modal-body form .btn:hover {
            background-color: #218838;
        }

        /* Comment List */
        .list-group-item {
            background-color: #f1f1f1;
            border: none;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .list-group-item strong {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .comment-content {
            font-size: 14px;
            margin-bottom: 8px;
        }

        .comment-actions {
            display: flex;
            align-items: center;
            font-size: 12px;
            color: gray;
        }

        .comment-actions a {
            text-decoration: none;
            color: #28a745;
            margin-right: 10px;
        }

        .comment-actions a:hover {
            text-decoration: underline;
        }

        /* Comment Time */
        .comment-time {
            font-size: 12px;
            color: gray;
        }

        /* Comment Like and Delete Hover Effects */
        .comment-actions a:hover {
            color: #218838;
            text-decoration: none;
        }

        /* Modal Footer */
        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding-top: 15px;
        }

        .overlay-buttons {
            top: 10px;
            right: 10px;
            z-index: 10;
        }


    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-5 text-green">Toutes les publications</h1>


    <div class="text-center">
        <button class="btn btn-new-post" data-bs-toggle="modal" data-bs-target="#newPostModal">Ajouter une publication</button>
    </div>

    <div class="modal fade" id="newPostModal" tabindex="-1" aria-labelledby="newPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newPostModalLabel">Nouvelle publication</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="newPostForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="postTitle" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="postTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="postBody" class="form-label">Contenu</label>
                            <textarea class="form-control" id="postBody" name="body" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="postLocation" class="form-label">Lieu</label>
                            <input type="text" class="form-control" id="postLocation" name="location" required>
                        </div>
                        <div class="mb-3">
                            <label for="postMedia" class="form-label">Image ou Vidéo</label>
                            <input type="file" class="form-control" id="postMedia" name="media" accept="image/*,video/*" required>
                        </div>
                        <button type="submit" class="btn btn-success">Publier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-6 mb-4">
                    <div class="post-card position-relative">
                        @if($post->media)
                            <div class="media-container">
                                @if($post->media->is_image)
                                    <img src="{{ asset($post->media->path) }}" alt="image" class="post-media" width="1300px" height="953px">
                                @else
                                    <video class="post-media" controls autoplay muted loop style="width: 100%; height: auto;">
                                        <source src="{{ asset($post->media->path) }}" type="video/mp4">
                                        Your browser does not support video playback.
                                    </video>
                                @endif

                                @if(auth()->id() == $post->user_id)
                                    <div class="overlay-buttons position-absolute top-0 end-0 p-2">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton-{{ $post->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $post->id }}">
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editPostModal-{{ $post->id }}">Edit</a></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $post->id }})">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <div class="post-body mt-3">
                            <h5>{{ $post->title }}</h5>
                            <p>{{ $post->body }}</p>
                            <p><i class="bi bi-geo-alt"></i> {{ $post->location ?? 'Location not specified' }}</p>
                            <div class="post-footer">
                                <div class="post-actions">
                                    <i class="bi bi-hand-thumbs-up"></i> {{ $post->likes->count() }} J'aime
                                </div>
                                <a href="#" class="comments-btn" data-bs-toggle="modal" data-bs-target="#commentsModal-{{ $post->id }}">Commentaires ({{ $post->comments->count() }})</a>
                            </div>
                        </div>

                            <div class="modal fade" id="commentsModal-{{ $post->id }}" tabindex="-1" aria-labelledby="commentsModalLabel-{{ $post->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="commentsModalLabel-{{ $post->id }}">{{ $post->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="commentForm-{{ $post->id }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="commentBody" class="form-label">Votre commentaire</label>
                                                    <textarea class="form-control" name="comment" id="commentBody-{{ $post->id }}" rows="3" required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-success">Post Comment</button>
                                            </form>

                                            <h6>Commentaires</h6>
                                            <ul class="list-group comment-list" id="commentList-{{ $post->id }}">
                                                @foreach($post->comments as $comment)
                                                    <li class="list-group-item" id="comment-{{ $comment->id }}">
                                                        <strong>{{ $comment->user->name }}</strong>
                                                        <div class="comment-content">{{ $comment->comment }}</div>
                                                        <div class="comment-actions">
                                                            <a href="#" class="delete-comment" data-id="{{ $comment->id }}">Delete</a>
                                                            <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="editPostModal-{{ $post->id }}" tabindex="-1" aria-labelledby="editPostModalLabel-{{ $post->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editPostModalLabel-{{ $post->id }}">Modifier le Poste</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editPostForm-{{ $post->id }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="_method" value="PATCH">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Titre</label>
                                                    <input type="text" class="form-control" name="title" value="{{ $post->title }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="body" class="form-label">Contenu</label>
                                                    <textarea class="form-control" name="body" rows="4" required>{{ $post->body }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="location" class="form-label">Lieu</label>
                                                    <input type="text" class="form-control" name="location" value="{{ $post->location }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="media" class="form-label">Image ou Vidéo</label>
                                                    <input type="file" class="form-control" name="media" accept="image/*,video/*">
                                                    <small>Actuel: {{ $post->media->path ?? 'Pas de média' }}</small>
                                                </div>
                                                <button type="submit" class="btn btn-success">Mettre à jour</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>




</div>
<!-- Edit Post Modal -->
<div class="modal fade" id="editPostModal-{{ $post->id }}" tabindex="-1" aria-labelledby="editPostModalLabel-{{ $post->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPostModalLabel-{{ $post->id }}">Edit Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPostForm-{{ $post->id }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="mb-3">
                        <label for="editPostTitle-{{ $post->id }}" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editPostTitle-{{ $post->id }}" name="title" value="{{ $post->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPostBody-{{ $post->id }}" class="form-label">Content</label>
                        <textarea class="form-control" id="editPostBody-{{ $post->id }}" name="body" rows="4" required>{{ $post->body }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editPostLocation-{{ $post->id }}" class="form-label">Location</label>
                        <input type="text" class="form-control" id="editPostLocation-{{ $post->id }}" name="location" value="{{ $post->location }}">
                    </div>
                    <div class="mb-3">
                        <label for="editPostMedia-{{ $post->id }}" class="form-label">Image or Video</label>
                        <input type="file" class="form-control" id="editPostMedia-{{ $post->id }}" name="media" accept="image/*,video/*">
                        <small>Current: {{ $post->media->path ?? 'No media' }}</small>
                    </div>
                    <button type="submit" class="btn btn-success">Update Post</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>


<script>
    $('#newPostForm').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('posts.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#newPostModal').modal('hide');
                Swal.fire({
                    title: 'Succès!',
                    text: 'Votre publication a été ajoutée avec succès!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });

                location.reload();
            },
            error: function(error) {
                Swal.fire({
                    title: 'Erreur!',
                    text: 'Il y a eu un problème lors de l\'ajout de la publication.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        @foreach($posts as $post)
        $('#commentForm-{{ $post->id }}').on('submit', function(e) {
            e.preventDefault();

            var formData = {
                comment: $('#commentBody-{{ $post->id }}').val(),
                _token: $('input[name=_token]').val() // CSRF Token
            };

            $.ajax({
                type: 'POST',
                url: '{{ route("comments.store", $post->id) }}',
                data: formData,
                success: function(response) {

                    $('#commentList-{{ $post->id }}').prepend(`
                    <li class="list-group-item" id="comment-${response.comment_id}">
                        <strong>${response.user}</strong>
                        <div class="comment-content">${response.comment}</div>
                        <div class="comment-actions">
                            <a href="#" class="delete-comment" data-id="${response.comment_id}">Delete</a>
                            <span class="comment-time">Just now</span>
                        </div>
                    </li>
                `);


                    $('#commentBody-{{ $post->id }}').val('');
                },
                error: function(error) {
                    console.log(error);
                    alert('There was an error posting your comment.');
                }
            });
        });

        $(document).on('click', '.delete-comment', function(e) {
            e.preventDefault();
            var commentId = $(this).data('id');
            console.log('Comment ID:', commentId);


            var token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'DELETE',
                url: '{{ route("comments.destroy", ":id") }}'.replace(':id', commentId), // Use route name with dynamic ID
                data: {
                    _token: token
                },
                success: function(response) {

                    $('#comment-' + commentId).remove();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('There was an error deleting your comment.');
                }
            });
        });
        @endforeach
    });


</script>
<script>

    $('#newPostModal').on('shown.bs.modal', function () {

        $('#newPostForm')[0].reset();

        $('#postMedia').val('');
    });
</script>
<script>
    $(document).ready(function() {
        $('form[id^="editPostForm-"]').on('submit', function(e) {
            e.preventDefault();
            var formId = $(this).attr('id');
            var postId = formId.split('-').pop();
            var formData = new FormData(this);

            $.ajax({
                url: "{{ url('posts') }}/" + postId,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#editPostModal-' + postId).modal('hide');
                    Swal.fire('Updated!', 'Your post has been updated successfully.', 'success');
                    location.reload();
                },
                error: function(response) {
                    Swal.fire('Error!', 'Failed to update the post.', 'error');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('form[id^="editPostForm-"]').on('submit', function(e) {
            e.preventDefault();
            var formId = $(this).attr('id');
            var postId = formId.split('-').pop();
            var formData = new FormData(this);

            $.ajax({
                url: "/posts/" + postId,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-HTTP-Method-Override': 'PATCH'
                },
                success: function(response) {
                    $('#editPostModal-' + postId).modal('hide');
                    location.reload()                },
                error: function(xhr) { // Handle errors
                    var errorMessage = xhr.responseJSON ? xhr.responseJSON.error : 'Something went wrong!'; // Adjust based on your response structure
                    location.reload()                }
            });
        });
    });
</script>

<script>
    var deletePostUrl = "{{ route('posts.destroy', ['post' => ':id']) }}";
    function confirmDelete(postId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deletePostUrl.replace(':id', postId),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Your post has been deleted.',
                            'success'
                        );
                        location.reload();
                    },
                    error: function() {
                        Swal.fire(
                            'Failed!',
                            'There was an error deleting the post.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>

</body>
</html>

