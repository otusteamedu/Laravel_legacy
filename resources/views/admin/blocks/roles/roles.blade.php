@foreach ($arrayRoles as $roleItem)
    <option value="{{ $roleItem->id }}"
        @isset($user->role_id)
            @if ($user->role_id == $roleItem->id)
                selected=""
            @endif         
        @endisset
        
        >{{ $roleItem->name }}</option>
        @isset($roleItem->children)
            @include('admin.blocks.roles.roles',[
                'parentCategory'=>$roleItem->children,
            ])
        @endisset
@endforeach