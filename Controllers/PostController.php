<?php
  //コントローラーからモデルを呼び出す
  require_once(ROOT_PATH .'Models/Post.php');
  require_once(ROOT_PATH .'Models/User.php');
  require_once(ROOT_PATH .'Models/prefecture.php');



  class PostController {
    //プロパティ(インスタンスが持つデータ)
    private $request;  //リクエストパラメータ(GET,POST)
    private $Post;
    private $User;
    private $Pref;

    public function __construct() {
      //リクエストパラメータの取得
      $this->request['get'] = $_GET;
      $this->request['post'] = $_POST;
      //モデルオブジェクトの作成
      $this->Post = new Post();

      $dbh = $this->Post->get_db_handler();
      $this->User = new User($dbh);
      $this->Pref = new Pref($dbh);
    }

    public function index() {
      $page = 0;
      if(isset($this->request['get']['page'])) {
        $page = $this->request['get']['page'];
      }

      $posts = $this->Post->findAll($page);
      $posts_count = $this->Post->countAll();
      $params = [
        'posts' => $posts,
        'pages' => $posts_count / 5
      ];
      return $params;
    }

    public function mgmt() {
      $m_posts = $this->Post->m_findAll();
      $m_params = [
        'm_posts' => $m_posts
      ];
      return $m_params;
    }

    public function edit() {
      if(empty($this->request['get']['id'])){
        echo "指定のパラメータが不正です。このページを表示できません。";
        exit;
      }
      $edit = $this->Post->u_edit($this->request['get']['id']);
      $params_e = [
        'edit' => $edit
      ];
      return $params_e;
    }

    public function mEdit() {
      if(empty($this->request['get']['id'])){
        echo "指定のパラメータが不正です。このページを表示できません。";
        exit;
      }
      $m_edit = $this->Post->m_edit($this->request['get']['id']);
      $e_params = [
        'm_edit' => $m_edit
      ];
      return $e_params;
    }


    public function update() {
      if(empty($this->request['get']['id'])) {
        echo '指定のパラメーターが不正です。このページを表示できません。';
        exit;
      }
      $update = $this->Post->update($this->request['get']['id']);
      return $update;
    }

    public function m_update() {
      if(empty($this->request['get']['id'])) {
        echo '指定のパラメーターが不正です。このページを表示できません。';
        exit;
      }
      $update = $this->Post->m_update($this->request['get']['id']);
      return $update;
    }

    public function delete() {
      if(empty($this->request['get']['id'])) {
        echo '指定のパラメーターが不正です。このページを表示できません。';
        exit;
      }
      $delete = $this->Post->deleteById($this->request['get']['id']);
      return $delete;
    }

    public function users_update() {
      $users_update = $this->Post->usersUpdate();
    }

    public function register() {
      $register = $this->User->userRegister();
    }

    public function login() {
   $login = $this->User->log_in();
   }

   public function created() {
     $create = $this->Post->create();
     }

   public function params_created() {
     if(empty($this->request['get']['id'])){
       echo "指定のパラメータが不正です。このページを表示できません。";
       exit;
     }
     $params_create = $this->Post->create($this->request['get']['id']);
     $params_c = [
       'create' => $create
     ];
     return $params_c;
   }

   public function m_created() {
     $m_create = $this->Post->m_create();
     }

   public function edit_pref() {
     $prefectures = $this->Pref->findPrefectures();
     $params_p = [
       'prefectures' => $prefectures
     ];
     return $params_p;
   }

   public function new_pass() {
  $new_pass = $this->User->new_password();
  }

  }
 ?>
