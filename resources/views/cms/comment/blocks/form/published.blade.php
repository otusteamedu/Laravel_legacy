<div class="modal fade" id="publishedModal" tabindex="-1" role="dialog" aria-labelledby="publishedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('cms.comment.title.published')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{__('cms.comment.annotation.published')}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cms.actions.close')}}</button>
                {{Form::open(['url' => route('cms.comments.update', ['comment' => $comment->id]), 'method'=>'PUT'])}}
                {{Form::hidden('action','published')}}
                {{Form::submit(__('cms.actions.published'), ['class' => 'btn btn-primary'])}}
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>