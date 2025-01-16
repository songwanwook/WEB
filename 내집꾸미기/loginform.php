<div class = "loginform">
    <form class = "logindiv flex column" method = "POST">
        <h1>로그인</h1>
        <p class = "loginp flex"><span>ID</span><input type = "text" placeholder = "아이디를 입력하세요" name = "ID" class = "ID" autocomplete='off' required></input></p>
        <p class = "loginp flex"><span>PW</span><input type = "password" placeholder = "패스워드를 입력하세요" name = "PW" class = "PW" required></input></p>
        <p class = "loginp flex">
            <input type = "button" class = "getlogin" value = "로그인"></input>
            <input type = "button" class = "joinbutton" value = "회원가입"></input>
            <input type = "button" class = "cancel" value = "둘러보기"></input>
            <input type = "button" class = "findidpw" value = "ID/PW찾기"></input>
        </p>
    </form>
    <form class = "findidpwdiv flex column" method = "POST">
        <p>ID 찾기</p>
        <span>이름을 입력하세요</span>
        <span class = "flex"><input type = "text" class = "inputname"></input><input type = "button" class = "findidok" value = "확인"/></span>
        <p>PW 찾기</p>
        <span>ID를 입력하세요</span>
        <span class = "flex"><input type = "text" class = "inputID"></input><input type = "button" class = "findpwok" value = "확인"/></span>
        <input type = "button" class = "LOGIN" value = "로그인"></input>
    </form>
</div>