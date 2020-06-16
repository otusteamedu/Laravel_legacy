<?php /** @var \App\Models\Film $film */ ?>
<tr>
    <td>
        {{ $film->id }}
    </td>
    <td>
        <a>
            {{ $film->title }}
        </a>
        <br>
        <small>
            Created 01.01.2019
        </small>
    </td>
    <td>
        {{ $film->meta_title }}
    </td>
    <td class="project_progress">
        {{ $film->meta_keywords }}

    </td>
    <td class="project-state">
        {{ $film->slug }}

    </td>
    <td class="project-actions text-right">


        <a class="btn btn-info btn-sm" href="{{ route('cms.films.edit', ['film' => $film]) }}">
            <i class="fas fa-pencil-alt">
            </i>
            {{__('messages.filmEdit')}}
        </a>
        {{ Form::open(['route'=>['cms.films.destroy', $film],'method'=>'delete']) }}
            <button onclick ="return confirm(' Вы уверены?')" type ="submit" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i>
            </button>
        {{ Form::close() }}
    </td>

 </tr>
