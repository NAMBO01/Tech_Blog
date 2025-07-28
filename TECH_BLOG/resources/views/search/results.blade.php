@extends('template.template_user')

@section('main-content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-9">
                <div class="search-results">
                    <div class="search-header mb-4">
                        <h2 class="search-title">
                            <i class="fas fa-search text-primary mr-2"></i>
                            Kết quả tìm kiếm cho: "<span class="text-primary">{{ $query }}</span>"
                        </h2>
                        <p class="text-muted">
                            Tìm thấy {{ $posts->total() }} bài viết, {{ $categories->count() }} danh mục,
                            {{ $tags->count() }} tags và {{ $authors->count() }} tác giả
                        </p>
                    </div>

                    @if ($posts->count() > 0)
                        <div class="search-section mb-5">
                            <h3 class="section-title">
                                <i class="fas fa-file-alt text-primary mr-2"></i>
                                Bài viết ({{ $posts->total() }})
                            </h3>
                            <div class="row">
                                @foreach ($posts as $post)
                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100 border-0 shadow-sm">
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
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{ $posts->appends(['q' => $query])->links() }}
                        </div>
                    @endif

                    @if ($categories->count() > 0)
                        <div class="search-section mb-5">
                            <h3 class="section-title">
                                <i class="fas fa-folder text-success mr-2"></i>
                                Danh mục ({{ $categories->count() }})
                            </h3>
                            <div class="row">
                                @foreach ($categories as $category)
                                    <div class="col-md-4 mb-3">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body text-center">
                                                <i class="fas fa-folder fa-2x text-success mb-2"></i>
                                                <h6 class="card-title">{{ $category->name }}</h6>
                                                @if ($category->description)
                                                    <p class="card-text small text-muted">
                                                        {{ Str::limit($category->description, 80) }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($tags->count() > 0)
                        <div class="search-section mb-5">
                            <h3 class="section-title">
                                <i class="fas fa-tag text-warning mr-2"></i>
                                Tags ({{ $tags->count() }})
                            </h3>
                            <div class="tags-container">
                                @foreach ($tags as $tag)
                                    <a href="{{ route('tags.show', $tag->slug) }}"
                                        class="badge badge-warning mr-2 mb-2 p-2">
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($authors->count() > 0)
                        <div class="search-section mb-5">
                            <h3 class="section-title">
                                <i class="fas fa-user text-info mr-2"></i>
                                Tác giả ({{ $authors->count() }})
                            </h3>
                            <div class="row">
                                @foreach ($authors as $author)
                                    <div class="col-md-4 mb-3">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body text-center">
                                                <i class="fas fa-user-circle fa-2x text-info mb-2"></i>
                                                <h6 class="card-title">{{ $author->name }}</h6>
                                                <p class="card-text small text-muted">
                                                    {{ $author->email }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($posts->count() == 0 && $categories->count() == 0 && $tags->count() == 0 && $authors->count() == 0)
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Không tìm thấy kết quả nào</h4>
                            <p class="text-muted">Thử tìm kiếm với từ khóa khác</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .search-results {
            background: #fff;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 0.5rem 2rem rgba(44, 62, 80, 0.08);
        }

        .search-header {
            border-bottom: 2px solid #f8f9fa;
            padding-bottom: 1.5rem;
        }

        .search-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e9ecef;
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

        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .badge {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 1rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .badge:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
