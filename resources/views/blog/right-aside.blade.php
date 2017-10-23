@inject('categories', "App\Models\Category")
@inject('postsInject', "App\Models\Post")
<!-- INLINE SEARCH -->
<div class="inline-search clearfix margin-bottom-30">
    <form action="{{route('blog.search')}}" method="get" class="widget_search">
        <input type="search" placeholder="Digite alguma coisa..." id="search" name="search" class="serch-input">
        <button type="submit">
            <i class="fa fa-search"></i>
        </button>
    </form>
</div>
<!-- /INLINE SEARCH -->

<hr/>

<!-- side navigation -->
<div class="side-nav margin-bottom-60 margin-top-30">

    <div class="side-nav-head">
        <button class="fa fa-bars"></button>
        <h4>Categorias</h4>
    </div>
    <ul class="list-group list-group-bordered list-group-noicon uppercase">
        @php
            $categories = $categories->all()->filter(function($category){
                return $category->posts()->count() > 0;
            });
        @endphp

        @foreach($categories as $category)
            <li class="list-group-item">
                <a href="{{route('blog.category', ['slug' => $category->slug])}}">
                    <span class="size-11 text-muted pull-right">({{$category->posts()->count()}}
                        )</span> {{$category->name}}
                </a>
            </li>
        @endforeach

    </ul>
    <!-- /side navigation -->


</div>


<!-- JUSTIFIED TAB -->
<div class="tabs nomargin-top hidden-xs margin-bottom-60">

    <!-- tabs -->
    <ul class="nav nav-tabs nav-bottom-border nav-justified">
        <li class="active">
            <a href="#tab_1" data-toggle="tab">
                Popular
            </a>
        </li>
    </ul>

    <!-- tabs content -->
    <div class="tab-content margin-bottom-60 margin-top-30">

        <!-- POPULAR -->
        <div id="tab_1" class="tab-pane active">
            @php
                $posts = $postsInject->where('views', '>', 0)->take(5)->get();
            @endphp

            @foreach($posts as $postUnique)
                <div class="row tab-post"><!-- post -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <a href="{{route('blog.post', ['slug' => $postUnique->slug])}}"
                           class="tab-post-link">{{$postUnique->title}}</a>
                        <small>{{$postUnique->post_date}}</small>
                    </div>
                </div><!-- /post -->
            @endforeach
        </div>
        <!-- /POPULAR -->
    </div>

</div>
<!-- JUSTIFIED TAB -->
