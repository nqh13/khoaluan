// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.9.0/firebase-app.js";
import {
  getDatabase,
  ref,
  set,
  onValue,
  push,
} from "https://www.gstatic.com/firebasejs/10.9.0/firebase-database.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyC4mK9JdDdJUjUQtkm3kLWIbG7gIBntArs",
  authDomain: "hocvu-5dedf.firebaseapp.com",
  projectId: "hocvu-5dedf",
  storageBucket: "hocvu-5dedf.appspot.com",
  messagingSenderId: "109221762575",
  appId: "1:109221762575:web:c4d9ce59b68ea75906b57a",
  databaseURL:
    "https://hocvu-5dedf-default-rtdb.asia-southeast1.firebasedatabase.app",
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

// Initialize Realtime Database and get a reference to the service
const database = getDatabase(app);

// Write data to the database

const btn_comment = document.getElementById("btn_comment");
const content = document.getElementById("textAreaContent");

const ma_cuocthaoluan = btn_comment.getAttribute("data-ma_cuocthaoluan");
const ma_nguoidung = btn_comment.getAttribute("data-ma_nguoidung");
const hoten = btn_comment.getAttribute("data-hoten");

function writeUserData(id_post, content, ma_nguoidung, hoten) {
  // set(ref(database, "comment-" + id_post + "/" + ma_nguoidung), {
  //   ma_nguoidung: ma_nguoidung,
  //   content: content,
  //   createdAt: Date.now(),
  // });
  push(ref(database, "comment-" + id_post), {
    ma_nguoidung: ma_nguoidung,
    content: content,
    createdAt: Date.now(),
    hoten,
  });
}

function escapeHtml(unsafe) {
  return unsafe
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

const starCountRef = ref(database, "comment-" + ma_cuocthaoluan);
const ElmComments = document.getElementById("comments");

btn_comment.addEventListener("click", () => {
  if (content.value === "") {
    alert("Vui lòng nhập nội dung bình luận");
  } else {
    writeUserData(ma_cuocthaoluan, content.value, ma_nguoidung, hoten);
    content.value = "";
  }
});

document.addEventListener("DOMContentLoaded", () => {
  function updateComment(id, content) {
    const newContent = prompt("Nhập nội dung bình luận", content);
    if (newContent) {
      // Assuming set and ref are defined globally
      set(ref(database, "comment-" + ma_cuocthaoluan + "/" + id), {
        content: newContent,
      });
    }
  }
  onValue(starCountRef, (snapshot) => {
    const data = snapshot.val();
    console.log(data);
    let html = "";

    Object.keys(data).forEach((messageKey) => {
      const item = data[messageKey];
      html += `
      <div class="d-flex flex-start border p-3 mt-2  bg-white">
          <img class="rounded-circle shadow-1-strong me-3" src="https://ui-avatars.com/api/?name=${
            item.hoten
          }&background=random" alt="avatar" width="30px" height="30px" />
          <div class="flex-grow-1 flex-shrink-1 ml-2">
              <div>
                  <div class="d-flex justify-content-between align-items-center">
                      <p class="mb-1">
                          ${item.hoten}<span class="small">- ${new Date(item.createdAt).toLocaleString()}</span>
                      </p>
                  </div>
                  
                  <p class="small mb-0">
                      ${escapeHtml(item.content)}
                  </p>
              </div>
    
              
          </div>
      </div>
      `;
    });
    ElmComments.innerHTML = html;
  });
});
