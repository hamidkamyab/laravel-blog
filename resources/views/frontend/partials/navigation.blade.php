<ul class="navbar-nav w-100">
    @foreach ($categories as $category)
        <li class="nav-item  accordion">
            {{-- <div id="drop-menu" class="drop-menu collapse">
                <a class="d-block " href="index-2.html">Home 2</a>
                <a class="d-block " href="category.html">Category</a>
                <a class="d-block " href="post-details.html">Post Details</a>
                <a class="d-block " href="privacy.html">Privacy &amp; Policy</a>
            </div> --}}
            <a class="nav-link text-white" href="#!" role="button" data-toggle="collapse"
                data-target="#drop-menu" aria-expanded="false" aria-controls="drop-menu">{{$category->title}}</a>
        </li>
    @endforeach
    {{-- <li class="nav-item active">
        <a class="nav-link text-white px-0 pt-0" href="index.html">Home</a>
    </li> --}}
    <li class="nav-item mt-3">
        <select class="custom-select bg-transparent rounded-0 text-white shadow-none" id="pick-lang">
            <option selected value="en">English</option>
            <option value="fr">French</option>
        </select>
    </li>
</ul>


