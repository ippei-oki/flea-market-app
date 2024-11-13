<div class="like-section">
    <img src="{{ asset($isLiked ? 'storage/icon_images/like_add.jpg' : 'storage/icon_images/like_std.jpg') }}"
         alt="Like Icon"
         wire:click="toggleLike"
         style="cursor: pointer;">
    <p>{{ $likeCount }}</p>
</div>