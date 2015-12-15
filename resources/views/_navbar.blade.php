<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">

            <li @if(isset($homeNav)) class='active' @endif>
                <a href="{{ url('home') }}">
                    <span class="glyphicon glyphicon-home"></span>
                </a>
            </li>

            @foreach($categories as $category)
                <li @if(isset($categoryIdNav) && $categoryIdNav == $category->id) class="active" @endif>
                    <a href="{{ action('CategoryController@show', [$category->id]) }}">{{ $category->name }}</a>
                </li>
            @endforeach

        </ul>
    </div>
</nav>