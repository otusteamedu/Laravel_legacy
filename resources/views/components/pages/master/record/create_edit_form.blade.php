<?php
/**
 * @var \App\Models\Record $record
 * @var \Illuminate\Support\Collection $clients
 * @var int $clientId
 */
$carbonDate = new \Carbon\Carbon();
$dateNow = $carbonDate->format('Y-m-d');
$timeNow = $carbonDate->format('H:i');

$dateStartFormat  = !isset($record) ? $dateNow : $record->date_start->format('Y-m-d');
$timeStartFormat  = !isset($record) ? $timeNow : $record->date_start->format('H:i');
$timeFinishFormat = !isset($record) ? $timeNow : $record->date_finish->format('H:i');
$price = !isset($record) ? '' : $record->price;

$clientsData = [];
$clients = $clients->all();
/** @var \App\Models\User $client */
foreach ($clients as $client) {
    $clientsData[] = [
        'text' => sprintf('%s %s [%s]', $client->first_name, $client->last_name, $client->id),
        'id' => $client['id'],
        'icon' => null // TODO add picture
    ];
}
?>

<div class="row">
    <form method="post">
        @csrf
        <div class="input-field col s12 l6">
            <select class="icons" name="client_id">
                <option value="0" disabled>Выберите клиента</option>
                @foreach($clientsData as $client)
                    <option value="{{ $client['id'] }}" @if($clientId === $client['id']) selected @endif data-icon="">
                        {{ $client['text'] }}
                    </option>
                @endforeach
            </select>
            <label>Клиент</label>
        </div>

        <div class="input-field col s12 l6">
            <input type="text" class="datepicker" id="datepicker" name="date" value="{{ $dateStartFormat }}"/>
            <label for="datepicker">Дата</label>
        </div>

        <div class="input-field col s12 l6">
            <input type="text" class="timepicker-start" id="timepicker-start" name="time_start" value="{{ $timeStartFormat }}"/>
            <label for="timepicker-start">Время начала</label>
        </div>

        <div class="input-field col s12 l6">
            <input type="text" class="timepicker-end" id="timepicker-end" name="time_finish" value="{{ $timeFinishFormat }}"/>
            <label for="timepicker-end">Время окончания</label>
        </div>

        <div class="input-field col s12 l6">
            <input type="text" id="price" name="price" value="{{ $price }}" placeholder="1000"/>
            <label for="price">Цена</label>
        </div>

        <div class="input-field col s12">
            <button type="submit" class="waves-effect waves-light btn pink">{{ $button_text }}</button>
        </div>
    </form>
</div>
