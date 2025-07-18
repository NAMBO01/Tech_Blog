@section('main-content')
    <main>
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h1 class="hero-title">Tech Blog</h1>
                    <p class="hero-subtitle">Khám phá thế giới công nghệ qua những bài viết chất lượng</p>

                </div>
            </div>
        </section>
        <section class="featured-posts">
            <div class="container">
                <div class="section-header">
                    <h2>Bài viết nổi bật</h2>
                    <a href="#" class="view-all">Xem tất cả</a>
                </div>
                <div class="posts-grid">
                    @foreach ($posts as $post)
                        <article class="post-card">
                            <div class="post-image">
                                <a href="{{ route('posts.show', $post->slug) }}">
                                    <img src="/admin_page/img/{{ $post->cover_image_url ?? '/images/default.jpg' }}"
                                        alt="{{ $post->title }}">
                                </a>
                            </div>
                            <div class="post-content">
                                <div class="post-meta">
                                    <span class="post-category">{{ $post->category->name ?? 'Chưa phân loại' }}</span>
                                    <span class="post-date">{{ $post->created_at->format('d/m/Y') }}</span>
                                </div>
                                <h3 class="post-title">
                                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="post-excerpt">{{ Str::limit($post->excerpt ?? $post->content, 100) }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="categories-section">
            <div class="container">
                <div class="section-header">
                    <h2>Chuyên mục</h2>
                </div>
                <div class="categories-grid">
                    @foreach ($categories as $category)
                        <a href="{{ route('categories.show', $category->slug) }}" class="category-card">
                            <div class="category-icon"><i class="fas fa-folder"></i></div>
                            <h3 class="category-name">{{ $category->name }}</h3>
                            <span class="category-count">{{ $category->posts_count }} bài viết</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
