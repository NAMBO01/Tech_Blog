@extends('template.template_user')

@section('main-content')
    <div class="container py-5">
        <h2 class="mb-4"><i class="fas fa-bookmark text-primary"></i> Bài viết đã lưu</h2>
        @if ($posts->count() > 0)
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none text-dark">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted">{{ Str::limit($post->summary, 120) }}</p>
                                <div class="card-meta">
                                    <small class="text-muted"><i class="fas fa-user mr-1"></i>
                                        {{ $post->author->name }}</small>
                                    <small class="text-muted ml-3"><i class="fas fa-folder mr-1"></i>
                                        {{ $post->category->name }}</small>
                                    <small class="text-muted ml-3"><i class="fas fa-calendar mr-1"></i>
                                        {{ $post->created_at->format('d/m/Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $posts->links() }}
        @else
            <div class="text-center py-5">
                <i class="fas fa-bookmark fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">Bạn chưa lưu bài viết nào</h4>
            </div>
        @endif
    </div>
@endsection
