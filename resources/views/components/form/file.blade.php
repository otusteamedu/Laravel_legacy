<div class="file">
    <label class="file-label">
        {{ Form::file($name, ['class' => 'file-input']) }}
        <span class="file-cta">
          <span class="file-icon">
            <i class="fas fa-upload"></i>
          </span>
          <span class="file-label">
            {{ __($transKey) }}
          </span>
        </span>
    </label>
</div>
