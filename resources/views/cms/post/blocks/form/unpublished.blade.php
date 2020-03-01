<div class="modal fade" id="unpublishedModal" tabindex="-1" role="dialog" aria-labelledby="unpublishedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('cms.post.title.unpublished')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{__('cms.post.annotation.unpublished')}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cms.actions.close')}}</button>
                {{Form::open(['url' => route('cms.posts.published', ['post' => $post->id, 'locale' => $locale]), 'method'=>'PUT'])}}
                {{Form::hidden('action','unpublished')}}
                {{Form::submit(__('cms.actions.unpublished'), ['class' => 'btn btn-danger'])}}
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>