<?include($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?php
    if(!isset($_REQUEST['checkbox']) && $_REQUEST['checkbox'] !== "Y") {
        $result['status'] = "error";
        $result['message'] = "Нет соглашения c Пользовательским соглашением и Политикой конфиденциальности";
    }
    if($_REQUEST['password'] !== $_REQUEST['confirm_password']){
        $result['status'] = "error";
        $result['message'] = "Пароли не совпадают";
    }
    if($_REQUEST['password']==""){
        $result['status'] = "error";
        $result['message'] = "Заполните пароль";
    }
        if(check_email($_REQUEST['mail'])) {
            $_REQUEST['login_name'] = $_REQUEST['mail'];

            $sql = CUser::GetList(($by="id"), ($order="desc"), Array("=EMAIL" => $_REQUEST['mail']));
            if($sql->NavNext(true, "f_"))
            {
                $id_user = $f_ID;
                if($id_user) {
                    $result['status'] = "error";
                    $result['message'] = "Вы уже проходили тест";
                }
            }

        } else {
            $result['status'] = "error";
            $result['message'] = "Неверный Email";
        }
        if($_REQUEST['mail']=="") {
            $result['status'] = "error";
            $result['message'] = "Заполните Email";
        }
        global $USER;
        if(empty($result['status'])) {
            $user = new CUser;
            $res = $user->add(array("NAME" => $_REQUEST['name'], "LAST_NAME" => $_REQUEST['last_name'], "LOGIN" => $_REQUEST['login_name'], "EMAIL" => $_REQUEST['mail'],"PASSWORD" => $_REQUEST['password'], "CONFIRM_PASSWORD" => $_REQUEST['confirm_password'],));
            if($res) {
                $arrGroups_new = array(3,4,5); // в какие группы хотим добавить
                $arrGroups_old = $USER->GetUserGroupArray(); // получим текущие группы
                $arrGroups = array_unique(array_merge($arrGroups_old, $arrGroups_new)); // объединим два массива и удалим дубли
                $USER->Update($res, array("GROUP_ID" => $arrGroups)); // обновим профайл пользователя в базе
                $USER->Authorize($res);
                $result['status'] = "success";
                CEvent::SendImmediate("USER_INFO","s1", Array(
                    "LAST_NAME" => $_REQUEST['last_name'],
                    "NAME" => $_REQUEST['name'],
                    "PASSWORD" => $_REQUEST['password'],
                    "EMAIL" => $_REQUEST['mail'],
                ));
            } else {
                $result['status'] = "error";
                $result['message'] = $user->LAST_ERROR;
            }
        }
echo json_encode($result);
?>