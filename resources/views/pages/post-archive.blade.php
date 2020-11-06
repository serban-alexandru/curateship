@extends('site1.layouts.app')
@section('content')
<section class="margin-top-md">
    <div class="container max-width-adaptive-lg">
      <p class="text-xl margin-bottom-md">{{ $page_title }}</p>
      <ul class="grid-auto-md gap-md">
      @foreach($posts as $key => $post)
        <li>
          <a href="#0" class="card-v8 bg radius-lg">
            <figure>
              @if($post->thumbnail)
                <img src="{{ $post->showThumbnail() }}" alt="Image of {{ $post->title }}">
              @else
                <img src="{{ asset('assets/img/author-img-1.jpg') }}" alt="Image description">
              @endif
            </figure>

            <footer class="padding-sm">
              <p class="text-sm color-contrast-medium margin-bottom-sm">
                @php
                    $tag_categories = Modules\Tag\Entities\TagCategory::all();
                    $posts_tags     = $post->postsTag;
                @endphp
                @foreach($tag_categories as $key => $tag_category)
                    @php
                        $show_category = false;

                        foreach($posts_tags as $post_tag){
                            $tag = Modules\Tag\Entities\Tag::find($post_tag->tag_id);

                            if($tag->tag_category_id === $tag_category->id){
                                $show_category = true;
                                break;
                            }
                        }
                    @endphp

                    @if($show_category)
                        @if($key > 0)
                            ,
                        @endif
                        {{ $tag_category->name }}
                    @endif
                @endforeach
              </p>
              <div class="text-component">
                <h4>
                  <span class="card-v8__title text-sm">
                    {{ $post->title }}
                  </span>
                </h4>
              </div>
            </footer>
          </a>
        </li>
      @endforeach
      </ul>
    </div>
  </section>
@endsection