<ul class="collapsible hide-on-med-and-down">
    @foreach($categories as $category)
        <li>
            <div class="collapsible-header flex"><img src="{{$category->icon}}"/> <span style="margin-left: 3px;">{{$category->name}}</span></div>
            <div class="collapsible-body">
                @foreach($category->children as $child)
                    <a href="{{route('board', ['childId' => $child->id])}}">{{$child->name}}</a>
                    <span class="grey-text">({{$child->ads_count}})</span>

                    <hr>
                @endforeach
            </div>
        </li>
    @endforeach
</ul>
<ul id="nav-mobile1" class="sidenav" style="z-index: 9999">
    <ul class="collapsible">
        @foreach($categories as $category)
            <li>
                <div class="collapsible-header flex"><img src="{{$category->icon}}"/> <span style="margin-left: 3px;">{{$category->name}}</span></div>
                <div class="collapsible-body">
                    @foreach($category->children as $child)
                        <a href="{{route('board', ['childId' => $child->id])}}">{{$child->name}}</a>
                        <span class="grey-text">({{$child->ads_count}})</span>
                        <hr>
                    @endforeach
                </div>
            </li>
        @endforeach
    </ul>
</ul>
