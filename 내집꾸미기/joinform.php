<div class = "joinform">
    <form class = "box" action = "join.php" method = "POST">
        <h1>회원가입</h1>
        <p class = "joinp flex"><span class = "label">이름</span>
        <input type = "text" placeholder = "이름을 입력하세요" name = "name" class = "name" id = "name" autocomplete='off'></input>
        <p class = "joinp flex okunder680"><span class = "label">ID</span>
        <input type = "text" placeholder = "아이디를 입력하세요" name = "ID" class = "ID joinID" id = "ID" autocomplete='off'></input>
        <input type = "button" class = "IDCK" value = "확인"></input><input class = "distinct" name = "distinct" readonly></input></p>
        <p class = "joinp flex"><span class = "label">PW</span>
        <input type = "password" placeholder = "패스워드를 입력하세요" name = "PW" class = "PW joinPW" id = "PW"></input></p>
        <p class = "joinp flex okunder680"><span class = "label">패스워드 확인</span>
        <input type = "password" placeholder = "패스워드 확인" name = "PWCH" class = "PWCH" id = "PWCH"></input>
        <input type = "button" class = "PWCK" value = "확인"></input><input class = "pwok" name = "pwok" readonly></input></p></p>
        <p class = "joinp flex profileunder680"><span class = "label">프로필 사진</span><span class = "under680profile">프로필 사진 등록</span>
        <input type = "file" class = "file" name = "file" accept=".jpg, .jpeg, .png"></input><img class = "profileimg"></img>
        </p>
        <p class = "joinp flex"><span class = "label">자동입력문자</span>
        <input type = "text" placeholder = "자동입력방지문자를 입력하세요." name = "capttext" class = "capttext" autocomplete='off'></input>
        <input type = "text" class = "captcha" name = "captcha" readonly></input></p>
        <p class = "joinp flex">
            <input type = "button" class = "getjoin" value = "회원가입"></input>
            <input type = "button" class = "cancel" value = "취소"></input>
        </p>
    </form>
</div>