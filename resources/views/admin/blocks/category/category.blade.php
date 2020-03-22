@foreach ($parentCategory as $categoryItem)
    <option value="{{ $categoryItem->id }}"
        @isset($category->id)
            @if ($category->parent_id == $categoryItem->id)
                selected=""
            @endif         
            @if ($category->id == $categoryItem->id)
                desabled=""
            @endif   
        @endisset
        
        >{{ $delimits }}{{ $categoryItem->title }}</option>
        @isset($categoryItem->children)
            @include('admin.blocks.category.category',[
                'parentCategory'=>$categoryItem->children,
                'delimits'=>'-'.$delimits
            ])
        @endisset
@endforeach