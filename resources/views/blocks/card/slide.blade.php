<div class="card">
    <div style="background-image: url({{ $card['image']?: '/img/no-image.png' }})" class="card-img-top-bg" alt="{{$card['name']}}"></div>
    <div class="card-body">
        <div class="card-title">{{$card['name']}}</div>
        <p class="card-text">
            {{ $card['text'] }}
        </p>
        <ul class="list-unstyled list-params">
            <li><span class="list-params--key"><?=__('messages.card.name')?>:</span> <span class="list-params--value">{{ $card['author'] }}</span></li>
            <li><span class="list-params--key"><?=__('messages.card.city')?>:</span> <span class="list-params--value">{{ $card['city'] }}</span></li>
            <li><span class="list-params--key"><?=__('messages.card.date')?>:</span> <span class="list-params--value">{{ date('d.m.Y H:i:s', $card['datetime']) }}</span></li>
        </ul>
        <a href="#" class="btn btn-primary"><?=__('messages.card.pick')?></a>
    </div>
</div>