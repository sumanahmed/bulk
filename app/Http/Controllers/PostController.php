<?php

namespace Bulkly\Http\Controllers;

use Illuminate\Http\Request;
use Bulkly\BufferPosting;
use Bulkly\SocialPostGroups;
use Response;

class PostController extends Controller
{
    public function index(){

        $post_groups    = SocialPostGroups::all();
        $postings       = BufferPosting::join('social_post_groups','social_post_groups.id','buffer_postings.group_id')
                                        ->join('social_accounts','social_accounts.id','buffer_postings.account_id')
                                        ->join('social_posts','social_posts.id','buffer_postings.post_id')
                                        ->selectRaw('social_post_groups.name as group_name, 
                                                               social_post_groups.type as group_type,
                                                               social_accounts.avatar as account_name,
                                                               social_posts.text as post_text,
                                                               buffer_postings.created_at as time
                                        ')
                                       ->paginate(10);

        return view('pages.postings',compact('post_groups','postings'));
    }

    public function filter(Request $request){

        $search     = isset($request->search) ? $request->search : null;
        $date       = isset($request->date) ? $request->date : null;
        $group_id   = isset($request->group_id) ? $request->group_id : null;

        $post_groups    = SocialPostGroups::all();
        $postings       = BufferPosting::join('social_post_groups','social_post_groups.id','buffer_postings.group_id')
                            ->join('social_accounts','social_accounts.id','buffer_postings.account_id')
                            ->join('social_posts','social_posts.id','buffer_postings.post_id')
                            ->selectRaw('social_post_groups.name as group_name, 
                                       social_post_groups.type as group_type,
                                       social_accounts.avatar as account_name,
                                       social_posts.text as post_text,
                                       buffer_postings.created_at as time
                            ')
                            ->when($search != null, function ($query) use ($search) {
                                return $query->where('social_post_groups.name', 'like', '%' .$search . '%');
                            })
                            ->when($date != null, function ($query) use ($date) {
                                return $query->whereDate('buffer_postings.created_at', date("Y-m-d", strtotime($date)));
                            })
                            ->when($group_id != null, function ($query) use ($group_id) {
                                return $query->where('buffer_postings.group_id', $group_id);
                            })
                            ->paginate(10);

        return view('pages.postings',compact('post_groups','postings','group_id','date'));
    }

}
