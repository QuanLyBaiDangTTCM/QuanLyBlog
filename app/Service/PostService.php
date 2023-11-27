<?php
    namespace App\Service;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\UserProfile;
use PhpParser\Node\Stmt\TryCatch;

    class PostService{
        protected $posts;
        public function __construct(Post $post)
        {
            $this->posts = $post;
        }

        public function create($params){
            try {
                return $this->posts::create($params);
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    class UserService{
        protected $users;
        public function __construct(User $user)
        {
            $this->users = $user;
        }

        public function create($params){
            try {
                return $this->users::create($params);
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    class CommentService{
        protected $comments;
        public function __construct(Comment $comment)
        {
            $this->comments = $comment;
        }

        public function create($params){
            try {
                return $this->comments::create($params);
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    class CategoryService{
        protected $categories;
        public function __construct(Category $category)
        {
            $this->categories = $category;
        }

        public function create($params){
            try {
                return $this->categories::create($params);
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

?>