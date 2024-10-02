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
            height: auto;
        }
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
        }
        .comments-btn:hover {
            background-color: #218838;
        }
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
                            <p class="username">Publié par <strong>{{ '@' . $post->user->username }}</strong></p>
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
                        <a href="#" class="comments-btn">{{ $post->comments->count() }} Commentaires</a>
                    </div>
                </div>
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
</body>
</html>
