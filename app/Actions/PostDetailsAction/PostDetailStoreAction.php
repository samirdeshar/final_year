<?php
namespace App\Actions\PostDetailsAction;

use Illuminate\Http\Request;
use App\Models\Admin\Post\Post;
use App\Models\PostDetail;

class PostDetailStoreAction{

    protected $post;
    protected $request;
    public function __construct(Request $request,Post $post)
    {
        $this->request=$request;
        $this->post=$post;
    }

    public function store()
    {
        $temp=[];
        if($this->request->heading[0])
        {
            $loopCount=count($this->request->heading);
           
            for($i=0;$i<$loopCount;$i++)
            {
                $temp[]=[
                    'post_id'=>$this->post->id,
                    'heading'=>$this->request->heading[$i],
                    'description'=>$this->request->description1[$i],
                ];
            }
            PostDetail::insert($temp);
        }
    }

}
?>