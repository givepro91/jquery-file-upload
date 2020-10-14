
FTP 업로드가 아닌 관리자에서 대용량 파일 업로드를 구축하기 위해 개발 (일반 사용자를 위함)

개발환경 및 내용
- php, apache
- 서버에서 허용되는 파일 용량에 맞춰 파일 업로드 가능 (post_max_size)
- ajax 처리 방식으로 인한 업로드 시각화 (업로드 진행,완료,삭제 내역 확인)

적용 예시
- 100M로 제한된 mp4, avi (동영상 파일 확장자)를 관리자가 등록/삭제 가능한 관리 메뉴 구축

``````
참고
https://github.com/blueimp/jQuery-File-Upload
https://github.com/hayageek/jquery-upload-file
