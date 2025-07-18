@extends('template.template_user')
@push('styles')
    <link rel="stylesheet" href="{{ asset('user/post-detail.css') }}">
@endpush
@section('main-content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="post-detail-card">
                    <h1 class="post-detail-title">{{ $post->title }}</h1>
                    <div class="post-detail-meta">
                        <span class="mr-3"><i class="fas fa-user mr-1"></i> {{ $post->author->name }}</span>
                        <span class="mr-3"><i class="fas fa-calendar-alt mr-1"></i>
                            {{ $post->published_at ? $post->published_at->format('d/m/Y H:i') : $post->created_at->format('d/m/Y H:i') }}</span>
                        <span><i class="fas fa-eye mr-1"></i> {{ $post->view_count }} lượt xem</span>
                    </div>
                    <div class="post-detail-badges mb-4"
                        style="margin-bottom: 2.5rem !important; display: flex; flex-wrap: wrap; gap: 0.5rem;">
                        <span class="badge"
                            style="background: linear-gradient(90deg,#4e73df,#224abe); color: #fff;">{{ $post->category->name }}</span>
                        <span class="badge"
                            style="background: linear-gradient(90deg,#36b9cc,#1cc88a); color: #fff;">{{ $post->field->name }}</span>
                    </div>
                    @if ($post->cover_image_url)
                        <div class="w-100"></div>
                        <div class="post-detail-cover text-center mb-4">
                            <img src="{{ asset('storage/' . $post->cover_image_url) }}" alt="{{ $post->title }}"
                                style="display: block; margin: 0 auto;">
                        </div>
                    @endif
                    @if ($post->summary)
                        <div class="post-detail-summary">
                            <i class="fas fa-quote-left text-primary mr-2"></i>{{ $post->summary }}
                        </div>
                    @endif
                    <div class="post-detail-content">
                        {!! $post->content !!}
                    </div>
                    @if ($post->tags->count() > 0)
                        <div class="post-detail-tags mb-4">
                            <i class="fas fa-tags text-secondary"></i>
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('tags.show', $tag->slug) }}"
                                    class="badge badge-secondary mx-1">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    @endif
                    @auth
                        <div class="card bg-light border-0 shadow-sm p-4 mt-4 mb-2" style="border-radius: 1.2rem;">
                            <div class="row align-items-center">
                                <div class="col-md-7 mb-3 mb-md-0">
                                    <h5 class="mb-2 font-weight-bold">Đánh giá bài viết:</h5>
                                    <form action="{{ route('posts.rate', $post) }}" method="POST" class="d-inline">
                                        @csrf
                                        <div class="rating d-inline-block align-middle">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <input type="radio" name="rating" value="{{ $i }}"
                                                    id="star{{ $i }}">
                                                <label for="star{{ $i }}"
                                                    style="font-size: 1.7rem; color: #ddd; cursor:pointer;"><i
                                                        class="fas fa-star"></i></label>
                                            @endfor
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary ml-2">Gửi đánh giá</button>
                                    </form>
                                </div>
                                <div class="col-md-5 text-md-right">
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary"
                                            style="font-size: 1.3rem; border-radius: 0.5rem;">
                                            <i class="fas fa-bookmark"></i>
                                            {{-- {{ $post->bookmarks()->where('user_id', auth()->id())->exists()? 'Đã lưu': 'Lưu bài viết' }} --}}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
                {{-- Hiển thị danh sách bình luận --}}
                <div class="card mt-5 mb-4 shadow-sm border-0" style="border-radius: 1.2rem;">
                    <div class="card-body">
                        <h5 class="mb-4 font-weight-bold text-info"><i class="fas fa-comments mr-2"></i>Bình luận</h5>
                        @if ($post->comments->count() > 0)
                            @foreach ($post->comments as $comment)
                                <div class="media mb-4 align-items-center">
                                    <img src="{{ $comment->user->avatar_url ?? asset('admin_page/img/undraw_profile.svg') }}"
                                        class="mr-3 rounded-circle border"
                                        style="width:48px; height:48px; object-fit:cover; box-shadow:0 2px 8px rgba(44,62,80,0.08);"
                                        alt="avatar">
                                    <div class="media-body">
                                        <div class="d-flex align-items-center mb-1">
                                            <h6 class="mt-0 mb-0 font-weight-bold mr-2" style="font-size:1.08rem;">
                                                {{ $comment->user->name ?? 'Ẩn danh' }}</h6>
                                            <small class="text-muted"
                                                style="font-size:0.95rem;">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        <div style="font-size:1.08rem; line-height:1.6; color:#222;">
                                            {{ $comment->content }}</div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">Chưa có bình luận nào. Hãy là người đầu tiên bình luận!</p>
                        @endif
                    </div>
                </div>
                {{-- Form bình luận --}}
                @auth
                    <div class="card mb-5 shadow-sm border-0" style="border-radius: 1.2rem;">
                        <div class="card-body">
                            <form action="{{ route('posts.comment', $post->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="comment-content" class="font-weight-bold">Viết bình luận của bạn:</label>
                                    <textarea name="content" id="comment-content" class="form-control" rows="3"
                                        style="border-radius:0.7rem; font-size:1.08rem;" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold"
                                    style="border-radius:0.7rem; font-size:1.08rem;"><i class="fas fa-paper-plane mr-1"></i> Gửi
                                    bình luận</button>
                            </form>
                        </div>
                    </div>
                @endauth
                @if ($relatedPosts->count() > 0)
                    <div class="card shadow-sm border-0 mb-4" style="border-radius: 1.2rem;">
                        <div class="card-body">
                            <h4 class="mb-4 font-weight-bold text-info"><i class="fas fa-thumbs-up mr-2"></i>Bài viết liên
                                quan</h4>
                            <div class="row">
                                @foreach ($relatedPosts as $relatedPost)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100 border-0 shadow-sm" style="border-radius: 0.8rem;">
                                            <div class="card-body">
                                                <h6 class="card-title font-weight-bold">
                                                    <a href="{{ route('posts.show', $relatedPost->slug) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ $relatedPost->title }}
                                                    </a>
                                                </h6>
                                                <p class="card-text small text-muted mb-0">
                                                    <i class="fas fa-user"></i> {{ $relatedPost->author->name }}<br>
                                                    <i class="fas fa-calendar"></i>
                                                    {{ $relatedPost->published_at ? $relatedPost->published_at->format('d/m/Y') : $relatedPost->created_at->format('d/m/Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
