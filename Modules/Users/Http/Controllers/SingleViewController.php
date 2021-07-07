<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Page\Entities\Page;
use Modules\Post\Entities\Post;

class SingleViewController extends Controller
{
  public function singlePostView($slug) {
    // Get Post by slug
    $post = Post::firstWhere([
      'slug'      => $slug,
      'status'    => 'published'
    ]);

    if ( !$post ) {
      abort(404);
    }

    $post['description'] = Post::parseContent($post['description']);

    $data['post']       = $post;
    $data['page_title'] = $post->title;

    return view('templates.layouts.post', $data);
  }

  public function singlePageView($slug) {
    // Get Page by slug
    $page = Page::firstWhere([
      'slug'         => $slug,
      'is_published' => true,
      'is_pending'   => false,
      'is_deleted'   => false,
      'is_rejected'  => false
    ]);

    if ( !$page ) {
      abort(404);
    }

    $page['description'] = Page::parseContent($page['description']);

    $data['page']       = $page;
    $data['page_title'] = $page->title;

    return view('templates.layouts.page', $data);
  }

  public function singleViewbyTheme($theme, $prefix, $slug) {
    if ( $prefix == "page") {
      // Get Page by slug.
      $page = Page::firstWhere([
        'slug'         => $slug,
        'is_published' => true,
        'is_pending'   => false,
        'is_deleted'   => false,
        'is_rejected'  => false
      ]);

      if ( $page ) {
        $page['description'] = Page::parseContent($page['description']);
        
        $data['page']       = $page;
        $data['page_title'] = $page->title;
        $data['theme']      = $theme;

        return view('page::templates.page-template-v1', $data);
      }
    } else if ( $prefix == "post" ) {
      // Get Post by slug.
      $post = Post::firstWhere([
        'slug'      => $slug,
        'status'    => 'published'
      ]);

      if ( $post ) {
        $post['description'] = Post::parseContent($post['description']);
    
        $data['post']       = $post;
        $data['page_title'] = $post->title;
        $data['theme']      = $theme;
    
        return view('post::templates.post-template-v1', $data);    
      }
    }

    abort(404);
  }
}
