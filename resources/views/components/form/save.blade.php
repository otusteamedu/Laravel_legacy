<nav class="level sticky-footer">
    <div class="level-left">
        <div class="level-item">
            <div class="field">
                <button type="submit" class="button is-link">
                    {{ $text }}
                </button>
            </div>
        </div>
        <div class="level-item" style="padding-left: 20px">
            {{ link_to($cancelUrl, __('nav.cancel'), [], ['class' => 'is-size-7']) }}
        </div>
    </div>
</nav>
