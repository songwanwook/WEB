// 사용자가 페이지를 벗어나려고 할 때 경고 메시지를 표시
window.onbeforeunload = function() {
    return "이 페이지를 벗어나면 작성 중인 내용이 저장되지 않을 수 있습니다.";
}
// 폼 제출 시 경고 해제
function allowFormSubmission() {
    window.onbeforeunload = null;
}