<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BlogPost;
use App\User;
use Crypt;

class BlogPostController extends Controller
{
    //
    public function NewBlog(){
        return view('super_admin.blog.newblog');
    }
    // All Blogs
    public function AllBlogs(){
        $blogs = BlogPost::all();
        return view('super_admin.blog.allblogs',compact('blogs'));
    }
    // Delete Blog Post
    public function DeleteBlogPost(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        if (BlogPost::find($id)->delete()) {
            return response(['success' => true]);
        }else{
            return response(['success' => false]);
        }
    }
    // Upload Image
    public function UploadImage(Request $request){
        $image = parent::fileUpload(request('file'),'images/BlogContentImages');
        $response = new \StdClass;
        $response->link = "/images/BlogContentImages/" . $image;
        echo stripslashes(json_encode($response));
    }
    // Add New Blog
    public function AddNewBlog(Request $request){
        $validator = Validator::make($request->all(), [
            'title'  => 'required',
            'image_for_blog' => 'required|mimes:jpeg,bmp,png',
            'content' => 'required',
            'date_of_creation' => 'required|date',
            'sender' => 'required|email',
        ]);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $BlogPost = new BlogPost;
            $BlogPost->user_id = User::super_admin;
            $BlogPost->title = request('title');
            $BlogPost->content = request('content');
            $BlogPost->date_of_creation = request('date_of_creation');
            $BlogPost->image = parent::fileUpload(request('image_for_blog'),'images/Blogs');
            $BlogPost->sender = request('sender');
            $BlogPost->status = (request('active') == 'on' )? BlogPost::status_active : BlogPost::status_inactive;
            $BlogPost->save();
            toastr()->success('Success');
            return Redirect(route('super_admin.AllBlogs'));
        }
    }
}
