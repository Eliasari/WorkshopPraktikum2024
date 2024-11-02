@extends('layouts.master')

@section('menu')
    @extends('sidebar.dashboard')
@endsection

@section('content')
    @auth
        <a href="{{ route('postings.create') }}" class="btn btn-primary" style="margin-top: 4%;">Back to Postings</a>
    @endauth
    {{-- @dd(route('likesss.destroy', ['postingId' => 2, 'likeId' => 1])); --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <div class="row justify-content-center mt-4">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="posts">
                        @foreach ($posts as $post)
                            <div class="header">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="https://placehold.co/400x400" alt=""
                                            style="max-width: 50px; border-radius: 50px">
                                        <div class="d-flex flex-column">
                                            @if ($post->senderBy)
                                                <h5 class="p-0 m-0">{{ $post->senderBy->username }}</h5>
                                            @else
                                                <h5 class="p-0 m-0">Unknown User</h5>
                                            @endif
                                            <p class="m-0 p-0">{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <a href="#" class="btn">. . .</a>
                                </div>
                            </div>

                            <div class="content mt-3">
                                <div class="d-flex flex-column">
                                    @if ($post->message_gambar)
                                        <div class="image">
                                            <img src="{{ Storage::url($post->message_gambar) }}"
                                                class="img-fluid w-100 rounded-2">
                                        </div>
                                    @endif
                                    <p class="mt-3">{!! $post->message_text !!}</p>
                                </div>

                                @guest
                                    <div class="container">
                                        <h5 class="text-center my-4">--- <a href="{{ route('indexlogin') }}">Login</a> to
                                            interact ---</h5>
                                    </div>
                                @endguest

                                @auth
                                    <div class="toolbar mt-3">
                                        <div class="d-flex justify-content-around gap-3">
                                            @php
                                                $userLiked = $post
                                                    ->likes()
                                                    ->where('id_user', Auth::user()->id_user)
                                                    ->exists();
                                            @endphp
                                            @if ($userLiked)
                                                <form
                                                    action="{{ route('likes.destroy', ['postingId' => $post->posting_id, 'likeId' => $post->likes->where('id_user', Auth::user()->id_user)->first()->like_id]) }}"
                                                    method="post" class="unlike-form" data-post-id="{{ $post->posting_id }}">
                                                    @csrf
                                                    <button type="submit" class="btn2">
                                                        <i class="fa-solid fa-heart me-1" style="color: #ff00f7;"></i> Unlike
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('likes.store', ['posting' => $post->posting_id]) }}"
                                                    method="post" class="like-form" data-post-id="{{ $post->posting_id }}">
                                                    @csrf
                                                    <button type="submit" class="btn2">
                                                        <i class="fa-regular fa-heart me-2"></i> Like
                                                    </button>
                                                </form>
                                            @endif

                                            <a href="#" class="btn2 active">
                                                <i class="fa-regular fa-comment me-2"></i> Comment
                                            </a>
                                            <a href="#" class="btn2" data-bs-toggle="modal" data-bs-target="#postModal">
                                                <i class="fa-regular fa-share-from-square me-2"></i> Share
                                            </a>
                                        </div>
                                    </div>
                                    {{-- <div class="comments-box mt-4">
                                        <form action="{{ route('komentar.store', ['posting' => $post->posting_id]) }}"
                                            method="post" class="mb-4 comment-form" id="commentForm">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="komentar_text" id="commentText"
                                                    placeholder="Your comments" aria-describedby="button-addon2">
                                                <button class="btn btn-outline-secondary" type="submit"
                                                    id="button-addon2">Send</button>
                                            </div>
                                        </form>

                                        <div id="comment-list">
                                            <!-- Komentar akan dimuat di sini dengan AJAX -->
                                        </div>
                                    </div> --}}

                                    <div class="comments-box mt-4">
                                        <form action="{{ route('komentar.store', ['postingId' => $post->posting_id]) }}"
                                            method="post" class="mb-4 comment-form" id="commentForm">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="komentar_text"
                                                    placeholder="your comments" aria-label="Recipient's username"
                                                    aria-describedby="button-addon2">
                                                <button class="btn btn-outline-secondary" type="submit"
                                                    id="button-addon2">Send</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="comment-list">
                                        @foreach ($post->komentar as $item)
                                            <div class="d-flex align-items-start gap-2">
                                                <img src="https://placehold.co/400x400" alt=""
                                                    style="max-width: 30px; border-radius: 50px">
                                                <div class="d-flex flex-column">
                                                    <p class="m-0 p-0 fw-bold">{{ $item->user->username }} |
                                                        {{ $item->created_at->diffForHumans() }}</p>
                                                    <div class="comments">
                                                        <p>{{ $item->komentar_text }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endauth
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn2 {
            width: 150px;
            height: 40px;
            background-color: white;
            color: #6c757d;
            border: none;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }

        .btn2 .icon {
            color: #FF00FF;
            margin-right: 8px;
            font-size: 16px;
        }

        .btn2:hover {
            background-color: #ffffff;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .btn2 .text {
            color: #6c757d;
        }

        .input-group {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .input-group .form-control {
            flex: 1;
            min-width: 200px;
            margin-right: 5px;
        }

        .input-group .btn {
            min-width: 80px;
            margin-top: 15px;
        }

        @media (max-width: 576px) {
            .input-group .form-control {
                min-width: 150px;
            }

            .input-group .btn {
                min-width: 70px;
            }
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function() {
        // function loadComments() {
        //     console.log("Memuat komentar...");
        //     var url = "{{ route('komentar.show', ['postingId' => $post->posting_id]) }}"; // Cek URL
        //     console.log('URL:', url);
        //     $.ajax({
        //         url: url, // URL untuk mengambil komentar
        //         type: 'GET',
        //         success: function(response) {
        //             console.log('Response:', response);
        //             if (response.status) {
        //                 $('#comment-list').html(''); // Kosongkan komentar lama
        //                 if (response.comments.length > 0) {
        //                     response.comments.forEach(function(comment) {
        //                         $('#comment-list').append(`
        //                     <div class="d-flex align-items-start gap-2">
        //                         <img src="https://placehold.co/400x400" alt="" style="max-width: 30px; border-radius: 50px">
        //                         <div class="d-flex flex-column">
        //                             <p class="m-0 p-0 fw-bold">${comment.user.username} | ${comment.created_at}</p>
        //                             <div class="comments">
        //                                 <p>${comment.komentar_text}</p>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 `);
        //                     });
        //                 } else {
        //                     $('#comment-list').append(
        //                     '<p>Tidak ada komentar untuk ditampilkan.</p>'); // Jika tidak ada komentar
        //                 }
        //             }
        //         },
        //         error: function(xhr) {
        //             console.error('AJAX error:', xhr);
        //         }
        //     });
        // }

        // loadComments();

        // $(document).on('submit', '#commentForm', function(e) {
        //     e.preventDefault();
        //     var form = $(this);
        //     var url = form.attr('action');
        //     var method = form.attr('method');

        //     $.ajax({
        //         url: url,
        //         type: method,
        //         data: form.serialize(),
        //         success: function(response) {
        //             console.log(response);
        //             if (response.status) {
        //                 $('#commentText').val(''); // Kosongkan input setelah berhasil
        //                 alert('Komentar successfully added.');
        //                 loadComments(); // Muat komentar terbaru
        //             } else {
        //                 alert('Failed to add Komentar.');
        //             }
        //         },
        //         error: function(xhr) {
        //             console.error('Kesalahan AJAX:', xhr);
        //         }
        //     });
        // });


        // Panggil fungsi loadComments di sini jika perl

        // Handle unlike
        $(document).on('submit', '.unlike-form', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');

            $.ajax({
                url: url,
                type: method,
                data: form.serialize(),
                success: function(response) {
                    if (response.status) {
                        form.find('button').html(
                            '<i class="fa-regular fa-heart me-2"></i> Like');
                        form.attr('method', 'POST');
                        form.attr('action', window.location.origin + '/postings/' + form
                            .data('post-id') + '/likes');
                        form.removeClass('unlike-form').addClass('like-form');
                    } else {
                        console.error('Kesalahan saat tidak suka post:', response.message);
                    }
                },
                error: function(xhr) {
                    console.error('Kesalahan AJAX:', xhr);
                }
            });
        });

        // Handle like
        $(document).on('submit', '.like-form', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');

        $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
            success: function(response) {
                if (response.status) {
                    form.find('button').html(
                        '<i class="fa-solid fa-heart me-1" style="color: #ff00f7;"></i> Unlike'
                    );
                    form.attr('method', 'POST');
                    form.attr('action', window.location.origin + '/postings/' + form
                        .data('post-id') + '/dislike/' + response.like_id);
                    form.removeClass('like-form').addClass('unlike-form');
                } else {
                    console.error('Kesalahan saat like post:', response.message);
                }
            },
            error: function(xhr) {
                console.error('Kesalahan AJAX:', xhr);
            }
        });
        });
  });
    </script>
@endsection
