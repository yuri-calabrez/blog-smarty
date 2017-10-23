@extends('layouts.blog')

@section('content')
    <h1 class="blog-post-title">{{$post->title}}</h1>
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
                <span class="font-lato">0 comentários</span>
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

    <figure class="margin-bottom-20">
        <img class="img-responsive"
             src="{{$post->cover ? '/uploads/posts/'.$post->cover : '/images/no_image.jpg'}}" alt="{{$post->title}}"/>
    </figure>

    <!-- article content -->
    {!! $post->content !!}
    <!-- article content -->

    <div class="divider divider-dotted"><!-- divider --></div>

    <!-- TAGS -->
    @if($post->tags)
        @foreach($post->tags as $tag)
            <a class="tag" href="#">
                <span class="txt">{{$tag->name}}</span>
                <span class="num">{{$tag->posts()->count()}}</span>
            </a>
        @endforeach
    @endif
    <!-- /TAGS -->

    <!-- SHARE POST -->
    <div class="clearfix margin-top-30">

        <span class="pull-left margin-top-6 bold hidden-xs">
            Compartilhe este post:
        </span>

        <a href="#" class="social-icon social-icon-sm social-icon-transparent social-facebook pull-right"
           data-toggle="tooltip" data-placement="top" title="Facebook">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-facebook"></i>
        </a>

        <a href="#" class="social-icon social-icon-sm social-icon-transparent social-twitter pull-right"
           data-toggle="tooltip" data-placement="top" title="Twitter">
            <i class="fa fa-twitter"></i>
            <i class="fa fa-twitter"></i>
        </a>

        <a href="#" class="social-icon social-icon-sm social-icon-transparent social-gplus pull-right"
           data-toggle="tooltip" data-placement="top" title="Google plus">
            <i class="fa fa-google-plus"></i>
            <i class="fa fa-google-plus"></i>
        </a>

        <a href="#" class="social-icon social-icon-sm social-icon-transparent social-linkedin pull-right"
           data-toggle="tooltip" data-placement="top" title="Linkedin">
            <i class="fa fa-linkedin"></i>
            <i class="fa fa-linkedin"></i>
        </a>

    </div>
    <!-- /SHARE POST -->

    <div class="divider"><!-- divider --></div>

    <!-- COMMENTS -->
    <div id="comments" class="comments">

        <h4 class="page-header margin-bottom-60 size-20">
            <span>3</span> COMMENTS
        </h4>

        <!-- comment item -->
        <div class="comment-item">

            <!-- user-avatar -->
            <span class="user-avatar">
										<img class="pull-left media-object" src="assets/images/avatar.png" width="64" height="64" alt="">
									</span>

            <div class="media-body">
                <a href="#commentForm" class="scrollTo comment-reply">reply</a>
                <h4 class="media-heading bold">John Doe</h4>
                <small class="block">June 29, 2014 - 11:23</small>
                Proin eget tortor risus. Cras ultricies ligula sed magna dictum porta. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </div>
        </div>

        <!-- comment item -->
        <div class="comment-item">

            <!-- user-avatar -->
            <span class="user-avatar">
										<img class="pull-left media-object" src="assets/images/avatar.png" width="64" height="64" alt="">
									</span>

            <div class="media-body">
                <a href="#commentForm" class="scrollTo comment-reply">reply</a>
                <h4 class="media-heading bold">Diana Doe</h4>
                <small class="block">June 29, 2014 - 11:23</small>
                Proin eget tortor risus. Cras ultricies ligula sed magna dictum porta. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </div>
        </div>

        <!-- comment item -->
        <div class="comment-item">

            <!-- user-avatar -->
            <span class="user-avatar">
										<img class="media-object" src="assets/images/avatar.png" width="64" height="64" alt="">
									</span>

            <div class="media-body">
                <a href="#commentForm" class="scrollTo comment-reply">reply</a>
                <h4 class="media-heading bold">Melissa Doe</h4>
                <small class="block">June 29, 2014 - 11:23</small>
                Proin eget tortor risus. Cras ultricies ligula sed magna dictum porta. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.

                <!-- comment reply -->
                <div class="media">

                    <!-- user-avatar -->
                    <span class="user-avatar">
												<img class="media-object" src="assets/images/avatar.png" width="64" height="64" alt="">
											</span>

                    <div class="media-body">
                        <h4 class="media-heading bold">Peter Doe</h4>
                        <small class="block">June 29, 2014 - 11:23</small>
                        Proin eget tortor risus. Cras ultricies ligula sed magna dictum porta. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </div>
                </div>

            </div>
        </div>



        <h4 class="page-header size-20 margin-bottom-60 margin-top-100">
            LEAVE A <span>COMMENT</span>
        </h4>

        <!-- Form -->
        <form action="#" method="post">

            <div class="row">
                <div class="form-group">
                    <div class="col-md-4">
                        <label>NAME</label>
                        <input required="required" type="text" value="" maxlength="100" class="form-control input-lg" name="author" id="author">
                    </div>
                    <div class="col-md-4">
                        <label>EMAIL</label>
                        <input required="required" type="email" value="" maxlength="100" class="form-control input-lg" name="contact_email" id="contact_email">
                    </div>
                    <div class="col-md-4">
                        <label>WEBSITE</label>
                        <input type="email" value="" maxlength="100" class="form-control input-lg" name="url" id="url">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label>COMMENT</label>
                        <textarea required="required" maxlength="5000" rows="5" class="form-control" name="comment" id="comment"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <button class="btn btn-3d btn-lg btn-reveal btn-black">
                        <i class="fa fa-check"></i>
                        <span>SUBMIT MESSAGE</span>
                    </button>

                </div>
            </div>

        </form>
        <!-- /Form -->

    </div>
    <!-- /COMMENTS -->

@endsection