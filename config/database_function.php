<?php
require 'database.php';

// postcreate_function
function getUsers($pdo) {
    return $pdo->query("SELECT id, username FROM users")->fetchAll();
}

function getModules($pdo) {
    return $pdo->query("SELECT id, name FROM modules")->fetchAll();
}

function createPost($pdo, $title, $content, $user_id, $module_id, $imagePath) {
    $sql = "INSERT INTO posts (title, content, user_id, module_id, image)
            VALUES (:title, :content, :user, :module, :image)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title'   => $title,
        ':content' => $content,
        ':user'    => $user_id ?: null,
        ':module'  => $module_id ?: null,
        ':image'   => $imagePath
    ]);
}

// postedit_function
function getPostById($pdo, $id) {
    $sql = "SELECT posts.*, users.username, modules.name AS module_name
            FROM posts
            LEFT JOIN users ON posts.user_id = users.id
            LEFT JOIN modules ON posts.module_id = modules.id
            WHERE posts.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function updatePost($pdo, $id, $title, $content, $user_id, $module_id, $imagePath) {
    $sql = "UPDATE posts 
            SET title = :title, content = :content,
                user_id = :user, module_id = :module,
                image = :image
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title'   => $title,
        ':content' => $content,
        ':user'    => $user_id ?: null,
        ':module'  => $module_id ?: null,
        ':image'   => $imagePath,
        ':id'      => $id
    ]);
}

// postdelete_function
function getPostImage($pdo, $id) {
    $stmt = $pdo->prepare("SELECT image FROM posts WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetchColumn();
}

function deletePost($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$id]);
}

// index_function
function getAllPosts($pdo) {
    $sql = "SELECT posts.*, users.username, modules.name AS module_name
            FROM posts
            LEFT JOIN users ON posts.user_id = users.id
            LEFT JOIN modules ON posts.module_id = modules.id
            ORDER BY posts.created_at DESC";
    return $pdo->query($sql)->fetchAll();
}
// user_function
function getAllUsers($pdo) {
    return $pdo->query("SELECT * FROM users ORDER BY created_at DESC")->fetchAll();
}
// user_create_function
function createUser($pdo, $username, $email, $password, $role) {
    $sql = "INSERT INTO users (username, email, password, role)
            VALUES (:u, :e, :p, :r)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':u' => $username,
        ':e' => $email,
        ':p' => password_hash($password, PASSWORD_DEFAULT),
        ':r' => $role
    ]);
}
// user_delete_function
function deleteUser($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
}

function getUserById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}
// user_update_function
function updateUser($pdo, $id, $username, $email, $password, $role) {
    $sql = "UPDATE users SET username = :u, email = :e, role = :r"
         . (empty($password) ? '' : ", password = :p")
         . " WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $params = [
        ':u'   => $username,
        ':e'   => $email,
        ':r'   => $role,
        ':id'  => $id
    ];
    if (!empty($password)) {
        $params[':p'] = password_hash($password, PASSWORD_DEFAULT);
    }
    $stmt->execute($params);
}
// module_function
function getAllModules($pdo) {
    return $pdo->query("SELECT * FROM modules ORDER BY name")->fetchAll();
}
// module_create_function
function createModule($pdo, $name) {
    $stmt = $pdo->prepare("INSERT INTO modules (name) VALUES (?)");
    $stmt->execute([$name]);
}
// module_delete_function
function deleteModule($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM modules WHERE id = ?");
    $stmt->execute([$id]);
}
// module_edit_function
function getModuleById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM modules WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function updateModule($pdo, $id, $name) {
    $stmt = $pdo->prepare("UPDATE modules SET name = ? WHERE id = ?");
    $stmt->execute([$name, $id]);
}
// userreply_function
function getUsersForDropdown($pdo) {
    return $pdo->query("SELECT id, username, email FROM users ORDER BY username")->fetchAll();
}

// comment_function
function createComment($pdo, $post_id, $user_id, $content) {
    $sql = "INSERT INTO comments (post_id, user_id, content) VALUES (:post_id, :user_id, :content)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':post_id' => $post_id,
        ':user_id' => $user_id,
        ':content' => $content
    ]);
}

function getCommentsByPostId($pdo, $post_id) {
    $sql = "SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$post_id]);
    return $stmt->fetchAll();
}

function deleteComment($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->rowCount() > 0;  // Return true if a comment was deleted
}

function getCommentById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT comments.*, posts.id as post_id FROM comments JOIN posts ON comments.post_id = posts.id WHERE comments.id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

// Module name lookup function
function getModuleNameById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT name FROM modules WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetchColumn() ?: 'Unknown Module';
}

// login_function
function getUserByEmail($pdo, $email) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
}

// auth_function
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && strtolower($_SESSION['role']) === 'admin';
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /comp1841/login.php');
        exit;
    }
}

function requireAdmin() {
    if (!isLoggedIn() || !isAdmin()) {
        header('Location: /comp1841/login.php');
        exit;
    }
}
?>