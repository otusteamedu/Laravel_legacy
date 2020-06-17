<?php /** @var \App\Models\Page $page */ ?>
<tr>
    <td>
        {{ $page->id }}
    </td>
    <td>
        <a>
            {{ $page->title }}
        </a>
        <br>
        <small>
        </small>
    </td>
    <td>
        {{ $page->meta_title }}
    </td>
    <td class="project_progress">
        {{ $page->meta_keywords }}

    </td>
    <td class="project-state">
        {{ $page->slug }}

    </td>
    <td class="project-actions text-right">


        <a class="btn btn-info btn-sm" href="{{ route('cms.pages.edit', ['page' => $page]) }}">
            <i class="fas fa-pencil-alt">
            </i>
            {{__('messages.pageEdit')}}
        </a>
        {{ Form::open(['route'=>['cms.pages.destroy', $page],'method'=>'delete']) }}
            <button onclick ="return confirm(' Вы уверены?')" type ="submit" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i>
            </button>
        {{ Form::close() }}
    </td>

 </tr>
