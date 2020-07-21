<?php
/**
 * @var string $name - name select'a
 * @var array $rows - Массив с вариантами селекта
 * @var string $key - ключи со значением
 * @var string $key_name - ключ с именем
 * @var $selected - значение с помошью которого будет выбран селект
 */
?>

<select class="form-control" name="{{ $name }}">
    @forelse($rows as $row)
        <option value="{{ $row->id }}"
            {{ $row[$key] == $selected ? "selected" : "" }}>
            {{ $row[$key_name] }}
        </option>
    @empty
        <option value="null" disabled>Ошибка загрузки</option>
    @endforelse
</select>
