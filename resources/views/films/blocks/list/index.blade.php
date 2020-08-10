
@include('films.blocks.list.header', ['films' => $films])
<div class="items">
    @each('films.blocks.list.item', $films, 'film')
</div>
