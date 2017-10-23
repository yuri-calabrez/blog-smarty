@forelse($posts as $post)
    <article class="blog-post-item{{$col}}">

        <!-- IMAGE -->
        <figure class="margin-bottom-20">
            <img class="img-responsive"
                 src="{{$post->cover ? '/uploads/posts/'.$post->cover : '/images/no_image.jpg'}}"
                 alt="{{$post->title}}"/>
        </figure>

        <h2><a href="blog-single-default.html">{{$post->title}}</a></h2>

        <ul class="blog-post-info list-inline">
            <li>
                <a href="#">
                    <i class="fa fa-clock-o"></i>
                    <span class="font-lato">{{$post->post_date}}</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-comment-o"></i>
                    <span class="font-lato">0 Comentários</span>
                </a>
            </li>
            <li>
                <i class="fa fa-folder-open-o"></i>

                <a class="category" href="{{route('blog.category', ['slug' => $post->category->slug])}}">
                    <span class="font-lato">{{$post->category->name}}</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span class="font-lato">{{$post->author->name}}</span>
                </a>
            </li>
        </ul>

        {!! str_limit($post->content, 300) !!}
        <div class="clearfix"></div>
        <a href="{{route('blog.post', ['slug' => $post->slug])}}" class="btn btn-reveal btn-default">
            <i class="fa fa-plus"></i>
            <span>Continue lendo</span>
        </a>
    </article>
    @if($loop->iteration % 2 == 0)
        <div class="clearfix"></div>
    @endif
@empty
    <div class="alert alert-info">Ainda não existem posts :( Volte mais tarde.</div>
@endforelse

<!-- PAGINATION -->
<div class="text-right">
    <!-- Pagination Default -->
{!! $posts->links() !!}
<!-- /Pagination Default -->
</div>