<?php
// دالة لجلب تصنيفات الشكاوى من قاعدة البيانات، إما جميع التصنيفات أو تصنيف محدد بواسطة المعرف
function getcategory($id = 'all')
{
    global $conn;
    if ($id == 'all') {
        $sql = $conn->prepare('SELECT * FROM categories');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $sql = $conn->prepare('SELECT * FROM categories WHERE category_id = ?');
        $sql->execute([$id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    }
    return $result;
}

// دالة لجلب جميع الرسائل من قاعدة البيانات
function getmessage($id='all'){
    global $conn;
    if($id=='all'){
        $sql = $conn->prepare('SELECT * FROM messages');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $result;
}

// دالة لإرسال رسالة جديدة وحفظها في قاعدة البيانات
function sendmessage($user_id, $message_content,$created_at,$message_id,$receiver_id){
    global $conn;
    $sql = $conn->prepare('INSERT INTO messages ( sender_id, message_content, created_at,message_id,receiver_id) VALUES (?, ?, ?,?,?)');
    $sql->execute([$user_id, $message_content,$created_at,$message_id,$receiver_id]);
}

// دالة لجلب جميع المستخدمين من نوع مدير من قاعدة البيانات
function getadmins(){
    global $conn;
    $sql = $conn->prepare('SELECT * FROM users WHERE type = "admin"');
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// دالة لجلب الرسائل الخاصة بمستخدم معين مع اسم المرسل
function getmessagebyid($receiver_id) {
    global $conn;
    $sql = $conn->prepare('SELECT messages.*, users.fullname FROM messages 
                          INNER JOIN users ON messages.sender_id = users.id 
                          WHERE messages.receiver_id = ?');
    $sql->execute([$receiver_id]);
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// دالة لجلب المحادثة بين مستخدمين محددين مرتبة حسب التاريخ
function getmessagesbetweenusers($sender_id, $receiver_id) {
    global $conn;
    $sql = $conn->prepare('SELECT * FROM messages WHERE 
        (sender_id = ? AND receiver_id = ?) OR 
        (sender_id = ? AND receiver_id = ?)
        ORDER BY created_at ASC');
    $sql->execute([$sender_id, $receiver_id, $receiver_id, $sender_id]);
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// دالة لجلب المناطق من قاعدة البيانات، إما جميع المناطق أو منطقة محددة بواسطة المعرف
function getarea($id = 'all')
{
    global $conn;
    if ($id == 'all') {
        $sql = $conn->prepare('SELECT * FROM area');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $sql = $conn->prepare('SELECT * FROM area WHERE area_id = ?');
        $sql->execute([$id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    }
    return $result;
}

// دالة لجلب بيانات المستخدمين، إما جميع المستخدمين أو مستخدم محدد بواسطة المعرف أو البريد الإلكتروني
function getuser($id='all', $email='all')
{
    global $conn;
    if ($id != 'all') {
        $sql = $conn->prepare('SELECT * FROM users WHERE id = ?');
        $sql->execute([$id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    }
    elseif ($email != 'all') {
        $sql = $conn->prepare('SELECT * FROM users WHERE email = ?');
        $sql->execute([$email]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    }
    else {
        $sql = $conn->prepare('SELECT * FROM users');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $result;
}

// دالة لجلب الشكاوى من قاعدة البيانات حسب المعرف أو الحالة أو كليهما
function getcomplaint($id = 'all',$status='all')
{
    global $conn;
    if ($id == 'all'&& $status == 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints ORDER BY submission_date DESC');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    elseif ($id != 'all' && $status != 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints WHERE user_id = ? or status = ? ORDER BY submission_date DESC');
        $sql->execute([$id, $status]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    elseif ($id != 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints WHERE complaint_id = ? ORDER BY submission_date DESC');
        $sql->execute([$id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    }
    elseif ($status != 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints WHERE status = ? ORDER BY submission_date DESC');
        $sql->execute([$status]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
   
    return $result;
}

// دالة لجلب الشكاوى حسب النوع أو المستخدم من قاعدة البيانات
function getcomplainttype($id = 'all',$status='all')
{
    global $conn;
    if ($id == 'all'&& $status == 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    elseif ($id != 'all' && $status != 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints WHERE user_id = ? or type = ?');
        $sql->execute([$id, $status]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    elseif ($id != 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints WHERE complaint_id = ?');
        $sql->execute([$id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    }
    elseif ($status != 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints WHERE type = ?');
        $sql->execute([$status]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
   
    return $result;
}

// دالة لتحديث بيانات المستخدم في قاعدة البيانات مثل الاسم والبريد الإلكتروني وكلمة المرور
function updateuser($id, $fullname, $email, $password)
{
    global $conn;
    if (!empty($password)) {
        $sql = $conn->prepare('UPDATE users SET fullname=?, email=?, password=? WHERE id=?');
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql->execute([$fullname, $email, $hashed_password, $id]);
    } else {
        $sql = $conn->prepare('UPDATE users SET fullname=?, email=? WHERE id=?');
        $sql->execute([$fullname, $email, $id]);
    }
    
    if($sql->rowCount() > 0) {
        $_SESSION['user_name'] = $fullname;
        $_SESSION['email'] = $email;
        return true;
    }
    return false;
}

// دالة لتحديث حالة الشكوى إما بالقبول أو الرفض مع تحديث تاريخ الحل
function actioncomplaint($action, $complaint_id){
    global $conn;
    $today = date('Y/m/d');
    if($action == 'Accept') {
        $sql = $conn->prepare('UPDATE complaints SET status="Done", resolution_date=? WHERE complaint_id=?');
    } elseif($action == 'Deny') {
        $sql = $conn->prepare('UPDATE complaints SET status="Closed", resolution_date=? WHERE complaint_id=?');
    }

    $sql->execute([$today, $complaint_id]);
    return $sql->rowCount() > 0;
}

// دالة لحذف شكوى محددة من قاعدة البيانات
function deletecomplaint($id){
    global $conn;
    $sql = $conn->prepare('DELETE FROM complaints WHERE complaint_id = ?');
    $sql->execute([$id]);
    return $sql->rowCount() > 0;
}

?>