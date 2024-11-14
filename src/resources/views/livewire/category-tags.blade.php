<div class="item-categories">
    <p class="char-bold">カテゴリー</p>
    <div class="tags">
        @foreach($categories as $category)
            <span 
                class="tag {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}" 
                wire:click="toggleCategory({{ $category->id }})">
                {{ $category->name }}
            </span>
        @endforeach
    </div>
    @foreach($selectedCategories as $categoryId)
        <input type="hidden" name="selectedCategories[]" value="{{ $categoryId }}">
    @endforeach
    <div class="form__error">
        @error('selectedCategories') <span>{{ $message }}</span> @enderror
    </div>
</div>