@extends('template.template_user')

@section('main-content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-9">
                <div class="tag-header mb-4">
                    <h1 class="tag-title">
                        <i class="fas fa-tag text-warning mr-2"></i>
                        #{{ $tag->name }}
                    </h1>
                    @if ($tag->description)
                        <p class="tag-description text-muted">
                            {{ $tag->description }}
                        </p>
                    @endif
                    <p class="text-muted">
                        {{ $posts->total() }} bài viết với tag này
                    </p>
                </div>

                @if ($posts->count() > 0)
                    <div class="row">
                        @foreach ($posts as $post)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    @if ($post->cover_image)
                                        <img src="{{ asset('storage/' . $post->cover_image) }}" class="card-img-top"
                                            alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('posts.show', $post->slug) }}"
                                                class="text-decoration-none text-dark">
                                                {{ $post->title }}
                                            </a>
                                        </h5>
                                        <p class="card-text text-muted">
                                            {{ Str::limit($post->summary, 120) }}
                                        </p>
                                        <div class="card-meta">
                                            <small class="text-muted">
                                                <i class="fas fa-user mr-1"></i>
                                                {{ $post->author->name }}
                                            </small>
                                            <small class="text-muted ml-3">
                                                <i class="fas fa-folder mr-1"></i>
                                                {{ $post->category->name }}
                                            </small>
                                            <small class="text-muted ml-3">
                                                <i class="fas fa-calendar mr-1"></i>
                                                {{ $post->created_at->format('d/m/Y') }}
                                            </small>
                                        </div>
                                        @if ($post->tags->count() > 0)
                                            <div class="mt-2">
                                                @foreach ($post->tags->take(3) as $postTag)
                                                    <span
                                                        class="badge badge-light mr-1 {{ $postTag->id == $tag->id ? 'badge-warning' : '' }}">
                                                        #{{ $postTag->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $posts->links() }}
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-tag fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Chưa có bài viết nào với tag này</h4>
                        <p class="text-muted">Hãy quay lại sau để xem các bài viết mới</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .tag-header {
            background: #fff;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 0.5rem 2rem rgba(44, 62, 80, 0.08);
            margin-bottom: 2rem;
        }

        .tag-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .tag-description {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1.5rem rgba(44, 62, 80, 0.15) !important;
        }

        .card-title a:hover {
            color: #2563eb !important;
        }

        .card-meta {
            margin-top: 1rem;
            padding-top: 0.5rem;
            border-top: 1px solid #f8f9fa;
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.3rem 0.6rem;
            border-radius: 0.5rem;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }
    </style>
@endsection
