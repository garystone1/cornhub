# cornhub

## 使用手冊 : 

For 網站主架構 

../index/index.php-> 包括search的方式和首頁的基本架構
../index/preview.js-> index.php中會用到的script，作用是生成影片的資料，包括影片截圖、影片長度、觀看次數、影片預覽等。
../index/vidpic.png-> 影片沒有截圖時的預設圖片

For 會員制 

../member/upload-> 用來裝會員資料中會員的頭貼(.jpg/.png)
../member/image-> 儲存用在會員頁面中的背景及css會用的各種圖片
../member/Config.php-> 建立 MYSQL 連線
../member/login.php-> 登入/註冊⾴⾯
../member/new-user.php-> 新⽤⼾填寫資料
../member/forget.php-> 忘記帳號/密碼 寄新密碼⾄信箱
../member/member.php-> 會員資料/premium 
../member/upload_ready.php-> 選擇要上傳的頭像
../member/upload.php-> 將頭像上傳⾄路徑 更新使⽤者權限
../member/pay.php-> 信⽤卡付款⾴⾯ 偵測卡號
../member/update_premium.php-> 更新使⽤者權限
../member/signout.php-> 清除 SESSION

For 影片播放相關

../play/video_img-> 影片封面縮圖
../play/upload-> 影片上傳存放處(我們code中有些範例影片，但由於 github 沒辦法上傳過大的影片，
所以只傳了幾部作為範例，如需使用可以自行上傳影片)
../play/image-> 網頁中的 icon
../play/getid3-> 分析影片長度
../play/viewvideo.php-> 播放影片
../play/viewplus.php-> 增加觀看次數
../play/video.css-> 播放影片頁面及上傳影片頁面的CSS
../play/uploadpage.php-> 上傳影片頁面
../play/upload.php-> 上傳影片到資料庫
../play/dislike.php-> 影片按讚功能
../play/like.php-> 影片倒讚功能
../play/message.php-> 留言板功能

---
## 安裝手冊 :
Step1 : https://github.com/garystone1/cornhub 輸入該網址即可進入github下載程式碼
Step2: 網站中所有的 code 下載下來
Step3: 創一個資料夾把檔案都放在裡面
Step4: 把所有檔案放在下方所指示的資料夾中
Step5: Have Fun

---
MIT License

Copyright (c) 2019 garystone1

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
