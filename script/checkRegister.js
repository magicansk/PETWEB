function checkForm() {
    if (document.formJoin.m_username.value == "") {
        alert("請填寫帳號!");
        document.formJoin.m_username.focus();
        return false;
    } else {
        uid = document.formJoin.m_username.value;
        if (uid.length < 5 || uid.length > 12) {
            alert("您的帳號長度只能5至12個字元!");
            document.formJoin.m_username.focus();
            return false;
        }
        if (!(uid.charAt(0) >= 'a' && uid.charAt(0) <= 'z')) {
            alert("您的帳號第一字元只能為小寫字母!");
            document.formJoin.m_username.focus();
            return false;
        }
        for (idx = 0; idx < uid.length; idx++) {
            if (!((uid.charAt(idx) >= 'a' && uid.charAt(idx) <= 'z') || (uid.charAt(idx) >= 'A' && uid.charAt(idx) <= 'Z') || (uid.charAt(idx) >= '0' && uid.charAt(idx) <= '9'))) {
                alert("您的帳號只能是數字及英文字母!");
                document.formJoin.m_username.focus();
                return false;
            }
            //預設的帳號格式太奇怪，紹寧更改-1120
            /*if(uid.charAt(idx)>='A'&&uid.charAt(idx)<='Z'){
                alert("帳號不可以含有大寫字元!" );
                document.formJoin.m_username.focus();
                return false;}
            if(!(( uid.charAt(idx)>='a'&&uid.charAt(idx)<='z')||(uid.charAt(idx)>='0'&& uid.charAt(idx)<='9')||( uid.charAt(idx)=='_'))){
                alert( "您的帳號只能是數字,英文字母及「_」等符號,其他的符號都不能使用!" );
                document.formJoin.m_username.focus();
                return false;}*/
            /*if(uid.charAt(idx)=='_'&&uid.charAt(idx-1)=='_'){
                alert( "「_」符號不可相連 !\n" );
                document.formJoin.m_username.focus();
                return false;}*/
        }
    }
    if (!check_passwd(document.formJoin.m_passwd.value, document.formJoin.m_passwdrecheck.value)) {
        document.formJoin.m_passwd.focus();
        return false;
    }
    //新增密碼格式-1121

    if (document.formJoin.m_name.value == "") {
        alert("請填寫姓名!");
        document.formJoin.m_name.focus();
        return false;
    }
    if (document.formJoin.m_birthday.value == "") {
        alert("請填寫生日!");
        document.formJoin.m_birthday.focus();
        return false;
    }
    //新增生日正規格式-1120
    if (!checkbirthday(document.formJoin.m_birthday)) {
        document.formJoin.m_birthday.focus();
        return false;
    }
    //新增連絡電話、地址-1120
    if (document.formJoin.m_phone.value == "") {
        alert("請填寫連絡電話!");
        document.formJoin.m_phone.focus();
        return false;
    }
    if (!checkphone(document.formJoin.m_phone)) {
        document.formJoin.m_phone.focus();
        return false;
    }
    if (document.formJoin.m_address.value == "") {
        alert("請填寫地址!");
        document.formJoin.m_address.focus();
        return false;
    }
    if (document.formJoin.m_email.value == "") {
        alert("請填寫電子郵件!");
        document.formJoin.m_email.focus();
        return false;
    }
    if (!checkmail(document.formJoin.m_email)) {
        document.formJoin.m_email.focus();
        return false;
    }
    return confirm('確定送出嗎？');
}

function checkpasswd(mypasswd) {
    var filter = /^(?=.*\d)(?=.*[a-zA-Z]).{8,12}$/;
    if (filter.test(mypasswd)) //不能用.value,因為
    {
        return true;
    } else {
        alert("密碼需包含英文及數字");
        return false;
    }
}

function check_passwd(pw1, pw2) {

    if (pw1 == '') {
        alert("密碼不可以空白!");
        return false;
    }
    for (var idx = 0; idx < pw1.length; idx++) {
        if (pw1.charAt(idx) == ' ' || pw1.charAt(idx) == '\"') {
            alert("密碼不可以含有空白或雙引號 !\n");
            return false;
        }
        if (pw1.length < 8 || pw1.length > 12) {
            alert("密碼長度為8到12個字符!\n");
            return false;
        }

        if (pw1 != pw2) {
            alert("密碼二次輸入不一樣,請重新輸入 !\n");
            return false;
        }
    }
    if (checkpasswd(pw1) == false) { //1124BY組長

        return false;
    }
    return true;
}

function checkmail(myEmail) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (filter.test(myEmail.value)) {
        return true;
    }
    alert("電子郵件格式不正確");
    return false;
}
//新增生日格式-1120
function checkbirthday(myBirthday) {
    var filter = /^([0-9]{4})\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[0-1])$/;
    if (filter.test(myBirthday.value)) {
        return true;
    }
    alert("生日格式不正確");
    return false;
}

//新增電話格式-1125 OK
function checkphone(myphone) {
    var filter = /^09\d{8}$/;
    if (filter.test(myphone.value)) {
        return true;
    } else {
        alert("手機格式不正確");
        return false;
    }
}