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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            background-color: #f9f9f9;
        }

        /* Post Card Styling */
        .post-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            border-left: 5px solid #28a745;
        }

        /* Media Styling */
        .post-media {
            border-radius: 10px;
            max-width: 100%;
            height: auto;
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

        /* Comments Button */
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

        /* Post Footer */
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

        /* Comments Modal Styling */
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

        /* Comment Form */
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

        /* Comment Content */
        .comment-content {
            font-size: 14px;
            margin-bottom: 8px;
        }

        /* Comment Actions */
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

    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-5 text-green">Toutes les publications</h1>

    <!-- New Post Button -->
    <div class="text-center">
        <button class="btn btn-new-post" data-bs-toggle="modal" data-bs-target="#newPostModal">Ajouter une publication</button>
    </div>

    <!-- New Post Modal -->
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
                            <input type="text" class="form-control" id="postLocation" name="location">
                        </div>
                        <div class="mb-3">
                            <label for="postMedia" class="form-label">Image ou Vidéo</label>
                            <input type="file" class="form-control" id="postMedia" name="media" accept="image/*,video/*">
                        </div>
                        <button type="submit" class="btn btn-success">Publier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Posts Listing -->
    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-8 offset-md-2">
                <div class="post-card">
                    <!-- Check if media exists -->
                    @if($post->media)
                        @if($post->media->is_image)
                            <img src="{{ asset("posts/" . $post->media->path) }}" alt="image" class="post-media">
                        @else
                            <video class="post-media" controls autoplay muted loop>
                                <source src="{{ asset("posts/" . $post->media->path) }}" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture vidéo.
                            </video>
                        @endif
                    @endif

                    <div class="post-header mt-3">
                        <img src="{{ $post->user->profile_image ? asset('users/' . $post->user->profile_image) : 'https://via.placeholder.com/150?text=User' }}" alt="Photo de profil">
                        <div>
                            <p class="username">Publié par <strong>{{ '@' . $post->user->name }}</strong></p>
                            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                        </div>
                    </div>

                    <div class="post-body mt-3">
                        <h5>{{ $post->title }}</h5>
                        <p>{{ $post->body }}</p>
                        <p><i class="bi bi-geo-alt"></i> {{ $post->location ?? 'Lieu non spécifié' }}</p>
                    </div>

                    <div class="post-footer">
                        <div class="post-actions">
                            <i class="bi bi-hand-thumbs-up"></i> {{ $post->likes->count() }} J'aime
                        </div>
                        <a href="#" class="comments-btn" data-bs-toggle="modal" data-bs-target="#commentsModal-{{ $post->id }}">Commentaires ({{ $post->comments->count() }})</a>
                    </div>
                </div>

                <!-- Comments Modal -->
                <!-- Comments Modal -->
                <div class="modal fade" id="commentsModal-{{ $post->id }}" tabindex="-1" aria-labelledby="commentsModalLabel-{{ $post->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="commentsModalLabel-{{ $post->id }}">{{ $post->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Comment form -->
                                <form id="commentForm-{{ $post->id }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="commentBody" class="form-label">Votre commentaire</label>
                                        <textarea class="form-control" name="comment" id="commentBody-{{ $post->id }}" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Post Comment</button>
                                </form>

                                <!-- Display existing comments -->
                                <!-- Display existing comments -->
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

                <!-- End of Comments Modal -->
            </div>
        @endforeach
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<!-- Script to handle post creation and show SweetAlert -->
<script>
    $('#newPostForm').on('submit', function (e) {
        e.preventDefault();

        // Create FormData object for file upload
        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('posts.store') }}",
            type: "POST",
            data: formData,
            contentType: false, // Prevent jQuery from setting content-type
            processData: false, // Prevent jQuery from processing the data
            success: function (response) {
                $('#newPostModal').modal('hide');
                Swal.fire({
                    title: 'Succès!',
                    text: 'Votre publication a été ajoutée avec succès!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });

                // Optionally, you can reload the page or dynamically update the posts list
                location.reload();
            },
            error: function (error) {
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
        // For each post, bind the form submit event for real-time comments
        @foreach($posts as $post)
        $('#commentForm-{{ $post->id }}').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submit behavior

            var formData = {
                comment: $('#commentBody-{{ $post->id }}').val(),
                _token: $('input[name=_token]').val() // CSRF Token
            };

            $.ajax({
                type: 'POST',
                url: '{{ route("comments.store", $post->id) }}', // Post the comment to this post's comment route
                data: formData,
                success: function(response) {
                    // Add the new comment to the list without refreshing
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

                    // Clear the textarea
                    $('#commentBody-{{ $post->id }}').val('');
                },
                error: function(error) {
                    console.log(error);
                    alert('There was an error posting your comment.');
                }
            });
        });

        // Delete Comment with AJAX
        $(document).on('click', '.delete-comment', function(e) {
            e.preventDefault();
            var commentId = $(this).data('id'); // Get the comment ID

            $.ajax({
                type: 'DELETE',
                url: '/comments/' + commentId, // Your delete route
                data: {
                    _token: $('input[name=_token]').val() // CSRF Token
                },
                success: function(response) {
                    // Remove the comment from the DOM
                    $('#comment-' + commentId).remove();
                },
                error: function(error) {
                    console.log(error);
                    alert('There was an error deleting your comment.');
                }
            });
        });
        @endforeach
    });


</script>
</body>
</html>
