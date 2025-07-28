<div class="comment-item d-flex align-items-start mb-4">
    <img src="{{ $comment->user->avatar_url ?? asset('admin_page/img/undraw_profile.svg') }}" class="comment-avatar mr-3"
        alt="avatar">
    <div class="comment-content-box">
        <div class="d-flex align-items-center mb-1">
            <span class="comment-author">{{ $comment->user->name ?? 'Ẩn danh' }}</span>
            <span class="comment-time">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="comment-content">{{ $comment->content }}</div>
    </div>
</div>
