<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Post;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $r=$this->request->all();
        $slug_validation = 'required|unique:posts|alpha_dash|min:5|max:100';


       if($r['_method'] =='PUT') {
           $urlarray = explode('/', $this->url());
           $postid = $urlarray[sizeof($urlarray) - 1];
           $post = Post::find($postid);

           if($r['slug']==$post->slug) {
               $slug_validation = 'required|alpha_dash|min:5|max:100';
           }
       }

        return [
                "slug" => $slug_validation,
                "body" =>'required|min:5',
                "title" =>'required|min:5|max:25',
                "category_id"=>'required|integer'
        ];
    }

    public function messages()
    {
        return[
          "slug.unique"=>"fan el unique ?"
        ];
    }
}
