<div class="modal fade" id="destroyModal" tabindex="-1" role="dialog" aria-labelledby="destroyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('cms.rubric.title.destroy')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{__('cms.rubric.annotation.destroy')}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cms.actions.close')}}</button>
                {{Form::open(['url' => route('cms.rubrics.destroy', ['rubric' => $rubric->id]), 'method'=>'DELETE'])}}
                    {{Form::submit(__('cms.actions.destroy'), ['class' => 'btn btn-danger'])}}
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>