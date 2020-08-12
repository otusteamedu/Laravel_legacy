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
        </small>
    </td>
    <td>
        @if ($film->status == '1')
            {{__('messages.filmStatusPublished')}}
        @elseif ($film->status == '0')
            {{__('messages.filmStatusNotPublished')}}
        @endif
    </td>
    <td>
        {{ $film->meta_title }}
    </td>
    <td class="project_progress">
        {{ $film->keywords }}

    </td>
    <td class="project-state">
        {{ $film->slug }}

    </td>
    <td class="project-actions text-right">

        <a class="btn btn-info btn-sm" href="{{ App\Helpers\RouteBuilder::localeRoute('cms.films.edit', ['film' => $film]) }}">
            <i class="fas fa-pencil-alt">
            </i>
            {{__('messages.filmEdit')}}
        </a>
        {{ Form::model($film, ['url' => App\Helpers\RouteBuilder::localeRoute('cms.films.destroy', ['film' => $film]), 'method' => 'delete']) }}
            <button onclick ="return confirm(' Вы уверены?')" type ="submit" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i>
            </button>
        {{ Form::close() }}
    </td>

 </tr>
