<div class="card post">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">
                    @lang('app.postForm.write_post_label')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">
                    @lang('app.postForm.post_image_label')
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                <div class="form-group">
                    <label class="sr-only" for="message">@lang('app.postForm.write_post_label')</label>
                    <textarea class="form-control" id="message" rows="3" placeholder="@lang('app.postForm.write_post_placeholder')"></textarea>
                </div>

            </div>
            <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">@lang('app.postForm.post_image_label')</label>
                    </div>
                </div>
                <div class="py-4"></div>
            </div>
        </div>
        <div class="btn-toolbar justify-content-between">
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">@lang('app.postForm.send')</button>
            </div>
        </div>
    </div>
</div>
