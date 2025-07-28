@extends('template.template_user')
@push('styles')
    <link rel="stylesheet" href="{{ asset('user/post-detail.css') }}">
@endpush
@section('main-content')
    <div class="container py-5">

        <div class="col-lg-9">
            <div class="post-detail-card">
                <div class="row justify-content-center">
                    @if ($post->cover_image_url)
                        <div class="w-100"></div>
                        <div class="post-detail-cover text-center mb-4">
                            <img src="{{ asset('admin_page/img/' . $post->cover_image_url) }}" alt="{{ $post->title }}"
                                style="display: block; margin: 0 auto;">
                        </div>
                    @endif
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

                    @if ($post->summary)
                        <div class="post-detail-summary">
                            <i class="fas fa-quote-left text-primary mr-2"></i>{{ $post->summary }}
                        </div>
                    @endif
                    <div class="post-detail-content">
                        @if ($post->content_images)
                            @php
                                $contentImages = json_decode($post->content_images, true);
                                $content = $post->content;
                                $imageIndex = 0;
                                $image1Inserted = false;
                                $image2Inserted = false;
                                $image3Inserted = false;
                                $image4Inserted = false;

                                // Tách nội dung theo các bước
                                $parts = preg_split('/(Bước \d+:)/', $content, -1, PREG_SPLIT_DELIM_CAPTURE);
                                $imageCount = is_array($contentImages) ? count($contentImages) : 0;

                                // Tìm vị trí các bước
                                $stepPositions = [];
                                for ($i = 0; $i < count($parts); $i++) {
                                    if (preg_match('/^Bước \d+:/', $parts[$i])) {
                                        $stepPositions[] = $i;
                                    }
                                }
                            @endphp

                            @foreach ($parts as $index => $part)
                                @if (trim($part) !== '')
                                    @if (preg_match('/^Bước \d+:/', $part))
                                        <h3>{{ trim($part) }}</h3>
                                    @else
                                        @php
                                            // Tách nội dung thành các đoạn văn
                                            $paragraphs = preg_split('/(?<=[.!?])\s+/', $part);
                                        @endphp
                                        @foreach ($paragraphs as $pIndex => $paragraph)
                                            @if (trim($paragraph) !== '')
                                                <p>{{ trim($paragraph) }}</p>

                                                {{-- Chèn hình ảnh 1 sau đoạn "Hiệu ứng nhà kính, phá rừng đầu nguồn" trong Bước 1 --}}
                                                @if (!$image1Inserted && $imageCount > 0 && strpos($paragraph, 'Hiệu ứng nhà kính, phá rừng đầu nguồn') !== false)
                                                    @php
                                                        $image = $contentImages[0];
                                                        $image1Inserted = true;
                                                        $imageIndex = 1;
                                                    @endphp
                                                    @if (is_array($image))
                                                        <div class="content-image">
                                                            <img src="{{ asset($image['url']) }}"
                                                                alt="{{ $image['alt'] ?? 'Hình ảnh minh họa' }}">
                                                            @if (isset($image['caption']))
                                                                <div class="image-caption">{{ $image['caption'] }}</div>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="content-image">
                                                            <img src="{{ asset($image) }}" alt="Hình ảnh minh họa">
                                                        </div>
                                                    @endif
                                                @endif

                                                {{-- Chèn hình ảnh 2 sau đoạn "Tích hợp với ChatGPT" trong Bước 2 --}}
                                                @if (
                                                    !$image2Inserted &&
                                                        $imageCount > 1 &&
                                                        strpos($paragraph, 'Tích hợp với ChatGPT: Tối ưu hóa trải nghiệm người dùng') !== false)
                                                    @php
                                                        $image = $contentImages[1];
                                                        $image2Inserted = true;
                                                        $imageIndex = 2;
                                                    @endphp
                                                    @if (is_array($image))
                                                        <div class="content-image">
                                                            <img src="{{ asset($image['url']) }}"
                                                                alt="{{ $image['alt'] ?? 'Hình ảnh minh họa' }}">
                                                            @if (isset($image['caption']))
                                                                <div class="image-caption">{{ $image['caption'] }}</div>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="content-image">
                                                            <img src="{{ asset($image) }}" alt="Hình ảnh minh họa">
                                                        </div>
                                                    @endif
                                                @endif

                                                {{-- Chèn hình ảnh 3 sau đoạn "Whimsical sẽ tự động phân tích" trong Bước 2 --}}
                                                @if (
                                                    !$image3Inserted &&
                                                        $imageCount > 2 &&
                                                        strpos($paragraph, 'Whimsical sẽ tự động phân tích và chuyển hóa chúng thành một sơ đồ tư duy hoàn chỉnh') !==
                                                            false)
                                                    @php
                                                        $image = $contentImages[2];
                                                        $image3Inserted = true;
                                                        $imageIndex = 3;
                                                    @endphp
                                                    @if (is_array($image))
                                                        <div class="content-image">
                                                            <img src="{{ asset($image['url']) }}"
                                                                alt="{{ $image['alt'] ?? 'Hình ảnh minh họa' }}">
                                                            @if (isset($image['caption']))
                                                                <div class="image-caption">{{ $image['caption'] }}</div>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="content-image">
                                                            <img src="{{ asset($image) }}" alt="Hình ảnh minh họa">
                                                        </div>
                                                    @endif
                                                @endif

                                                {{-- Chèn hình ảnh 4 sau đoạn "Bên cạnh sơ đồ tư duy" trong Bước 2 --}}
                                                @if (
                                                    !$image4Inserted &&
                                                        $imageCount > 3 &&
                                                        strpos(
                                                            $paragraph,
                                                            'Bên cạnh sơ đồ tư duy, Whimsical còn cung cấp khả năng tương tự để tạo flowchart một cách trực quan và hiệu quả') !== false)
                                                    @php
                                                        $image = $contentImages[3];
                                                        $image4Inserted = true;
                                                        $imageIndex = 4;
                                                    @endphp
                                                    @if (is_array($image))
                                                        <div class="content-image">
                                                            <img src="{{ asset($image['url']) }}"
                                                                alt="{{ $image['alt'] ?? 'Hình ảnh minh họa' }}">
                                                            @if (isset($image['caption']))
                                                                <div class="image-caption">{{ $image['caption'] }}</div>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="content-image">
                                                            <img src="{{ asset($image) }}" alt="Hình ảnh minh họa">
                                                        </div>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            @endforeach
                        @else
                            {!! $post->content !!}
                        @endif
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
                                    <form action="{{ route('posts.bookmark', $post->id) }}" method="POST" class="d-inline"
                                        id="bookmark-form">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary"
                                            style="font-size: 1.3rem; border-radius: 0.5rem;">
                                            <i class="fas fa-bookmark"></i>
                                            {{ $post->bookmarks()->where('user_id', auth()->id())->exists()? 'Đã lưu': 'Lưu bài viết' }}
                                        </button>
                                    </form>
                                    <div id="bookmark-message" class="mt-2"></div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const bookmarkForm = document.getElementById('bookmark-form');
                                        if (bookmarkForm) {
                                            bookmarkForm.addEventListener('submit', function(e) {
                                                e.preventDefault();
                                                const formData = new FormData(bookmarkForm);
                                                const url = bookmarkForm.action;
                                                const messageDiv = document.getElementById('bookmark-message');
                                                fetch(url, {
                                                        method: 'POST',
                                                        headers: {
                                                            'X-Requested-With': 'XMLHttpRequest',
                                                            'X-CSRF-TOKEN': formData.get('_token')
                                                        },
                                                        body: formData
                                                    })
                                                    .then(res => res.json())
                                                    .then(data => {
                                                        if (data.success) {
                                                            messageDiv.innerHTML =
                                                                `<div class='alert alert-success'>${data.message}</div>`;
                                                        } else {
                                                            messageDiv.innerHTML =
                                                                `<div class='alert alert-danger'>Có lỗi xảy ra!</div>`;
                                                        }
                                                    })
                                                    .catch(() => {
                                                        messageDiv.innerHTML =
                                                            `<div class='alert alert-danger'>Có lỗi xảy ra!</div>`;
                                                    });
                                            });
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    @endauth
                </div>
                {{-- Hiển thị danh sách bình luận --}}
                <div class="card mt-5 mb-4 shadow-sm border-0" style="border-radius: 1.2rem;">
                    <div class="card-body">
                        <h5 class="mb-4 font-weight-bold text-info"><i class="fas fa-comments mr-2"></i>Bình luận</h5>
                        <div id="comments-list">
                            @if ($post->comments->count() > 0)
                                @foreach ($post->comments as $comment)
                                    @include('posts.comment', ['comment' => $comment])
                                @endforeach
                            @else
                                <p class="text-muted">Chưa có bình luận nào. Hãy là người đầu tiên bình luận!</p>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Form bình luận --}}
                @auth
                    <div class="comment-form-box mb-5">
                        <form id="comment-form" action="{{ route('posts.comment.ajax', $post->id) }}" method="POST"
                            autocomplete="off">
                            @csrf
                            <div class="d-flex align-items-start gap-3">
                                <img src="{{ auth()->user()->avatar_url ?? asset('admin_page/img/undraw_profile.svg') }}"
                                    class="comment-avatar" alt="avatar">
                                <div class="flex-grow-1">
                                    <textarea name="content" id="comment-content" class="comment-form-textarea" rows="3"
                                        placeholder="Viết bình luận của bạn..." required></textarea>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span class="comment-form-label">Viết bình luận của bạn:</span>
                                        <button type="submit" class="comment-form-btn">
                                            <i class="fas fa-paper-plane mr-1"></i> Gửi bình luận
                                        </button>
                                    </div>
                                    <div id="comment-message" class="mt-2"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const commentForm = document.getElementById('comment-form');
                            if (commentForm) {
                                commentForm.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    const formData = new FormData(commentForm);
                                    const url = commentForm.action;
                                    const messageDiv = document.getElementById('comment-message');
                                    fetch(url, {
                                            method: 'POST',
                                            headers: {
                                                'X-Requested-With': 'XMLHttpRequest',
                                                'X-CSRF-TOKEN': formData.get('_token')
                                            },
                                            body: formData
                                        })
                                        .then(res => res.json())
                                        .then(data => {
                                            if (data.success) {
                                                // Thêm bình luận mới vào đầu danh sách
                                                const commentList = document.getElementById('comments-list');
                                                commentList.insertAdjacentHTML('afterbegin', data.html);
                                                commentForm.reset();
                                                messageDiv.innerHTML =
                                                    `<div class='alert alert-success'>${data.message}</div>`;
                                            } else {
                                                messageDiv.innerHTML =
                                                    `<div class='alert alert-danger'>Đã có lỗi xảy ra!</div>`;
                                            }
                                        })
                                        .catch(() => {
                                            messageDiv.innerHTML =
                                                `<div class='alert alert-danger'>Đã có lỗi xảy ra!</div>`;
                                        });
                                });
                            }
                        });
                    </script>
                @endauth
                @if ($relatedPosts->count() > 0)
                    <div class="related-posts-section mb-4">
                        <h4 class="mb-4 font-weight-bold text-info">
                            <i class="fas fa-thumbs-up mr-2"></i>Bài viết liên quan
                        </h4>
                        <div class="row no-gutters">
                            @foreach ($relatedPosts as $relatedPost)
                                <div class="col-md-4 mb-4 d-flex">
                                    <div class="related-news-card h-100 w-100">
                                        <div class="related-news-thumb position-relative">
                                            <a href="{{ route('posts.show', $relatedPost->slug) }}">
                                                <img src="{{ $relatedPost->cover_image_url ? asset('admin_page/img/' . $relatedPost->cover_image_url) : asset('admin_page/img/logo.png') }}"
                                                    alt="{{ $relatedPost->title }}">
                                                <span class="badge-news">TIN TỨC</span>
                                            </a>
                                        </div>
                                        <div class="related-news-content">
                                            <a href="{{ route('posts.show', $relatedPost->slug) }}"
                                                class="related-news-title">
                                                {{ $relatedPost->title }}
                                            </a>
                                            <div class="related-news-meta">
                                                <span class="author">By <b>{{ $relatedPost->author->name }}</b></span>
                                                <span class="dot">•</span>
                                                <span
                                                    class="time">{{ $relatedPost->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
